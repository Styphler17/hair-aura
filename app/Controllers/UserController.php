<?php
/**
 * Hair Aura - User Controller
 * 
 * Handles user authentication and account management
 * 
 * @package HairAura\Controllers
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Core\Auth;
use App\Core\CartSession;

class UserController extends Controller
{
    /**
     * Login page
     */
    public function login(): void
    {
        if (Auth::check()) {
            $this->redirect('/account');
        }
        
        $seo = [
            'title' => 'Login | Hair Aura',
            'description' => 'Login with your phone number to manage orders and wishlist.',
            'canonical' => '/login'
        ];
        
        $this->render('pages/auth/login', [
            'seo' => $seo
        ], 'layouts/auth');
    }
    
    /**
     * Process login
     */
    public function doLogin(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/login');
        }
        
        $data = $this->post();
        
        $errors = $this->validate($data, [
            'phone' => 'required|min:9',
            'password' => 'required|min:6'
        ]);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $data;
            $this->redirect('/login');
        }
        
        $remember = isset($data['remember']);
        
        if (Auth::attemptByPhone($data['phone'], $data['password'], $remember, 'customer')) {
            // Merge guest cart with user cart
            $cart = new CartSession();
            $userId = Auth::id();
            if ($userId !== null) {
                $cart->mergeWithUser($userId);
            }
            
            // Redirect after login
            $redirect = $_SESSION['redirect_after_login'] ?? '/account';
            unset($_SESSION['redirect_after_login']);

            $authUser = Auth::user();
            $firstName = $authUser?->first_name ?: 'there';
            $this->flash('success', 'Welcome back, ' . $firstName . '!');
            $this->redirect($redirect);
        } else {
            $this->flash('error', 'Invalid phone number or password');
            $_SESSION['old_input'] = $data;
            $this->redirect('/login');
        }
    }
    
    /**
     * Register page
     */
    public function register(): void
    {
        if (Auth::check()) {
            $this->redirect('/account');
        }
        
        $seo = [
            'title' => 'Create Account | Hair Aura',
            'description' => 'Create your Hair Aura account to shop premium wigs and hair extensions.',
            'canonical' => '/register'
        ];
        
        $this->render('pages/auth/register', [
            'seo' => $seo
        ], 'layouts/auth');
    }
    
    /**
     * Process registration
     */
    public function doRegister(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/register');
        }
        
        $data = $this->post();
        
        $errors = $this->validate($data, [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required|min:8',
            'password' => 'required|min:8',
            'password_confirm' => 'required|match:password',
            'terms' => 'required'
        ]);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $data;
            $this->redirect('/register');
        }
        
        // Check if email exists
        if (User::findByEmail($data['email'])) {
            $this->flash('error', 'Email address is already registered');
            $_SESSION['old_input'] = $data;
            $this->redirect('/register');
        }

        if (User::findByPhone($data['phone'])) {
            $this->flash('error', 'Phone number is already registered');
            $_SESSION['old_input'] = $data;
            $this->redirect('/register');
        }
        
        try {
            $user = User::register([
                'email' => $data['email'],
                'password' => $data['password'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone']
            ]);
            
            // Login the new user
            Auth::login($user);
            
            // Merge guest cart
            $cart = new CartSession();
            $userId = (int) ($user->id ?? 0);
            if ($userId > 0) {
                $cart->mergeWithUser($userId);
            }
            
            $this->flash('success', 'Welcome to Hair Aura, ' . $user->first_name . '!');
            $this->redirect('/account');
            
        } catch (\Exception $e) {
            error_log("Registration error: " . $e->getMessage());
            $this->flash('error', 'An error occurred. Please try again.');
            $_SESSION['old_input'] = $data;
            $this->redirect('/register');
        }
    }
    
    /**
     * Logout
     */
    public function logout(): void
    {
        Auth::logout();
        $this->flash('success', 'You have been logged out');
        $this->redirect('/');
    }
    
    /**
     * Forgot password page
     */
    public function forgotPassword(): void
    {
        $seo = [
            'title' => 'Forgot Password | Hair Aura',
            'description' => 'Reset your Hair Aura account password.',
            'canonical' => '/forgot-password'
        ];
        
        $this->render('pages/auth/forgot-password', [
            'seo' => $seo
        ], 'layouts/auth');
    }
    
    /**
     * Process forgot password
     */
    public function doForgotPassword(): void
    {
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/forgot-password');
        }
        
        $email = $this->post('email');
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->flash('error', 'Please enter a valid email address');
            $this->redirect('/forgot-password');
        }
        
        $user = User::findByEmail($email);
        
        if ($user) {
            // Generate reset token
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            $db = \App\Core\Database::getInstance();
            $db->insert('password_resets', [
                'email' => $email,
                'token' => hash('sha256', $token),
                'expires_at' => $expires,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            
            // TODO: Send reset email
            // For now, just show success message
        }
        
        // Always show success to prevent email enumeration
        $this->flash('success', 'If an account exists with this email, you will receive password reset instructions.');
        $this->redirect('/login');
    }
    
    /**
     * Account dashboard
     */
    public function account(): void
    {
        $this->requireAuth();
        
        $orders = $this->user->getOrders(5);
        $wishlist = $this->user->getWishlist();
        
        $seo = [
            'title' => 'My Account | Hair Aura',
            'description' => 'Manage your Hair Aura account, orders, and wishlist.',
            'canonical' => '/account'
        ];
        
        $this->render('pages/account/dashboard', [
            'orders' => $orders,
            'wishlist' => array_slice($wishlist, 0, 4),
            'orderCount' => $this->user->getOrderCount(),
            'totalSpent' => $this->user->getTotalSpent(),
            'seo' => $seo
        ]);
    }
    
    /**
     * Order history
     */
    public function orders(): void
    {
        $this->requireAuth();
        
        $page = (int) ($this->get('page') ?? 1);
        $orders = Order::getByUser($this->user->id, 10);
        
        $seo = [
            'title' => 'My Orders | Hair Aura',
            'description' => 'View your order history at Hair Aura.',
            'canonical' => '/account/orders'
        ];
        
        $this->render('pages/account/orders', [
            'orders' => $orders,
            'seo' => $seo
        ]);
    }
    
    /**
     * Order detail
     */
    public function orderDetail(string $orderNumber): void
    {
        $this->requireAuth();
        
        $order = Order::findByOrderNumber($orderNumber);
        
        if (!$order || $order->user_id !== $this->user->id) {
            $this->flash('error', 'Order not found');
            $this->redirect('/account/orders');
        }
        
        $items = $order->getItems();
        
        $seo = [
            'title' => 'Order #' . $orderNumber . ' | Hair Aura',
            'description' => 'View details of your order.',
            'canonical' => '/account/orders/' . $orderNumber
        ];
        
        $this->render('pages/account/order-detail', [
            'order' => $order,
            'items' => $items,
            'seo' => $seo
        ]);
    }
    
    /**
     * Wishlist
     */
    public function wishlist(): void
    {
        $this->requireAuth();
        
        $wishlist = $this->user->getWishlist();
        
        $seo = [
            'title' => 'My Wishlist | Hair Aura',
            'description' => 'Manage your wishlist at Hair Aura.',
            'canonical' => '/account/wishlist'
        ];
        
        $this->render('pages/account/wishlist', [
            'wishlist' => $wishlist,
            'seo' => $seo
        ]);
    }
    
    /**
     * Add to wishlist (AJAX)
     */
    public function addToWishlist(): void
    {
        $this->requireAuth();
        $isAjax = $this->isAjax();

        if (!$this->validateCsrf()) {
            if ($isAjax) {
                $this->json(['success' => false, 'message' => 'Invalid request']);
            }
            $this->flash('error', 'Invalid request');
            $this->redirect('/account/wishlist');
        }
        
        $productId = (int) $this->post('product_id');
        if ($productId <= 0) {
            if ($isAjax) {
                $this->json(['success' => false, 'message' => 'Invalid product selected']);
            }
            $this->flash('error', 'Invalid product selected');
            $this->redirect('/account/wishlist');
        }
        
        if ($this->user->hasInWishlist($productId)) {
            if ($isAjax) {
                $this->json(['success' => false, 'message' => 'Already in wishlist']);
            }
            $this->flash('info', 'Product is already in your wishlist');
            $this->redirect('/account/wishlist');
        }
        
        $this->user->addToWishlist($productId);

        if ($isAjax) {
            $this->json(['success' => true, 'message' => 'Added to wishlist!']);
        }

        $this->flash('success', 'Added to wishlist');
        $returnTo = (string) $this->post('return_to', '/account/wishlist');
        if (!str_starts_with($returnTo, '/')) {
            $returnTo = '/account/wishlist';
        }
        $this->redirect($returnTo);
    }
    
    /**
     * Remove from wishlist
     */
    public function removeFromWishlist(): void
    {
        $this->requireAuth();
        $isAjax = $this->isAjax();

        if (!$this->validateCsrf()) {
            if ($isAjax) {
                $this->json(['success' => false, 'message' => 'Invalid request']);
            }
            $this->flash('error', 'Invalid request');
            $this->redirect('/account/wishlist');
        }
        
        $productId = (int) $this->post('product_id');
        if ($productId <= 0) {
            if ($isAjax) {
                $this->json(['success' => false, 'message' => 'Invalid product selected']);
            }
            $this->flash('error', 'Invalid product selected');
            $this->redirect('/account/wishlist');
        }

        $this->user->removeFromWishlist($productId);

        if ($isAjax) {
            $this->json(['success' => true, 'message' => 'Removed from wishlist']);
        }

        $this->flash('success', 'Removed from wishlist');
        $returnTo = (string) $this->post('return_to', '/account/wishlist');
        if (!str_starts_with($returnTo, '/')) {
            $returnTo = '/account/wishlist';
        }
        $this->redirect($returnTo);
    }
    
    /**
     * Profile page
     */
    public function profile(): void
    {
        $this->requireAuth();
        
        $seo = [
            'title' => 'My Profile | Hair Aura',
            'description' => 'Manage your profile at Hair Aura.',
            'canonical' => '/account/profile'
        ];
        
        $this->render('pages/account/profile', [
            'seo' => $seo
        ]);
    }
    
    /**
     * Update profile
     */
    public function updateProfile(): void
    {
        $this->requireAuth();
        
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/account/profile');
        }
        
        $data = $this->post();
        
        $errors = $this->validate($data, [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'phone' => 'required|min:8'
        ]);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->redirect('/account/profile');
        }

        $phone = User::normalizePhone((string) ($data['phone'] ?? ''));
        if ($phone === '') {
            $this->flash('error', 'Please provide a valid phone number');
            $this->redirect('/account/profile');
        }

        $db = \App\Core\Database::getInstance();
        $phoneExists = $db->fetchOne(
            "SELECT id FROM users
             WHERE REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(phone, '+', ''), ' ', ''), '-', ''), '(', ''), ')', '') = :digits
             AND id != :id
             LIMIT 1",
            [
                'digits' => preg_replace('/\D+/', '', $phone),
                'id' => (int) $this->user->id
            ]
        );
        if ($phoneExists) {
            $this->flash('error', 'Phone number is already in use');
            $this->redirect('/account/profile');
        }

        $avatarFilename = $this->uploadAvatar('avatar', (string) ($this->user->avatar ?? ''));

        $profileData = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $phone
        ];
        if ($avatarFilename !== null) {
            $profileData['avatar'] = $avatarFilename;
        }

        $this->user->update($profileData);
        
        $this->flash('success', 'Profile updated successfully');
        $this->redirect('/account/profile');
    }
    
    /**
     * Change password
     */
    public function changePassword(): void
    {
        $this->requireAuth();
        
        if (!$this->validateCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect('/account/profile');
        }
        
        $data = $this->post();
        
        $errors = $this->validate($data, [
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|match:new_password'
        ]);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->redirect('/account/profile');
        }
        
        // Verify current password
        if (!password_verify($data['current_password'], $this->user->password_hash)) {
            $this->flash('error', 'Current password is incorrect');
            $this->redirect('/account/profile');
        }
        
        $this->user->update([
            'password_hash' => password_hash($data['new_password'], PASSWORD_BCRYPT)
        ]);
        
        $this->flash('success', 'Password changed successfully');
        $this->redirect('/account/profile');
    }
    
    /**
     * Addresses page
     */
    public function addresses(): void
    {
        $this->requireAuth();
        
        $addresses = $this->user->getAddresses();
        
        $seo = [
            'title' => 'My Addresses | Hair Aura',
            'description' => 'Manage your addresses at Hair Aura.',
            'canonical' => '/account/addresses'
        ];
        
        $this->render('pages/account/addresses', [
            'addresses' => $addresses,
            'seo' => $seo
        ]);
    }
    
    /**
     * Track order
     */
    public function trackOrder(): void
    {
        $orderNumber = $this->get('order');
        $email = $this->get('email');
        
        $order = null;
        $error = null;
        
        if ($orderNumber && $email) {
            $order = Order::findByOrderNumber($orderNumber);
            
            if (!$order) {
                $error = 'Order not found';
            } elseif ($order->user_id) {
                // Registered user order - require login
                if (!Auth::check() || $order->user_id !== Auth::id()) {
                    $error = 'Please login to track this order';
                    $order = null;
                }
            } elseif ($order->guest_email !== $email) {
                $error = 'Email does not match order';
                $order = null;
            }
        }
        
        $seo = [
            'title' => 'Track Order | Hair Aura',
            'description' => 'Track your Hair Aura order status.',
            'canonical' => '/track-order'
        ];
        
        $this->render('pages/track-order', [
            'order' => $order,
            'error' => $error,
            'orderNumber' => $orderNumber,
            'email' => $email,
            'seo' => $seo
        ]);
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
