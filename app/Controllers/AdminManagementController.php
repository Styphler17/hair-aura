<?php
/**
 * Hair Aura - Admin Management Controller
 *
 * Extra admin CRUD modules: blogs, users, site content/settings, profile, contact messages.
 */

namespace App\Controllers;

use App\Core\Database;
use App\Models\User;

class AdminManagementController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->requireAdmin();
    }

    public function blogs(): void
    {
        $db = Database::getInstance();
        $page = max(1, (int) $this->get('page', 1));
        $search = trim((string) $this->get('search', ''));
        $category = trim((string) $this->get('category', ''));
        $perPage = 20;
        $offset = ($page - 1) * $perPage;

        $where = ['1=1'];
        $params = [];

        if ($search !== '') {
            $where[] = '(bp.title LIKE :s1 OR bp.excerpt LIKE :s2 OR bp.content LIKE :s3)';
            $params['s1'] = '%' . $search . '%';
            $params['s2'] = '%' . $search . '%';
            $params['s3'] = '%' . $search . '%';
        }

        if ($category !== '') {
            $where[] = 'bp.category = :category';
            $params['category'] = $category;
        }

        $whereSql = implode(' AND ', $where);

        $posts = $db->fetchAll(
            "SELECT bp.*, u.first_name, u.last_name
             FROM blog_posts bp
             LEFT JOIN users u ON bp.author_id = u.id
             WHERE {$whereSql}
             ORDER BY COALESCE(bp.published_at, bp.created_at) DESC
             LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $total = (int) $db->fetchColumn("SELECT COUNT(*) FROM blog_posts bp WHERE {$whereSql}", $params);
        $categories = $db->fetchAll(
            "SELECT DISTINCT COALESCE(category, 'General') as category
             FROM blog_posts
             ORDER BY category ASC"
        );

        $this->render('admin/blogs/index', [
            'posts' => $posts,
            'categories' => $categories,
            'search' => $search,
            'categoryFilter' => $category,
            'pagination' => [
                'current_page' => $page,
                'last_page' => max(1, (int) ceil($total / $perPage)),
                'total' => $total
            ]
        ], 'layouts/admin');
    }

    public function addBlog(): void
    {
        $db = Database::getInstance();
        $this->render('admin/blogs/form', [
            'post' => null,
            'mediaImages' => $this->getMediaImageOptions($db)
        ], 'layouts/admin');
    }

    public function editBlog(int $id): void
    {
        $db = Database::getInstance();
        $post = $db->fetchOne("SELECT * FROM blog_posts WHERE id = :id LIMIT 1", ['id' => $id]);

        if (!$post) {
            $this->flash('error', 'Blog post not found');
            $this->redirect('/admin/blogs');
        }

        $this->render('admin/blogs/form', [
            'post' => $post,
            'mediaImages' => $this->getMediaImageOptions($db)
        ], 'layouts/admin');
    }

    public function saveBlog(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/blogs');
        }

        $data = $this->post();
        $db = Database::getInstance();
        $id = (int) ($data['id'] ?? 0);

        $title = trim((string) ($data['title'] ?? ''));
        $content = trim((string) ($data['content'] ?? ''));

        if ($title === '' || $content === '') {
            $this->flash('error', 'Title and content are required');
            $this->redirect($id > 0 ? '/admin/blogs/edit/' . $id : '/admin/blogs/add');
        }

        $slug = trim((string) ($data['slug'] ?? ''));
        if ($slug === '') {
            $slug = $this->slugify($title);
        }

        $existingSlug = $db->fetchOne(
            'SELECT id FROM blog_posts WHERE slug = :slug AND id != :id LIMIT 1',
            ['slug' => $slug, 'id' => $id]
        );
        if ($existingSlug) {
            $slug .= '-' . time();
        }

        $featuredImage = trim((string) ($data['featured_image'] ?? ''));
        $uploadedImage = $this->uploadBlogImage('featured_image_file');
        $libraryImage = trim((string) ($data['library_image'] ?? ''));
        
        if ($uploadedImage !== null) {
            // Direct upload: store relative path
            $featuredImage = $uploadedImage;
        } elseif ($libraryImage !== '') {
            // Library selection: store the path directly (no copying)
            $cleanPath = ltrim(str_replace('\\', '/', $libraryImage), '/');
            if (file_exists(__DIR__ . '/../../public/' . $cleanPath)) {
                $featuredImage = $cleanPath;
            }
        }

        $isPublished = isset($data['is_published']) ? 1 : 0;
        $publishedAt = !empty($data['published_at'])
            ? date('Y-m-d H:i:s', strtotime((string) $data['published_at']))
            : null;

        if ($isPublished === 1 && $publishedAt === null) {
            $publishedAt = date('Y-m-d H:i:s');
        }

        $payload = [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => trim((string) ($data['excerpt'] ?? '')),
            'content' => $content,
            'featured_image' => $featuredImage !== '' ? $featuredImage : null,
            'category' => trim((string) ($data['category'] ?? 'General')),
            'tags' => trim((string) ($data['tags'] ?? '')),
            'meta_title' => trim((string) ($data['meta_title'] ?? '')),
            'meta_description' => trim((string) ($data['meta_description'] ?? '')),
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($id > 0) {
            $db->update('blog_posts', $payload, 'id = :id', ['id' => $id]);
            $this->flash('success', 'Blog post updated');
            $this->redirect('/admin/blogs/edit/' . $id);
        }

        $payload['author_id'] = (int) $this->user->id;
        $payload['created_at'] = date('Y-m-d H:i:s');
        $newId = $db->insert('blog_posts', $payload);

        $this->flash('success', 'Blog post created');
        $this->redirect('/admin/blogs/edit/' . $newId);
    }

    public function deleteBlog(int $id): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/blogs');
        }

        $db = Database::getInstance();
        $db->delete('blog_posts', 'id = :id', ['id' => $id]);

        $this->flash('success', 'Blog post deleted');
        $this->redirect('/admin/blogs');
    }

    public function bulkDeleteBlogs(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/blogs');
        }

        $ids = $this->post('ids');
        if (empty($ids) || !is_array($ids)) {
            $this->flash('error', 'No items selected');
            $this->redirect('/admin/blogs');
        }

        $db = Database::getInstance();
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $db->query("DELETE FROM blog_posts WHERE id IN ($placeholders)", array_values($ids));

        $this->flash('success', count($ids) . ' blog posts deleted');
        $this->redirect('/admin/blogs');
    }

    public function bulkPublishBlogs(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/blogs');
        }

        $ids = $this->post('ids');
        if (empty($ids) || !is_array($ids)) {
            $this->flash('error', 'No items selected');
            $this->redirect('/admin/blogs');
        }

        $db = Database::getInstance();
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        
        // Update is_published and set published_at if null
        $db->query("UPDATE blog_posts SET is_published = 1, published_at = COALESCE(published_at, NOW()) WHERE id IN ($placeholders)", array_values($ids));

        $this->flash('success', count($ids) . ' blog posts published');
        $this->redirect('/admin/blogs');
    }

    public function bulkUnpublishBlogs(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/blogs');
        }

        $ids = $this->post('ids');
        if (empty($ids) || !is_array($ids)) {
            $this->flash('error', 'No items selected');
            $this->redirect('/admin/blogs');
        }

        $db = Database::getInstance();
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        
        $db->query("UPDATE blog_posts SET is_published = 0 WHERE id IN ($placeholders)", array_values($ids));

        $this->flash('success', count($ids) . ' blog posts moved to drafts');
        $this->redirect('/admin/blogs');
    }

    public function users(): void
    {
        $db = Database::getInstance();
        $page = max(1, (int) $this->get('page', 1));
        $search = trim((string) $this->get('search', ''));
        $role = trim((string) $this->get('role', ''));
        $perPage = 25;
        $offset = ($page - 1) * $perPage;

        $where = ['1=1'];
        $params = [];

        if ($search !== '') {
            $where[] = '(first_name LIKE :s1 OR last_name LIKE :s2 OR email LIKE :s3 OR phone LIKE :s4)';
            $params['s1'] = '%' . $search . '%';
            $params['s2'] = '%' . $search . '%';
            $params['s3'] = '%' . $search . '%';
            $params['s4'] = '%' . $search . '%';
        }

        if ($role !== '') {
            $where[] = 'role = :role';
            $params['role'] = $role;
        }

        $whereSql = implode(' AND ', $where);

        $users = $db->fetchAll(
            "SELECT * FROM users
             WHERE {$whereSql}
             ORDER BY created_at DESC
             LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $total = (int) $db->fetchColumn("SELECT COUNT(*) FROM users WHERE {$whereSql}", $params);

        $this->render('admin/users/index', [
            'users' => $users,
            'search' => $search,
            'roleFilter' => $role,
            'pagination' => [
                'current_page' => $page,
                'last_page' => max(1, (int) ceil($total / $perPage)),
                'total' => $total
            ]
        ], 'layouts/admin');
    }

    public function addUser(): void
    {
        $this->render('admin/users/form', [
            'account' => null
        ], 'layouts/admin');
    }

    public function editUser(int $id): void
    {
        $account = User::find($id);
        if (!$account) {
            $this->flash('error', 'User not found');
            $this->redirect('/admin/users');
        }

        $this->render('admin/users/form', [
            'account' => $account
        ], 'layouts/admin');
    }

    public function saveUser(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/users');
        }

        $db = Database::getInstance();
        $data = $this->post();
        $id = (int) ($data['id'] ?? 0);

        $firstName = trim((string) ($data['first_name'] ?? ''));
        $lastName = trim((string) ($data['last_name'] ?? ''));
        $email = trim(strtolower((string) ($data['email'] ?? '')));
        $email = $email !== '' ? $email : null;
        $phone = User::normalizePhone((string) ($data['phone'] ?? ''));
        $role = in_array(($data['role'] ?? 'customer'), ['admin', 'customer'], true)
            ? $data['role']
            : 'customer';
        $requiresEmail = $role === 'admin';

        if ($firstName === '' || $lastName === '' || $phone === '') {
            $this->flash('error', 'First name, last name, and phone are required');
            $this->redirect($id > 0 ? '/admin/users/edit/' . $id : '/admin/users/add');
        }

        if ($requiresEmail && $email === null) {
            $this->flash('error', 'Email is required for admin accounts');
            $this->redirect($id > 0 ? '/admin/users/edit/' . $id : '/admin/users/add');
        }

        if ($email !== null) {
            $emailExists = $db->fetchOne(
                'SELECT id FROM users WHERE email = :email AND id != :id LIMIT 1',
                ['email' => $email, 'id' => $id]
            );
            if ($emailExists) {
                $this->flash('error', 'Email already exists');
                $this->redirect($id > 0 ? '/admin/users/edit/' . $id : '/admin/users/add');
            }
        }

        $phoneExists = $db->fetchOne(
            "SELECT id FROM users
             WHERE REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(phone, '+', ''), ' ', ''), '-', ''), '(', ''), ')', '') = :digits
             AND id != :id
             LIMIT 1",
            [
                'digits' => preg_replace('/\D+/', '', $phone),
                'id' => $id
            ]
        );
        if ($phoneExists) {
            $this->flash('error', 'Phone number already exists');
            $this->redirect($id > 0 ? '/admin/users/edit/' . $id : '/admin/users/add');
        }

        $isActive = isset($data['is_active']) ? 1 : 0;
        $isBanned = isset($data['is_banned']) ? 1 : 0;
        $payload = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'role' => $role,
            'is_active' => $isActive,
            'is_banned' => $isBanned,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $password = (string) ($data['password'] ?? '');

        if ($id > 0) {
            $account = User::find($id);
            if (!$account) {
                $this->flash('error', 'User not found');
                $this->redirect('/admin/users');
            }

            if ((int) $this->user->id === (int) $id && $role !== 'admin') {
                $this->flash('error', 'You cannot remove your own admin role');
                $this->redirect('/admin/users/edit/' . $id);
            }

            if ($password !== '') {
                if (strlen($password) < 8) {
                    $this->flash('error', 'Password must be at least 8 characters');
                    $this->redirect('/admin/users/edit/' . $id);
                }
                $payload['password_hash'] = password_hash($password, PASSWORD_BCRYPT);
            }

            $db->update('users', $payload, 'id = :id', ['id' => $id]);
            $this->flash('success', 'User updated');
            $this->redirect('/admin/users/edit/' . $id);
        }

        if (strlen($password) < 8) {
            $this->flash('error', 'Password is required and must be at least 8 characters');
            $this->redirect('/admin/users/add');
        }

        $payload['password_hash'] = password_hash($password, PASSWORD_BCRYPT);
        $payload['email_verified'] = $requiresEmail ? (isset($data['email_verified']) ? 1 : 0) : 0;
        $payload['created_at'] = date('Y-m-d H:i:s');

        $newId = $db->insert('users', $payload);
        $this->flash('success', 'User created');
        $this->redirect('/admin/users/edit/' . $newId);
    }

    public function deleteUser(int $id): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/users');
        }

        if ((int) $this->user->id === $id) {
            $this->flash('error', 'You cannot deactivate your own account');
            $this->redirect('/admin/users');
        }

        $db = Database::getInstance();
        $db->update('users', [
            'is_active' => 0,
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = :id', ['id' => $id]);

        $this->flash('success', 'User deactivated');
        $this->redirect('/admin/users');
    }

    public function bulkDeactivateUsers(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/users');
        }

        $ids = $this->post('ids');
        if (empty($ids) || !is_array($ids)) {
            $this->flash('error', 'No items selected');
            $this->redirect('/admin/users');
        }

        // Avoid deactivating self
        $ids = array_filter($ids, function($id) {
            return (int) $id !== (int) $this->user->id;
        });

        if (empty($ids)) {
            $this->flash('error', 'No valid items selected');
            $this->redirect('/admin/users');
        }

        $db = Database::getInstance();
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        
        $db->query("UPDATE users SET is_active = 0, updated_at = NOW() WHERE id IN ($placeholders)", array_values($ids));

        $this->flash('success', count($ids) . ' users deactivated');
        $this->redirect('/admin/users');
    }

    public function settings(): void
    {
        $content = $this->loadSiteContent();
        $mediaImages = $this->getMediaImageOptions(Database::getInstance());

        $this->render('admin/settings', [
            'settings' => $content['site'],
            'mediaImages' => $mediaImages
        ], 'layouts/admin');
    }

    public function saveSettings(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/settings');
        }

        $content = $this->loadSiteContent();
        $content['site']['name'] = trim((string) $this->post('name', $content['site']['name']));
        $content['site']['tagline'] = trim((string) $this->post('tagline', $content['site']['tagline']));
        $content['site']['meta_description'] = trim((string) $this->post('meta_description', $content['site']['meta_description']));
        $content['site']['meta_keywords'] = trim((string) $this->post('meta_keywords', $content['site']['meta_keywords']));

        // Handle Logo Upload or Library Selection
        $uploaded = false;
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $success = \App\Core\ImageManager::replace($_FILES['logo'], 'img/logo.webp');
            if (!$success) {
                $this->flash('error', 'Failed to update logo. Please try a different image.');
                $this->redirect('/admin/settings');
            }
            $content['site']['logo'] = '/img/logo.webp';
            $uploaded = true;
        }

        if (!$uploaded) {
            $libraryLogo = trim((string) $this->post('library_logo', ''));
            if ($libraryLogo !== '') {
                $cleanPath = ltrim(str_replace('\\', '/', $libraryLogo), '/');
                if (file_exists(__DIR__ . '/../../public/' . $cleanPath)) {
                    $content['site']['logo'] = '/' . $cleanPath;
                }
            }
        }

        $colorInputs = [
            'theme_primary' => '#D4A574',
            'theme_primary_dark' => '#B8935F',
            'theme_secondary' => '#2C2C2C',
            'theme_gold' => '#D4AF37'
        ];
        foreach ($colorInputs as $field => $fallback) {
            $raw = (string) $this->post($field, $content['site'][$field] ?? $fallback);
            $normalized = $this->normalizeHexColor($raw);
            if ($normalized === null) {
                $this->flash('error', 'Invalid color value for ' . str_replace('_', ' ', $field) . '. Use #RRGGBB format.');
                $this->redirect('/admin/settings');
            }
            $content['site'][$field] = $normalized;
        }

        // Handle Hero Slides
        $postSlides = (array) $this->post('hero_slides', []);
        $processedSlides = [];
        for ($i = 0; $i < 3; $i++) {
            $slide = $postSlides[$i] ?? [];
            $processedSlides[] = [
                'image' => trim((string) ($slide['image'] ?? $content['site']['hero_slides'][$i]['image'] ?? '/img/hero-1.webp')),
                'title' => trim((string) ($slide['title'] ?? '')),
                'subtitle' => trim((string) ($slide['subtitle'] ?? '')),
                'button_text' => trim((string) ($slide['button_text'] ?? '')),
                'button_link' => trim((string) ($slide['button_link'] ?? ''))
            ];
        }
        $content['site']['hero_slides'] = $processedSlides;

        // Handle Virtual Try-On Image
        $libraryTryon = trim((string) $this->post('virtual_tryon_image', ''));
        if ($libraryTryon !== '') {
            $cleanPath = ltrim(str_replace('\\', '/', $libraryTryon), '/');
            if (file_exists(__DIR__ . '/../../public/' . $cleanPath)) {
                $content['site']['virtual_tryon_image'] = '/' . $cleanPath;
            }
        }

        // Handle Instagram Images (Multiple)
        $instagramPaths = $this->post('instagram_images');
        if (is_array($instagramPaths)) {
            $cleanInstagram = [];
            foreach ($instagramPaths as $path) {
                $p = trim((string) $path);
                if ($p !== '') {
                    $cleanInstagram[] = '/' . ltrim(str_replace('\\', '/', $p), '/');
                }
            }
            $content['site']['instagram_images'] = $cleanInstagram;
        }

        $this->saveSiteContent($content);

        $this->flash('success', 'Site settings updated');
        $this->redirect('/admin/settings');
    }

    public function aboutPage(): void
    {
        $content = $this->loadSiteContent();

        $this->render('admin/content/about', [
            'about' => $content['about']
        ], 'layouts/admin');
    }

    public function saveAboutPage(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/about-page');
        }

        $content = $this->loadSiteContent();
        $content['about']['title'] = trim((string) $this->post('title', $content['about']['title']));
        $content['about']['content'] = trim((string) $this->post('content', $content['about']['content']));
        $content['about']['button_text'] = trim((string) $this->post('button_text', $content['about']['button_text']));
        $content['about']['button_url'] = trim((string) $this->post('button_url', $content['about']['button_url']));

        $this->saveSiteContent($content);

        $this->flash('success', 'About page content updated');
        $this->redirect('/admin/about-page');
    }

    public function contactInfo(): void
    {
        $content = $this->loadSiteContent();

        $this->render('admin/content/contact', [
            'contact' => $content['contact']
        ], 'layouts/admin');
    }

    public function saveContactInfo(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/contact-info');
        }

        $content = $this->loadSiteContent();
        $content['contact']['email'] = trim((string) $this->post('email', $content['contact']['email']));
        $content['contact']['phone'] = User::normalizePhone((string) $this->post('phone', $content['contact']['phone']));
        $content['contact']['whatsapp'] = User::normalizePhone((string) $this->post('whatsapp', $content['contact']['whatsapp']));
        $content['contact']['location'] = trim((string) $this->post('location', $content['contact']['location']));
        $content['contact']['business_hours'] = trim((string) $this->post('business_hours', $content['contact']['business_hours']));

        $this->saveSiteContent($content);

        $this->flash('success', 'Contact information updated');
        $this->redirect('/admin/contact-info');
    }

    public function contactMessages(): void
    {
        $db = Database::getInstance();
        $this->ensureContactMessagesTable($db);

        $search = trim((string) $this->get('search', ''));
        $status = trim((string) $this->get('status', ''));

        $where = ['1=1'];
        $params = [];

        if ($search !== '') {
            $where[] = '(name LIKE :s1 OR email LIKE :s2 OR subject LIKE :s3 OR message LIKE :s4)';
            $params['s1'] = '%' . $search . '%';
            $params['s2'] = '%' . $search . '%';
            $params['s3'] = '%' . $search . '%';
            $params['s4'] = '%' . $search . '%';
        }

        if ($status === 'read') {
            $where[] = 'is_read = 1';
        } elseif ($status === 'unread') {
            $where[] = 'is_read = 0';
        }

        $messages = $db->fetchAll(
            "SELECT * FROM contact_messages
             WHERE " . implode(' AND ', $where) . "
             ORDER BY created_at DESC
             LIMIT 300",
            $params
        );

        if (!empty($messages)) {
            $ids = array_map('intval', array_column($messages, 'id'));
            $idList = implode(',', array_filter($ids, fn ($id) => $id > 0));
            if ($idList !== '') {
                $db->query("UPDATE contact_messages SET is_read = 1 WHERE id IN ({$idList})");
                foreach ($messages as &$message) {
                    $message['is_read'] = 1;
                }
                unset($message);
            }
        }

        $this->render('admin/contact-messages/index', [
            'messages' => $messages,
            'search' => $search,
            'status' => $status
        ], 'layouts/admin');
    }

    public function deleteContactMessage(int $id): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/contact-messages');
        }

        $db = Database::getInstance();
        $this->ensureContactMessagesTable($db);

        $db->delete('contact_messages', 'id = :id', ['id' => $id]);

        $this->flash('success', 'Contact message deleted');
        $this->redirect('/admin/contact-messages');
    }

    public function notes(): void
    {
        $db = Database::getInstance();
        $this->ensureNotesTable($db);

        $search = trim((string) $this->get('search', ''));
        $editId = max(0, (int) $this->get('edit', 0));

        $where = ['n.admin_id = :admin_id', 'n.is_archived = 0'];
        $params = ['admin_id' => (int) $this->user->id];

        if ($search !== '') {
            $where[] = '(n.title LIKE :s1 OR n.content LIKE :s2)';
            $params['s1'] = '%' . $search . '%';
            $params['s2'] = '%' . $search . '%';
        }

        $notes = $db->fetchAll(
            "SELECT n.*, u.first_name, u.last_name
             FROM notes n
             LEFT JOIN users u ON n.admin_id = u.id
             WHERE " . implode(' AND ', $where) . "
             ORDER BY n.is_pinned DESC, n.updated_at DESC",
            $params
        );

        $editingNote = null;
        if ($editId > 0) {
            $editingNote = $db->fetchOne(
                "SELECT * FROM notes WHERE id = :id AND admin_id = :admin_id LIMIT 1",
                [
                    'id' => $editId,
                    'admin_id' => (int) $this->user->id
                ]
            );
        }

        $this->render('admin/notes/index', [
            'notes' => $notes,
            'search' => $search,
            'editingNote' => $editingNote
        ], 'layouts/admin');
    }

    public function saveNote(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/notes');
        }

        $db = Database::getInstance();
        $this->ensureNotesTable($db);

        $id = max(0, (int) $this->post('id', 0));
        $title = trim((string) $this->post('title', ''));
        $content = trim((string) $this->post('content', ''));
        $isPinned = $this->post('is_pinned') ? 1 : 0;

        if ($title === '' || $content === '') {
            $this->flash('error', 'Note title and content are required');
            $this->redirect($id > 0 ? '/admin/notes?edit=' . $id : '/admin/notes');
        }

        $payload = [
            'title' => $title,
            'content' => $content,
            'is_pinned' => $isPinned,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($id > 0) {
            $db->update(
                'notes',
                $payload,
                'id = :id AND admin_id = :admin_id',
                [
                    'id' => $id,
                    'admin_id' => (int) $this->user->id
                ]
            );
            $this->flash('success', 'Note updated');
            $this->redirect('/admin/notes');
        }

        $payload['admin_id'] = (int) $this->user->id;
        $payload['created_at'] = date('Y-m-d H:i:s');
        $db->insert('notes', $payload);

        $this->flash('success', 'Note created');
        $this->redirect('/admin/notes');
    }

    public function deleteNote(int $id): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/notes');
        }

        $db = Database::getInstance();
        $this->ensureNotesTable($db);

        $db->update(
            'notes',
            [
                'is_archived' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ],
            'id = :id AND admin_id = :admin_id',
            [
                'id' => $id,
                'admin_id' => (int) $this->user->id
            ]
        );

        $this->flash('success', 'Note archived');
        $this->redirect('/admin/notes');
    }

    public function faqs(): void
    {
        $db = Database::getInstance();
        $this->ensureFaqsTable($db);

        $faqs = $db->fetchAll("SELECT * FROM faqs ORDER BY sort_order ASC, created_at DESC");

        $this->render('admin/content/faqs', [
            'faqs' => $faqs
        ], 'layouts/admin');
    }

    public function saveFaq(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/faqs');
        }

        $db = Database::getInstance();
        $this->ensureFaqsTable($db);

        $id = (int) ($this->post('id') ?? 0);
        $question = trim((string) $this->post('question', ''));
        $answer = trim((string) $this->post('answer', ''));
        $sortOrder = (int) $this->post('sort_order', 0);
        $isActive = isset($_POST['is_active']) ? 1 : 0;

        if ($question === '' || $answer === '') {
            $this->flash('error', 'Question and answer are required');
            $this->redirect('/admin/faqs');
        }

        $payload = [
            'question' => $question,
            'answer' => $answer,
            'sort_order' => $sortOrder,
            'is_active' => $isActive
        ];

        if ($id > 0) {
            $db->update('faqs', $payload, 'id = :id', ['id' => $id]);
            $this->flash('success', 'FAQ updated');
        } else {
            $db->insert('faqs', $payload);
            $this->flash('success', 'FAQ created');
        }

        $this->redirect('/admin/faqs');
    }

    public function deleteFaq(int $id): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/faqs');
        }

        $db = Database::getInstance();
        $this->ensureFaqsTable($db);

        $db->delete('faqs', 'id = :id', ['id' => $id]);
        $this->flash('success', 'FAQ deleted');
        $this->redirect('/admin/faqs');
    }

    public function bulkDeleteFaqs(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/faqs');
        }

        $ids = $this->post('ids');
        if (empty($ids) || !is_array($ids)) {
            $this->flash('error', 'No items selected');
            $this->redirect('/admin/faqs');
        }

        $db = Database::getInstance();
        $this->ensureFaqsTable($db);

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $db->query("DELETE FROM faqs WHERE id IN ($placeholders)", array_values($ids));

        $this->flash('success', count($ids) . ' FAQs deleted');
        $this->redirect('/admin/faqs');
    }

    private function ensureFaqsTable(Database $db): void
    {
        $db->query(
            "CREATE TABLE IF NOT EXISTS faqs (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                question TEXT NOT NULL,
                answer TEXT NOT NULL,
                sort_order INT DEFAULT 0,
                is_active TINYINT(1) DEFAULT 1,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
        );
    }

    public function mediaLibrary(): void
    {
        $db = Database::getInstance();
        $this->ensureMediaLibraryTable($db);
        $this->syncMediaFromPublicDirectory($db, 'img', 'media');

        $search = trim((string) $this->get('search', ''));
        $folder = trim((string) $this->get('folder', ''));
        $mime = trim((string) $this->get('mime', 'images'));
        $sort = trim((string) $this->get('sort', 'newest'));

        $where = ['1=1'];
        $params = [];

        if ($search !== '') {
            $where[] = '(file_name LIKE :s1 OR original_name LIKE :s2 OR file_path LIKE :s3 OR alt_text LIKE :s4 OR tags LIKE :s5)';
            $params['s1'] = '%' . $search . '%';
            $params['s2'] = '%' . $search . '%';
            $params['s3'] = '%' . $search . '%';
            $params['s4'] = '%' . $search . '%';
            $params['s5'] = '%' . $search . '%';
        }

        if ($folder !== '') {
            $where[] = 'folder = :folder';
            $params['folder'] = $folder;
        }

        if ($mime === 'images') {
            $where[] = "mime_type LIKE 'image/%'";
        } elseif ($mime === 'video') {
            $where[] = "mime_type LIKE 'video/%'";
        } elseif ($mime === 'documents') {
            $where[] = "(mime_type LIKE 'application/%' OR mime_type LIKE 'text/%')";
        }

        $orderBy = match ($sort) {
            'oldest' => 'created_at ASC',
            'name_asc' => 'file_name ASC',
            'name_desc' => 'file_name DESC',
            'size_desc' => 'size_bytes DESC',
            'size_asc' => 'size_bytes ASC',
            default => 'created_at DESC'
        };

        $items = $db->fetchAll(
            "SELECT *
             FROM media_library
             WHERE " . implode(' AND ', $where) . "
             ORDER BY {$orderBy}
             LIMIT 600",
            $params
        );

        $folderStats = $db->fetchAll(
            "SELECT folder, COUNT(*) as total
             FROM media_library
             GROUP BY folder
             ORDER BY folder ASC"
        );

        $this->render('admin/media/index', [
            'items' => $items,
            'folderStats' => $folderStats,
            'filters' => [
                'search' => $search,
                'folder' => $folder,
                'mime' => $mime,
                'sort' => $sort
            ]
        ], 'layouts/admin');
    }

    public function uploadMedia(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/media');
        }

        $db = Database::getInstance();
        $this->ensureMediaLibraryTable($db);

        if (!isset($_FILES['media_files'])) {
            $this->flash('error', 'Please select file(s) to upload');
            $this->redirect('/admin/media');
        }

        $folder = $this->sanitizeMediaFolder((string) $this->post('folder', 'media'));
        $altText = trim((string) $this->post('alt_text', ''));
        $tags = trim((string) $this->post('tags', ''));

        $files = $_FILES['media_files'];
        $uploadedCount = 0;

        $isMulti = is_array($files['name'] ?? null);
        $totalFiles = $isMulti ? count($files['name']) : 1;

        for ($i = 0; $i < $totalFiles; $i++) {
            $file = [
                'name' => $isMulti ? (string) ($files['name'][$i] ?? '') : (string) ($files['name'] ?? ''),
                'type' => $isMulti ? (string) ($files['type'][$i] ?? '') : (string) ($files['type'] ?? ''),
                'tmp_name' => $isMulti ? (string) ($files['tmp_name'][$i] ?? '') : (string) ($files['tmp_name'] ?? ''),
                'error' => $isMulti ? (int) ($files['error'][$i] ?? UPLOAD_ERR_NO_FILE) : (int) ($files['error'] ?? UPLOAD_ERR_NO_FILE),
                'size' => $isMulti ? (int) ($files['size'][$i] ?? 0) : (int) ($files['size'] ?? 0)
            ];

            $stored = $this->storeMediaUpload($file, $folder);
            if ($stored === null) {
                continue;
            }

            if ($this->registerMediaRecordFromPath(
                $db,
                $stored['relative_path'],
                $folder,
                $file['name'],
                $altText,
                $tags
            )) {
                $uploadedCount++;
            }
        }

        if ($uploadedCount > 0) {
            $this->flash('success', $uploadedCount . ' file(s) uploaded to Media Library');
        } else {
            $this->flash('error', 'No files were uploaded. Check file type/size and try again.');
        }

        $this->redirect('/admin/media');
    }

    public function renameMedia(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/media');
        }

        $id = (int) $this->post('id');
        $newName = trim((string) $this->post('new_name'));

        // Basic validation
        if ($id <= 0 || $newName === '' || preg_match('/[^a-z0-9\.\-_]/i', $newName)) {
            $this->flash('error', 'Invalid filename. Use alphanumeric, dash, underscore, and dot.');
            $this->redirect('/admin/media');
        }

        $db = Database::getInstance();
        $media = $db->fetchOne("SELECT * FROM media_library WHERE id = :id LIMIT 1", ['id' => $id]);
        if (!$media) {
            $this->flash('error', 'Media file not found');
            $this->redirect('/admin/media');
        }

        $oldName = $media['file_name'];
        if ($oldName === $newName) {
            $this->flash('info', 'Name unchanged');
            $this->redirect('/admin/media');
        }
        
        // Ensure extension matches
        $oldExt = pathinfo($oldName, PATHINFO_EXTENSION);
        $newExt = pathinfo($newName, PATHINFO_EXTENSION);
        if (strtolower($oldExt) !== strtolower($newExt)) {
             $newName = preg_replace('/\.' . preg_quote($newExt, '/') . '$/', '', $newName) . '.' . $oldExt;
        }

        $folder = $media['folder']; 
        $publicRoot = __DIR__ . '/../../public/';
        
        $oldRelPath = $media['file_path'];
        $oldAbsPath = $publicRoot . $oldRelPath;
        
        $dir = dirname($oldRelPath); 
        $newRelPath = ($dir === '.' ? '' : $dir . '/') . $newName;
        $newAbsPath = $publicRoot . $newRelPath;
        
        // Normalize slashes
        $newRelPath = str_replace('\\', '/', $newRelPath);

        if (!is_file($oldAbsPath)) {
            $this->flash('error', 'File does not exist on disk');
            $this->redirect('/admin/media');
        }

        if (file_exists($newAbsPath)) {
            $this->flash('error', 'Destination file already exists');
            $this->redirect('/admin/media');
        }

        if (rename($oldAbsPath, $newAbsPath)) {
            // Update media_library
            $db->update('media_library', [
                'file_name' => $newName,
                'file_path' => $newRelPath
            ], 'id = :id', ['id' => $id]);

            // references
            
            // 1. Direct filename match (files conceptually inside products folder)
            if ($folder === 'products' || str_contains($oldRelPath, 'products/')) {
                $db->query(
                    "UPDATE product_images SET image_path = :new_name WHERE image_path = :old_name",
                    ['new_name' => $newName, 'old_name' => $oldName]
                );
            }

            // 2. Relative path match (files referenced via ../ or similar)
            // Replace '/oldNAME' with '/newNAME' to avoid partial matches on prefixes
            $db->query(
                "UPDATE product_images SET image_path = REPLACE(image_path, :old_suffix, :new_suffix) WHERE image_path LIKE :pattern",
                [
                    'old_suffix' => '/' . $oldName, 
                    'new_suffix' => '/' . $newName,
                    'pattern' => '%/' . $oldName
                ]
            );

            $db->query(
                "UPDATE categories SET image = REPLACE(image, :old_path, :new_path)",
                ['old_path' => $oldRelPath, 'new_path' => $newRelPath]
            );
            $db->query(
                "UPDATE categories SET image = :new_name WHERE image = :old_name",
                ['new_name' => $newName, 'old_name' => $oldName]
            );

            $db->query(
                "UPDATE blog_posts SET featured_image = REPLACE(featured_image, :old_path, :new_path)",
                ['old_path' => $oldRelPath, 'new_path' => $newRelPath]
            );

            $this->flash('success', 'File renamed to ' . htmlspecialchars($newName));
        } else {
            $this->flash('error', 'Failed to rename file');
        }

        $this->redirect('/admin/media');
    }

    public function deleteMedia(int $id): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/media');
        }

        $db = Database::getInstance();
        $this->ensureMediaLibraryTable($db);

        $item = $db->fetchOne('SELECT * FROM media_library WHERE id = :id LIMIT 1', ['id' => $id]);
        if (!$item) {
            $this->flash('error', 'Media file not found');
            $this->redirect('/admin/media');
        }

        $relative = ltrim((string) ($item['file_path'] ?? ''), '/');
        if ($relative !== '') {
            $absolute = __DIR__ . '/../../public/' . $relative;
            if (is_file($absolute)) {
                @unlink($absolute);
            }
        }

        $db->delete('media_library', 'id = :id', ['id' => $id]);
        $this->flash('success', 'Media file deleted');
        $this->redirect('/admin/media');
    }

    public function bulkDeleteMedia(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/media');
        }

        $ids = $this->post('ids');
        if (empty($ids) || !is_array($ids)) {
            $this->flash('error', 'No items selected');
            $this->redirect('/admin/media');
        }

        $db = Database::getInstance();
        $this->ensureMediaLibraryTable($db);

        $items = $db->fetchAll(
            "SELECT file_path FROM media_library WHERE id IN (" . implode(',', array_fill(0, count($ids), '?')) . ")",
            array_values($ids)
        );

        $deletedCount = 0;
        foreach ($items as $item) {
            $relative = ltrim((string) ($item['file_path'] ?? ''), '/');
            if ($relative !== '') {
                $absolute = __DIR__ . '/../../public/' . $relative;
                if (is_file($absolute)) {
                    @unlink($absolute);
                }
            }
        }

        $db->query("DELETE FROM media_library WHERE id IN (" . implode(',', array_fill(0, count($ids), '?')) . ")", array_values($ids));

        $this->flash('success', count($ids) . ' media files deleted');
        $this->redirect('/admin/media');
    }

    public function syncMedia(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/media');
        }

        $db = Database::getInstance();
        $this->ensureMediaLibraryTable($db);

        $totalImported = 0;
        $totalUpdated = 0;
        $totalSkipped = 0;

        $jobs = [
            ['table' => 'categories', 'column' => 'image', 'folder' => 'categories'],
            ['table' => 'blog_posts', 'column' => 'featured_image', 'folder' => 'blog'],
            ['table' => 'product_images', 'column' => 'image_path', 'folder' => 'products'],
            ['table' => 'users', 'column' => 'avatar', 'folder' => 'avatars']
        ];

        foreach ($jobs as $job) {
            $result = $this->syncMediaFromTableColumn(
                $db,
                $job['table'],
                $job['column'],
                $job['folder']
            );
            $totalImported += $result['imported'];
            $totalUpdated += $result['updated'];
            $totalSkipped += $result['skipped'];
        }

        $brandingResult = $this->syncMediaFromPublicDirectory($db, 'img', 'media');
        $totalImported += $brandingResult['imported'];
        $totalSkipped += $brandingResult['skipped'];

        $this->flash(
            'success',
            "Media sync complete. Imported {$totalImported}, normalized {$totalUpdated}, skipped {$totalSkipped}."
        );
        $this->redirect('/admin/media');
    }

    public function search(): void
    {
        $db = Database::getInstance();
        $query = trim((string) $this->get('q', ''));

        $results = [
            'products' => [],
            'orders' => [],
            'users' => [],
            'posts' => []
        ];

        if ($query !== '' && strlen($query) >= 2) {
            $params = ['q' => '%' . $query . '%'];

            try {
                $results['products'] = $db->fetchAll(
                    "SELECT id, name, sku, slug, price, sale_price
                     FROM products
                     WHERE name LIKE :q OR sku LIKE :q
                     ORDER BY updated_at DESC
                     LIMIT 8",
                    $params
                );
            } catch (\Throwable $e) {
                $results['products'] = [];
            }

            try {
                $results['orders'] = $db->fetchAll(
                    "SELECT id, order_number, status, payment_status, total, created_at
                     FROM orders
                     WHERE order_number LIKE :q
                     ORDER BY created_at DESC
                     LIMIT 8",
                    $params
                );
            } catch (\Throwable $e) {
                $results['orders'] = [];
            }

            try {
                $results['users'] = $db->fetchAll(
                    "SELECT id, first_name, last_name, email, phone, role
                     FROM users
                     WHERE first_name LIKE :q OR last_name LIKE :q OR email LIKE :q OR phone LIKE :q
                     ORDER BY updated_at DESC
                     LIMIT 8",
                    $params
                );
            } catch (\Throwable $e) {
                $results['users'] = [];
            }

            try {
                $results['posts'] = $db->fetchAll(
                    "SELECT id, title, slug, category, is_published, updated_at
                     FROM blog_posts
                     WHERE title LIKE :q OR excerpt LIKE :q OR content LIKE :q
                     ORDER BY updated_at DESC
                     LIMIT 8",
                    $params
                );
            } catch (\Throwable $e) {
                $results['posts'] = [];
            }
        }

        $this->render('admin/search', [
            'query' => $query,
            'results' => $results
        ], 'layouts/admin');
    }

    public function profile(): void
    {
        $mediaImages = $this->getMediaImageOptions(Database::getInstance());
        $this->render('admin/profile', [
            'adminUser' => $this->user,
            'mediaImages' => $mediaImages
        ], 'layouts/admin');
    }

    public function saveProfile(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/profile');
        }

        $data = $this->post();
        $firstName = trim((string) ($data['first_name'] ?? ''));
        $lastName = trim((string) ($data['last_name'] ?? ''));
        $email = trim(strtolower((string) ($data['email'] ?? '')));
        $phone = User::normalizePhone((string) ($data['phone'] ?? ''));

        if ($firstName === '' || $lastName === '' || $email === '' || $phone === '') {
            $this->flash('error', 'All profile fields are required');
            $this->redirect('/admin/profile');
        }

        $db = Database::getInstance();
        $emailExists = $db->fetchOne(
            'SELECT id FROM users WHERE email = :email AND id != :id LIMIT 1',
            ['email' => $email, 'id' => $this->user->id]
        );
        if ($emailExists) {
            $this->flash('error', 'Email already exists');
            $this->redirect('/admin/profile');
        }

        $phoneExists = $db->fetchOne(
            "SELECT id FROM users
             WHERE REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(phone, '+', ''), ' ', ''), '-', ''), '(', ''), ')', '') = :digits
             AND id != :id
             LIMIT 1",
            [
                'digits' => preg_replace('/\D+/', '', $phone),
                'id' => $this->user->id
            ]
        );
        if ($phoneExists) {
            $this->flash('error', 'Phone number already exists');
            $this->redirect('/admin/profile');
        }

        $avatarFilename = $this->uploadAvatar('avatar', (string) ($this->user->avatar ?? ''));

        if ($avatarFilename === null) {
            $libraryAvatar = trim((string) $this->post('library_avatar', ''));
            if ($libraryAvatar !== '') {
               $avatarFilename = ltrim(str_replace('\\', '/', $libraryAvatar), '/');
            }
        }

        $profileData = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone
        ];
        if ($avatarFilename !== null) {
            $profileData['avatar'] = $avatarFilename;
        }

        $this->user->update($profileData);

        $this->flash('success', 'Profile updated');
        $this->redirect('/admin/profile');
    }

    public function saveProfilePassword(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/profile');
        }

        $currentPassword = (string) $this->post('current_password', '');
        $newPassword = (string) $this->post('new_password', '');
        $confirmPassword = (string) $this->post('confirm_password', '');

        if (!password_verify($currentPassword, (string) $this->user->password_hash)) {
            $this->flash('error', 'Current password is incorrect');
            $this->redirect('/admin/profile');
        }

        if (strlen($newPassword) < 8) {
            $this->flash('error', 'New password must be at least 8 characters');
            $this->redirect('/admin/profile');
        }

        if (!hash_equals($newPassword, $confirmPassword)) {
            $this->flash('error', 'Password confirmation does not match');
            $this->redirect('/admin/profile');
        }

        $this->user->update([
            'password_hash' => password_hash($newPassword, PASSWORD_BCRYPT)
        ]);

        $this->flash('success', 'Password changed successfully');
        $this->redirect('/admin/profile');
    }

    private function siteContentPath(): string
    {
        return __DIR__ . '/../../config/site-content.php';
    }

    private function defaultSiteContent(): array
    {
        return [
            'about' => [
                'title' => 'About Hair Aura',
                'content' => "Hair Aura is a premium wig and hair extensions brand focused on quality, confidence, and everyday beauty.\n\nWe source high-quality products and provide practical support so you can find styles that fit your look and lifestyle.\n\nOur mission is simple: make premium hair accessible, reliable, and elegant.",
                'button_text' => 'Shop Collection',
                'button_url' => '/shop'
            ],
            'contact' => [
                'email' => 'support@hair-aura.debesties.com',
                'phone' => '+233508007873',
                'whatsapp' => '+233508007873',
                'location' => 'Accra, Ghana',
                'business_hours' => 'Mon - Sat, 8:00 AM - 6:00 PM'
            ],
            'site' => [
                'name' => 'Hair Aura',
                'tagline' => 'Unlock Your Aura with Perfect Wigs',
                'logo' => '/img/logo.webp',
                'meta_description' => 'Premium wigs and hair extensions in Ghana.',
                'meta_keywords' => 'wigs Ghana, hair extensions, lace fronts',
                'theme_primary' => '#D4A574',
                'theme_primary_dark' => '#B8935F',
                'theme_secondary' => '#2C2C2C',
                'theme_gold' => '#D4AF37',
                'virtual_tryon_image' => '/img/product-placeholder.webp',
                'instagram_images' => [],
                'hero_slides' => [
                    [
                        'image' => '/img/hero-1.webp',
                        'title' => 'Premium Human Hair Wigs',
                        'subtitle' => 'Elegance and quality in every strand.',
                        'button_text' => 'Shop Now',
                        'button_link' => '/shop'
                    ],
                    [
                        'image' => '/img/hero-2.webp',
                        'title' => 'Explore Our New Collection',
                        'subtitle' => 'Handcrafted wigs for a natural look.',
                        'button_text' => 'Explore Collection',
                        'button_link' => '/shop/human-hair-wigs'
                    ],
                    [
                        'image' => '/img/hero-3.webp',
                        'title' => 'Find Your Perfect Match',
                        'subtitle' => 'Style tailored to your unique aura.',
                        'button_text' => 'Shop Now',
                        'button_link' => '/shop'
                    ]
                ]
            ]
        ];
    }

    private function loadSiteContent(): array
    {
        $defaults = $this->defaultSiteContent();
        $path = $this->siteContentPath();

        if (!file_exists($path)) {
            return $defaults;
        }

        $data = require $path;
        if (!is_array($data)) {
            return $defaults;
        }

        return [
            'about' => array_merge($defaults['about'], (array) ($data['about'] ?? [])),
            'contact' => array_merge($defaults['contact'], (array) ($data['contact'] ?? [])),
            'site' => array_merge($defaults['site'], (array) ($data['site'] ?? []))
        ];
    }

    private function saveSiteContent(array $content): void
    {
        $payload = [
            'about' => (array) ($content['about'] ?? []),
            'contact' => (array) ($content['contact'] ?? []),
            'site' => (array) ($content['site'] ?? [])
        ];

        $export = "<?php\nreturn " . var_export($payload, true) . ";\n";
        file_put_contents($this->siteContentPath(), $export);
    }

    private function tableExists(Database $db, string $table): bool
    {
        try {
            $count = (int) $db->fetchColumn(
                'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = :table',
                ['table' => $table]
            );
            return $count > 0;
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function ensureMediaLibraryTable(Database $db): void
    {
        try {
            $db->query(
                "CREATE TABLE IF NOT EXISTS media_library (
                    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    file_name VARCHAR(255) NOT NULL,
                    original_name VARCHAR(255) DEFAULT NULL,
                    file_path VARCHAR(500) NOT NULL,
                    folder VARCHAR(80) NOT NULL DEFAULT 'media',
                    mime_type VARCHAR(120) DEFAULT NULL,
                    extension VARCHAR(20) DEFAULT NULL,
                    size_bytes BIGINT UNSIGNED NOT NULL DEFAULT 0,
                    alt_text VARCHAR(255) DEFAULT NULL,
                    tags VARCHAR(255) DEFAULT NULL,
                    created_by INT UNSIGNED DEFAULT NULL,
                    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    UNIQUE KEY uk_media_path (file_path),
                    INDEX idx_media_folder (folder),
                    INDEX idx_media_mime (mime_type),
                    INDEX idx_media_created (created_at),
                    CONSTRAINT fk_media_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
            );
        } catch (\Throwable $e) {
            $db->query(
                "CREATE TABLE IF NOT EXISTS media_library (
                    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    file_name VARCHAR(255) NOT NULL,
                    original_name VARCHAR(255) DEFAULT NULL,
                    file_path VARCHAR(500) NOT NULL,
                    folder VARCHAR(80) NOT NULL DEFAULT 'media',
                    mime_type VARCHAR(120) DEFAULT NULL,
                    extension VARCHAR(20) DEFAULT NULL,
                    size_bytes BIGINT UNSIGNED NOT NULL DEFAULT 0,
                    alt_text VARCHAR(255) DEFAULT NULL,
                    tags VARCHAR(255) DEFAULT NULL,
                    created_by INT UNSIGNED DEFAULT NULL,
                    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    UNIQUE KEY uk_media_path (file_path),
                    INDEX idx_media_folder (folder),
                    INDEX idx_media_mime (mime_type),
                    INDEX idx_media_created (created_at)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
            );
        }
    }

    private function getMediaImageOptions(Database $db, int $limit = 300): array
    {
        if (!$this->tableExists($db, 'media_library')) {
            return [];
        }

        try {
            return $db->fetchAll(
                "SELECT id, file_name, file_path, folder, mime_type, created_at
                 FROM media_library
                 WHERE mime_type LIKE 'image/%'
                 ORDER BY created_at DESC
                 LIMIT {$limit}"
            );
        } catch (\Throwable $e) {
            return [];
        }
    }

    private function resolveMediaPathToFolder(string $rawPath, string $targetFolder): ?string
    {
        $value = trim($rawPath);
        if ($value === '' || preg_match('#^https?://#i', $value)) {
            return null;
        }

        $clean = ltrim(str_replace('\\', '/', $value), '/');
        $publicRoot = __DIR__ . '/../../public/';
        
        // 1. If file exists at exact path (e.g. 'uploads/media/file.webp'), link to it relatively
        if (is_file($publicRoot . $clean)) {
            $folder = trim($targetFolder, '/\\');
            $targetPrefix = 'uploads/' . $folder . '/';
            
            // If strictly inside target folder, return basename
            if (str_starts_with($clean, $targetPrefix)) {
                return substr($clean, strlen($targetPrefix));
            }
            
            // Calculate relative path from target folder
            // From 'uploads/products/' (or 'uploads/blog/') to root is '../../'
            if (str_starts_with($clean, 'uploads/')) {
                // e.g. 'uploads/media/foo.webp' -> '../media/foo.webp'
                return '../' . substr($clean, 8); 
            }
            
            return '../../' . $clean;
        }

        // 2. Fallback: Copy logic (for legacy inputs or bare filenames)
        $basename = basename($clean);
        if ($basename === '') {
            return null;
        }

        $folder = trim($targetFolder, '/\\');
        $targetDir = $publicRoot . 'uploads/' . $folder . '/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $sourceCandidates = [
            $publicRoot . 'uploads/media/' . $basename,
            $publicRoot . 'img/' . $basename,
            $publicRoot . $clean
        ];

        foreach ($sourceCandidates as $source) {
            if (is_file($source)) {
                $ext = pathinfo($basename, PATHINFO_EXTENSION);
                $newFilename = pathinfo($basename, PATHINFO_FILENAME) . '-' . time() . '.' . $ext;
                if (copy($source, $targetDir . $newFilename)) {
                    return $newFilename;
                }
            }
        }

        return null; // File not found in library
    }

    private function sanitizeMediaFolder(string $folder): string
    {
        $normalized = strtolower(trim($folder));
        $allowed = ['products', 'blog', 'categories', 'avatars', 'media'];
        return in_array($normalized, $allowed, true) ? $normalized : 'media';
    }

    private function storeMediaUpload(array $file, string $folder): ?array
    {
        $error = (int) ($file['error'] ?? UPLOAD_ERR_NO_FILE);
        if ($error !== UPLOAD_ERR_OK) {
            return null;
        }

        $tmp = (string) ($file['tmp_name'] ?? '');
        $original = (string) ($file['name'] ?? '');
        if ($tmp === '' || $original === '') {
            return null;
        }

        $extension = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        $safeBase = preg_replace('/[^a-zA-Z0-9_-]+/', '-', pathinfo($original, PATHINFO_FILENAME));
        $safeBase = trim((string) $safeBase, '-');
        if ($safeBase === '') {
            $safeBase = 'media';
        }

        $folder = $this->sanitizeMediaFolder($folder);
        $uploadDir = __DIR__ . '/../../public/uploads/' . $folder . '/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filename = $safeBase . '-' . time() . '-' . substr(md5((string) mt_rand()), 0, 6);
        if ($extension !== '') {
            $filename .= '.' . $extension;
        }

        $targetPath = $uploadDir . $filename;
        if (!move_uploaded_file($tmp, $targetPath)) {
            return null;
        }

        return [
            'absolute_path' => $targetPath,
            'relative_path' => 'uploads/' . $folder . '/' . $filename
        ];
    }

    private function registerMediaRecordFromPath(
        Database $db,
        string $relativePath,
        string $folder,
        string $originalName = '',
        string $altText = '',
        string $tags = ''
    ): bool {
        $relative = ltrim(str_replace('\\', '/', $relativePath), '/');
        if ($relative === '') {
            return false;
        }

        $exists = (int) $db->fetchColumn(
            'SELECT COUNT(*) FROM media_library WHERE file_path = :file_path',
            ['file_path' => $relative]
        ) > 0;
        if ($exists) {
            return false;
        }

        $absolute = __DIR__ . '/../../public/' . $relative;
        if (!is_file($absolute)) {
            return false;
        }

        $mimeType = function_exists('mime_content_type') ? (string) (mime_content_type($absolute) ?: '') : '';
        $extension = strtolower(pathinfo($absolute, PATHINFO_EXTENSION));
        $size = (int) (@filesize($absolute) ?: 0);
        $fileName = basename($absolute);

        $db->insert('media_library', [
            'file_name' => $fileName,
            'original_name' => $originalName !== '' ? $originalName : $fileName,
            'file_path' => $relative,
            'folder' => $this->sanitizeMediaFolder($folder),
            'mime_type' => $mimeType,
            'extension' => $extension !== '' ? $extension : null,
            'size_bytes' => $size,
            'alt_text' => $altText !== '' ? $altText : null,
            'tags' => $tags !== '' ? $tags : null,
            'created_by' => (int) ($this->user->id ?? 0)
        ]);

        return true;
    }



    private function syncMediaFromTableColumn(
        Database $db,
        string $table,
        string $column,
        string $targetFolder
    ): array {
        $result = ['imported' => 0, 'updated' => 0, 'skipped' => 0];
        if (!$this->tableExists($db, $table)) {
            return $result;
        }

        $rows = $db->fetchAll(
            "SELECT id, {$column} as raw_value
             FROM {$table}
             WHERE {$column} IS NOT NULL AND TRIM({$column}) <> ''"
        );

        foreach ($rows as $row) {
            $rawValue = trim((string) ($row['raw_value'] ?? ''));
            if ($rawValue === '' || str_contains($rawValue, 'default-avatar')) {
                $result['skipped']++;
                continue;
            }

            $filename = $this->resolveMediaPathToFolder($rawValue, $targetFolder);
            if ($filename === null || $filename === '') {
                $result['skipped']++;
                continue;
            }

            if ($rawValue !== $filename) {
                $db->update(
                    $table,
                    [$column => $filename],
                    'id = :id',
                    ['id' => (int) ($row['id'] ?? 0)]
                );
                $result['updated']++;
            }

            $relativePath = 'uploads/' . $this->sanitizeMediaFolder($targetFolder) . '/' . $filename;
            if ($this->registerMediaRecordFromPath($db, $relativePath, $targetFolder, $filename, '', 'synced')) {
                $result['imported']++;
            }
        }

        return $result;
    }

    private function syncMediaFromPublicDirectory(Database $db, string $relativeDirectory, string $folder = 'media'): array
    {
        $result = ['imported' => 0, 'updated' => 0, 'skipped' => 0];
        $basePublic = __DIR__ . '/../../public/';
        $relativeDirectory = trim(str_replace('\\', '/', $relativeDirectory), '/');
        if ($relativeDirectory === '') {
            return $result;
        }

        $absoluteDirectory = $basePublic . $relativeDirectory;
        if (!is_dir($absoluteDirectory)) {
            return $result;
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'svg', 'ico', 'gif'];
        $entries = scandir($absoluteDirectory);
        if (!is_array($entries)) {
            return $result;
        }

        foreach ($entries as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }

            $absolutePath = $absoluteDirectory . '/' . $entry;
            if (!is_file($absolutePath)) {
                continue;
            }

            $extension = strtolower(pathinfo($entry, PATHINFO_EXTENSION));
            if ($extension === '' || !in_array($extension, $allowedExtensions, true)) {
                $result['skipped']++;
                continue;
            }

            $relativePath = $relativeDirectory . '/' . $entry;
            if ($this->registerMediaRecordFromPath($db, $relativePath, $folder, $entry, '', 'static')) {
                $result['imported']++;
            } else {
                $result['skipped']++;
            }
        }

        return $result;
    }

    private function ensureContactMessagesTable(Database $db): void
    {
        $db->query(
            "CREATE TABLE IF NOT EXISTS contact_messages (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(120) NOT NULL,
                email VARCHAR(190) NOT NULL,
                phone VARCHAR(30) DEFAULT NULL,
                subject VARCHAR(190) NOT NULL,
                message TEXT NOT NULL,
                is_read TINYINT(1) NOT NULL DEFAULT 0,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_contact_created_at (created_at),
                INDEX idx_contact_is_read (is_read)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
        );
    }

    private function ensureNotesTable(Database $db): void
    {
        $db->query(
            "CREATE TABLE IF NOT EXISTS notes (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                admin_id INT UNSIGNED NOT NULL,
                title VARCHAR(190) NOT NULL,
                content TEXT NOT NULL,
                is_pinned TINYINT(1) NOT NULL DEFAULT 0,
                is_archived TINYINT(1) NOT NULL DEFAULT 0,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL DEFAULT NULL,
                INDEX idx_notes_admin (admin_id),
                INDEX idx_notes_archived (is_archived),
                CONSTRAINT fk_notes_admin FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
        );
    }

    private function slugify(string $value): string
    {
        $slug = strtolower(trim($value));
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        $slug = trim((string) $slug, '-');
        return $slug !== '' ? $slug : 'post-' . time();
    }

    private function normalizeHexColor(string $value): ?string
    {
        $color = trim($value);
        if ($color === '') {
            return null;
        }

        if ($color[0] !== '#') {
            $color = '#' . $color;
        }

        if (!preg_match('/^#[0-9a-fA-F]{6}$/', $color)) {
            return null;
        }

        return strtoupper($color);
    }

    private function uploadBlogImage(string $inputName): ?string
    {
        if (!isset($_FILES[$inputName]) || (int) ($_FILES[$inputName]['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            return null;
        }

        $tmp = (string) $_FILES[$inputName]['tmp_name'];
        $original = (string) $_FILES[$inputName]['name'];

        if ($tmp === '' || $original === '') {
            return null;
        }

        $extension = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($extension, $allowed, true)) {
            return null;
        }

        $uploadDir = __DIR__ . '/../../public/uploads/blog/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filename = uniqid('blog_', true) . '.' . $extension;
        $target = $uploadDir . $filename;

        if (!move_uploaded_file($tmp, $target)) {
            return null;
        }

        return $filename;
    }

    private function uploadAvatar(string $inputName, string $currentAvatar = ''): ?string
    {
        if (!isset($_FILES[$inputName])) {
            return null;
        }

        $file = $_FILES[$inputName];
        $error = (int) ($file['error'] ?? UPLOAD_ERR_NO_FILE);
        if ($error === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if ($error !== UPLOAD_ERR_OK) {
            return null;
        }

        $tmp = (string) ($file['tmp_name'] ?? '');
        $original = (string) ($file['name'] ?? '');
        if ($tmp === '' || $original === '') {
            return null;
        }

        $extension = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($extension, $allowed, true)) {
            return null;
        }

        $uploadDir = __DIR__ . '/../../public/uploads/avatars/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filename = uniqid('avatar_', true) . '.' . $extension;
        $target = $uploadDir . $filename;
        if (!move_uploaded_file($tmp, $target)) {
            return null;
        }

        if ($currentAvatar !== '') {
            $old = $uploadDir . basename($currentAvatar);
            if (is_file($old) && strpos(realpath($old) ?: '', realpath($uploadDir) ?: '') === 0) {
                @unlink($old);
            }
        }

        return $filename;
    }
}
