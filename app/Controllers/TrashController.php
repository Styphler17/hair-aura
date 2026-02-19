<?php
/**
 * Hair Aura - Trash Controller
 * 
 * Handles management of soft-deleted items
 */

namespace App\Controllers;

use App\Core\Database;
use App\Models\Product;
use App\Models\BlogPost;
use App\Core\Auth;

class TrashController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!Auth::isAdmin()) {
            $this->redirect('/admin/login');
        }
    }

    /**
     * View all trashed items
     */
    public function index(): void
    {
        $this->autoCleanup();
        
        $db = Database::getInstance();
        
        // Trashed Products
        $products = [];
        if ($db->hasColumn('products', 'deleted_at')) {
            $products = $db->fetchAll(
                "SELECT id, name, sku, price, deleted_at FROM products WHERE deleted_at IS NOT NULL ORDER BY deleted_at DESC"
            );
        }
        
        // Trashed Blogs
        $blogs = [];
        if ($db->hasColumn('blog_posts', 'deleted_at')) {
            $blogs = $db->fetchAll(
                "SELECT id, title, category, deleted_at FROM blog_posts WHERE deleted_at IS NOT NULL ORDER BY deleted_at DESC"
            );
        }
        
        // Trashed Media
        $media = [];
        if ($db->hasColumn('media_library', 'deleted_at')) {
            $media = $db->fetchAll(
                "SELECT id, file_name, file_path, folder, deleted_at FROM media_library WHERE deleted_at IS NOT NULL ORDER BY deleted_at DESC"
            );
        }

        // Trashed Notes
        $notes = [];
        if ($db->hasColumn('notes', 'deleted_at')) {
            $notes = $db->fetchAll(
                "SELECT id, title, updated_at, deleted_at FROM notes WHERE deleted_at IS NOT NULL AND admin_id = :admin_id ORDER BY deleted_at DESC",
                ['admin_id' => (int) Auth::id()]
            );
        }

        $this->render('admin/trash/index', [
            'products' => $products,
            'blogs' => $blogs,
            'media' => $media,
            'notes' => $notes
        ], 'layouts/admin');
    }

    /**
     * Restore an item from trash
     */
    public function restore(string $type, int $id): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/trash');
        }

        $db = Database::getInstance();
        $success = false;

        switch ($type) {
            case 'product':
                $product = Product::query("SELECT * FROM products WHERE id = :id", ['id' => $id]);
                if ($product) {
                    $db->update('products', ['deleted_at' => null], 'id = :id', ['id' => $id]);
                    $success = true;
                }
                break;
            case 'blog':
                $db->update('blog_posts', ['deleted_at' => null], 'id = :id', ['id' => $id]);
                $success = true;
                break;
            case 'media':
                $db->update('media_library', ['deleted_at' => null], 'id = :id', ['id' => $id]);
                $success = true;
                break;
            case 'note':
                $db->update('notes', ['deleted_at' => null, 'is_archived' => 0], 'id = :id AND admin_id = :admin_id', [
                    'id' => $id,
                    'admin_id' => (int) Auth::id()
                ]);
                $success = true;
                break;
        }

        if ($success) {
            $this->flash('success', ucfirst($type) . ' restored successfully');
        } else {
            $this->flash('error', 'Failed to restore ' . $type);
        }

        $this->redirect('/admin/trash');
    }

    /**
     * Permanently delete an item
     */
    public function permanentDelete(string $type, int $id): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/trash');
        }

        $db = Database::getInstance();
        $success = false;

        try {
            switch ($type) {
                case 'product':
                    $db->beginTransaction();
                    // 1. Remove from Order Items
                    $db->delete('order_items', 'product_id = :id', ['id' => $id]);
                    // 2. Remove Reviews
                    $db->delete('reviews', 'product_id = :id', ['id' => $id]);
                    // 3. Remove Images
                    $db->delete('product_images', 'product_id = :id', ['id' => $id]);
                    // 4. Remove Variants
                    $db->delete('product_variants', 'product_id = :id', ['id' => $id]);
                    // 5. Delete Product
                    $db->delete('products', 'id = :id', ['id' => $id]);
                    $db->commit();
                    $success = true;
                    break;

                case 'blog':
                    $db->delete('blog_posts', 'id = :id', ['id' => $id]);
                    $success = true;
                    break;

                case 'media':
                    $item = $db->fetchOne('SELECT file_path FROM media_library WHERE id = :id', ['id' => $id]);
                    if ($item) {
                        $relative = ltrim((string) $item['file_path'], '/');
                        $absolute = __DIR__ . '/../../public/' . $relative;
                        if (is_file($absolute)) {
                            @unlink($absolute);
                        }
                    }
                    $db->delete('media_library', 'id = :id', ['id' => $id]);
                    $success = true;
                    break;
                case 'note':
                    $db->delete('notes', 'id = :id AND admin_id = :admin_id', [
                        'id' => $id,
                        'admin_id' => (int) Auth::id()
                    ]);
                    $success = true;
                    break;
            }
        } catch (\Throwable $e) {
            if ($db->inTransaction()) $db->rollBack();
            error_log("Permanent Delete Error: " . $e->getMessage());
        }

        if ($success) {
            $this->flash('success', ucfirst($type) . ' permanently deleted');
        } else {
            $this->flash('error', 'Failed to permanently delete ' . $type);
        }

        $this->redirect('/admin/trash');
    }

    /**
     * Empty entire trash
     */
    public function emptyTrash(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/admin/trash');
        }

        $db = Database::getInstance();
        
        // Products
        if ($db->hasColumn('products', 'deleted_at')) {
            $trashedProducts = $db->fetchAll("SELECT id FROM products WHERE deleted_at IS NOT NULL");
            foreach ($trashedProducts as $p) {
                $this->performPermanentDeleteProduct($db, $p['id']);
            }
        }

        // Blogs
        if ($db->hasColumn('blog_posts', 'deleted_at')) {
            $db->query("DELETE FROM blog_posts WHERE deleted_at IS NOT NULL");
        }

        // Media
        if ($db->hasColumn('media_library', 'deleted_at')) {
            $trashedMedia = $db->fetchAll("SELECT id, file_path FROM media_library WHERE deleted_at IS NOT NULL");
            foreach ($trashedMedia as $m) {
                $relative = ltrim((string) $m['file_path'], '/');
                $absolute = __DIR__ . '/../../public/' . $relative;
                if (is_file($absolute)) @unlink($absolute);
                $db->delete('media_library', 'id = :id', ['id' => $m['id']]);
            }
        }

        // Notes
        if ($db->hasColumn('notes', 'deleted_at')) {
            $db->delete('notes', 'deleted_at IS NOT NULL AND admin_id = :admin_id', [
                'admin_id' => (int) Auth::id()
            ]);
        }

        $this->flash('success', 'Trash emptied successfully');
        $this->redirect('/admin/trash');
    }

    private function performPermanentDeleteProduct(Database $db, int $id): void
    {
        $db->beginTransaction();
        try {
            $db->delete('order_items', 'product_id = :id', ['id' => $id]);
            $db->delete('reviews', 'product_id = :id', ['id' => $id]);
            $db->delete('product_images', 'product_id = :id', ['id' => $id]);
            $db->delete('product_variants', 'product_id = :id', ['id' => $id]);
            $db->delete('products', 'id = :id', ['id' => $id]);
            $db->commit();
        } catch (\Throwable $e) {
            $db->rollBack();
            error_log("Empty Trash - Product Error ($id): " . $e->getMessage());
        }
    }

    /**
     * Automatically cleanup items older than 30 days
     */
    private function autoCleanup(): void
    {
        $db = Database::getInstance();
        $dateThreshold = date('Y-m-d H:i:s', strtotime('-30 days'));

        // 1. Products
        if ($db->hasColumn('products', 'deleted_at')) {
            $oldProducts = $db->fetchAll(
                "SELECT id FROM products WHERE deleted_at IS NOT NULL AND deleted_at < :threshold",
                ['threshold' => $dateThreshold]
            );
            foreach ($oldProducts as $p) {
                $this->performPermanentDeleteProduct($db, $p['id']);
            }
        }

        // 2. Blogs
        if ($db->hasColumn('blog_posts', 'deleted_at')) {
            $db->query(
                "DELETE FROM blog_posts WHERE deleted_at IS NOT NULL AND deleted_at < :threshold",
                ['threshold' => $dateThreshold]
            );
        }

        // 3. Media
        if ($db->hasColumn('media_library', 'deleted_at')) {
            $oldMedia = $db->fetchAll(
                "SELECT id, file_path FROM media_library WHERE deleted_at IS NOT NULL AND deleted_at < :threshold",
                ['threshold' => $dateThreshold]
            );
            foreach ($oldMedia as $m) {
                $relative = ltrim((string) $m['file_path'], '/');
                $absolute = __DIR__ . '/../../public/' . $relative;
                if (is_file($absolute)) @unlink($absolute);
                $db->delete('media_library', 'id = :id', ['id' => $m['id']]);
            }
        }

        // 4. Notes
        if ($db->hasColumn('notes', 'deleted_at')) {
            $db->query(
                "DELETE FROM notes WHERE deleted_at IS NOT NULL AND deleted_at < :threshold",
                ['threshold' => $dateThreshold]
            );
        }
    }
}
