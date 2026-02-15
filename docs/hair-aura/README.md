# Hair Aura - Premium Wigs & Hair Extensions E-Commerce

![Hair Aura Logo](public/img/logo.png)

A complete, production-ready PHP MVC e-commerce platform for **hair-aura.debesties.com** - selling premium wigs (human hair, synthetic), extensions, toppers, and hair accessories for the Ghana/Africa market.

## Features

### Customer Features
- **User Authentication**: Register, login, password reset
- **Product Browsing**: Category filtering, search, sorting
- **Product Details**: Image galleries, reviews, size guides
- **Shopping Cart**: Session-based cart with AJAX updates
- **Checkout**: Multi-step checkout with address management
- **Order Tracking**: Track orders by order number and email
- **Wishlist**: Save favorite products for later
- **Reviews**: Write and read product reviews
- **Newsletter**: Email subscription for promotions

### Admin Features
- **Dashboard**: Sales statistics, charts, recent activity
- **Product Management**: CRUD operations, image uploads, variants
- **Order Management**: View, update status, add tracking
- **Customer Management**: View customer details and history
- **Review Moderation**: Approve or reject customer reviews
- **Category Management**: Organize products by category

### Technical Features
- **SEO Optimized**: Dynamic meta tags, sitemap, schema markup
- **Responsive Design**: Mobile-first with Bootstrap 5
- **Security**: CSRF protection, prepared statements, password hashing
- **Performance**: Image optimization, caching, lazy loading
- **Payment Ready**: Stripe and PayPal integration stubs

## Tech Stack

- **Backend**: PHP 8.2+ (Pure MVC - No Framework)
- **Database**: MySQL 8.0 with PDO
- **Frontend**: Bootstrap 5, Swiper.js, Font Awesome
- **Server**: Apache with mod_rewrite

## Installation

### Requirements
- PHP >= 8.2
- MySQL >= 8.0
- Apache with mod_rewrite
- Composer (optional, for dependencies)

### Step 1: Clone/Download
```bash
cd /var/www/html
git clone https://github.com/yourusername/hair-aura.git
cd hair-aura
```

### Step 2: Database Setup
```bash
mysql -u root -p
CREATE DATABASE hair_aura CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit

mysql -u root -p hair_aura < sql/schema.sql
mysql -u root -p hair_aura < sql/seeds.sql
```

If you are upgrading an existing database, apply:

```sql
ALTER TABLE users MODIFY email VARCHAR(255) NULL;
UPDATE users SET email = NULL WHERE role = 'customer';
```

### Step 3: Configuration
```bash
cp .env.example .env
nano .env  # Edit with your database credentials
```

### Step 4: Set Permissions
```bash
chmod -R 755 public/uploads
chown -R www-data:www-data public/uploads
```

### Step 5: Install Dependencies (Optional)
```bash
composer install
```

### Step 6: Configure Apache
Ensure your virtual host points to the `public/` directory:
```apache
<VirtualHost *:80>
    ServerName hair-aura.debesties.com
    DocumentRoot /var/www/html/hair-aura/public
    
    <Directory /var/www/html/hair-aura/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Enable mod_rewrite:
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

## Default Login Credentials

### Admin Account
- **Email**: admin@hair-aura.debesties.com
- **Password**: Admin@123

### Sample Customer Accounts
- **Phone**: +233241234567
- **Password**: Customer@123

Customer login uses **phone + password**. Admin login uses **email + password**.

## Project Structure

```
hair-aura/
├── app/
│   ├── Controllers/      # MVC Controllers
│   ├── Core/            # Core classes (Router, DB, Auth)
│   ├── Models/          # Database models
│   └── Views/           # Templates and layouts
├── config/              # Configuration files
├── public/              # Web root
│   ├── css/            # Stylesheets
│   ├── js/             # JavaScript files
│   ├── img/            # Static images
│   └── uploads/        # User uploads
├── sql/                 # Database files
│   ├── schema.sql      # Database schema
│   └── seeds.sql       # Sample data
├── .env.example         # Environment template
├── composer.json        # PHP dependencies
└── README.md           # This file
```

## SEO Features

- Dynamic meta titles and descriptions
- Schema.org structured data for products
- XML sitemap generation
- Canonical URLs
- Open Graph tags for social sharing
- robots.txt configuration

## Security Features

- CSRF token protection on all forms
- PDO prepared statements (SQL injection prevention)
- Password hashing with bcrypt
- Session security with HTTP-only cookies
- XSS protection headers
- File upload validation

## Security Action Required

- `.env` must not be committed. This repository now ignores `.env`.
- If `.env` or production secrets were committed before, rotate DB, mail, and API credentials immediately.

## Payment Integration

### Stripe (Ready to configure)
1. Add your Stripe keys to `.env`
2. Uncomment Stripe routes in `public/index.php`
3. Configure webhook endpoint

### PayPal (Ready to configure)
1. Add PayPal credentials to `.env`
2. Uncomment PayPal routes in `public/index.php`

## Customization

### Brand Colors
Edit CSS variables in `public/css/style.css`:
```css
:root {
    --primary: #D4A574;      /* Gold accent */
    --accent: #FF6B35;       /* Orange accent */
    --secondary: #2C2C2C;    /* Dark color */
}
```

### Adding Products
1. Login to admin panel
2. Navigate to Products → Add New
3. Fill in product details and upload images

## Performance Optimization

- Enable Apache mod_deflate for compression
- Enable browser caching (configured in .htaccess)
- Use lazy loading for images
- Optimize images before upload

## Troubleshooting

### 404 Errors
- Ensure mod_rewrite is enabled
- Check .htaccess file exists in public/
- Verify Apache AllowOverride is set to All

### Database Connection Errors
- Check .env file credentials
- Ensure MySQL is running
- Verify database exists

### Permission Errors
```bash
chmod -R 755 public/uploads
chown -R www-data:www-data .
```

## Support

For support and inquiries:
- Email: support@hair-aura.debesties.com
- Phone: +233508007873

## License

This is proprietary software. All rights reserved.

Copyright (c) 2024 Hair Aura / Debesties
