-- Hair Aura E-Commerce Seed Data
-- Sample data for development and testing

USE hair_aura;

-- ============================================
-- ADMIN USER (Password: Admin@123)
-- ============================================
INSERT INTO `users` (`email`, `password_hash`, `first_name`, `last_name`, `phone`, `role`, `is_active`, `email_verified`) VALUES
('admin@hair-aura.debesties.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System', 'Administrator', '+233201234567', 'admin', 1, 1);

-- ============================================
-- SAMPLE CUSTOMERS (Password: Customer@123)
-- ============================================
INSERT INTO `users` (`email`, `password_hash`, `first_name`, `last_name`, `phone`, `role`, `is_active`, `email_verified`) VALUES
('ama.owusu@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ama', 'Owusu', '+233241234567', 'customer', 1, 1),
('kwasi.mensah@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Kwasi', 'Mensah', '+233551234567', 'customer', 1, 1),
('abena.darko@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Abena', 'Darko', '+233201234568', 'customer', 1, 1),
('yaa.asantewaa@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Yaa', 'Asantewaa', '+233501234567', 'customer', 1, 1);

-- ============================================
-- CATEGORIES
-- ============================================
INSERT INTO `categories` (`name`, `slug`, `description`, `image`, `sort_order`, `meta_title`, `meta_description`) VALUES
('Human Hair Wigs', 'human-hair-wigs', 'Premium 100% human hair wigs for natural look and feel. Available in various textures, lengths, and styles.', 'category-human-hair.jpg', 1, 'Buy Human Hair Wigs Ghana | Premium Quality', 'Shop authentic human hair wigs in Ghana. Brazilian, Peruvian, and Indian hair. Free delivery in Accra.'),
('Lace Front Wigs', 'lace-front-wigs', 'Beautiful lace front wigs with natural hairline. HD lace, transparent lace options available.', 'category-lace-front.jpg', 2, 'Lace Front Wigs Ghana | Natural Hairline', 'Get natural-looking lace front wigs in Ghana. HD lace, 13x4 and 13x6 lace fronts.'),
('Synthetic Wigs', 'synthetic-wigs', 'Affordable synthetic wigs in trendy styles. Heat-resistant fibers, easy maintenance.', 'category-synthetic.jpg', 3, 'Synthetic Wigs Ghana | Affordable Styles', 'Shop affordable synthetic wigs in Ghana. Heat-resistant, trendy styles, budget-friendly.'),
('Hair Extensions', 'hair-extensions', 'Premium hair extensions - weaves, bundles, clip-ins. 100% virgin human hair.', 'category-extensions.jpg', 4, 'Hair Extensions Ghana | Virgin Hair Bundles', 'Buy virgin hair extensions in Ghana. Brazilian, Peruvian bundles. Wholesale available.'),
('Hair Toppers', 'hair-toppers', 'Hair toppers and closures for added volume. Perfect for thinning hair solutions.', 'category-toppers.jpg', 5, 'Hair Toppers Ghana | Volume Solutions', 'Hair toppers for volume and coverage. Closures, frontals, and crown toppers.'),
('Hair Accessories', 'hair-accessories', 'Wig care products, caps, adhesives, and styling tools.', 'category-accessories.jpg', 6, 'Wig Accessories Ghana | Care Products', 'Wig care products, adhesives, caps, and styling tools. Everything for wig maintenance.');

-- ============================================
-- PRODUCTS (20 Sample Products)
-- ============================================

-- Human Hair Wigs
INSERT INTO `products` (`name`, `slug`, `description`, `short_description`, `price`, `sale_price`, `sku`, `stock_quantity`, `category_id`, `brand`, `hair_type`, `texture`, `length_inches`, `weight_grams`, `cap_size`, `lace_type`, `density`, `color`, `featured`, `bestseller`, `new_arrival`, `meta_title`, `meta_description`) VALUES
('Brazilian Body Wave Lace Front Wig', 'brazilian-body-wave-lace-front', 
'<p>Experience the luxury of 100% Brazilian virgin hair with our Body Wave Lace Front Wig. This stunning wig features:</p>
<ul>
<li>100% unprocessed Brazilian human hair</li>
<li>Natural body wave pattern</li>
<li>13x4 HD transparent lace frontal</li>
<li>Pre-plucked hairline with baby hairs</li>
<li>180% density for full, voluminous look</li>
<li>Can be dyed, bleached, and heat styled</li>
<li>Natural black color (1B)</li>
<li>Adjustable straps and combs for secure fit</li>
</ul>
<p>Perfect for everyday wear or special occasions. The body wave texture gives you that glamorous, red-carpet look while maintaining a natural appearance. Our HD lace melts into any skin tone for an undetectable finish.</p>
<p><strong>Care Instructions:</strong> Wash with sulfate-free shampoo, condition regularly, and air dry for best results. Use heat protectant when styling.</p>', 
'100% Brazilian virgin hair body wave wig with HD lace frontal. 180% density, pre-plucked hairline.', 
185.00, 159.99, 'BW-BODY-18', 25, 1, 'Hair Aura', 'human_hair', 'body_wave', 18, 250, 'medium', 'hd_lace', '180%', '1B Natural Black', 1, 1, 0,
'Brazilian Body Wave Wig Ghana | HD Lace Front', 'Buy Brazilian body wave lace front wig in Ghana. 100% virgin hair, HD lace, 180% density. Free delivery in Accra.'),

('Peruvian Straight Lace Front Wig', 'peruvian-straight-lace-front',
'<p>Achieve sleek, sophisticated style with our Peruvian Straight Lace Front Wig. Features include:</p>
<ul>
<li>100% Peruvian virgin human hair</li>
<li>Silky straight texture</li>
<li>13x6 deep part lace frontal</li>
<li>Pre-plucked with natural baby hairs</li>
<li>150% density</li>
<li>Tangle-free and minimal shedding</li>
<li>Can be flat ironed and curled</li>
<li>Medium cap size with adjustable bands</li>
</ul>
<p>The Peruvian straight texture is known for its softness and natural shine. This wig is perfect for professional settings or when you want a polished, elegant look.</p>',
'Sleek Peruvian straight wig with 13x6 deep part lace. Silky, soft, and tangle-free.',
165.00, NULL, 'PW-STRAIGHT-20', 18, 1, 'Hair Aura', 'human_hair', 'straight', 20, 280, 'medium', 'transparent_lace', '150%', '1B Natural Black', 1, 0, 1,
'Peruvian Straight Wig Ghana | Deep Part Lace', 'Shop Peruvian straight lace front wig in Ghana. 13x6 deep part, silky texture. Premium quality hair.'),

('Deep Curly Human Hair Wig', 'deep-curly-human-hair-wig',
'<p>Embrace your curls with our gorgeous Deep Curly Human Hair Wig:</p>
<ul>
<li>100% Brazilian virgin hair</li>
<li>Deep curly/water wave pattern</li>
<li>4x4 lace closure</li>
<li>200% density for maximum volume</li>
<li>Bleached knots for natural scalp appearance</li>
<li>Can be straightened and will return to curl</li>
<li>Free parting for versatile styling</li>
</ul>
<p>This wig is perfect for those who love big, beautiful curls. The deep curly pattern gives you that tropical, beach-ready look all year round.</p>',
'Voluminous deep curly wig with 4x4 lace closure. 200% density for maximum curl definition.',
195.00, 175.00, 'BW-CURLY-22', 15, 1, 'Hair Aura', 'human_hair', 'deep_curly', 22, 320, 'medium', 'lace_closure', '200%', '1B Natural Black', 1, 1, 0,
'Deep Curly Wig Ghana | 200% Density', 'Buy deep curly human hair wig in Ghana. 200% density, 4x4 closure. Big, beautiful curls.'),

('Kinky Straight Lace Wig', 'kinky-straight-lace-wig',
'<p>Get that blown-out natural look with our Kinky Straight Lace Wig:</p>
<ul>
<li>100% human hair with kinky straight texture</li>
<li>Mimics natural Afro hair when blow-dried</li>
<li>13x4 lace frontal</li>
<li>180% density</li>
<li>Pre-plucked hairline</li>
<li>Can be curled for versatile styling</li>
</ul>
<p>Perfect for those who want a natural, textured look that blends seamlessly with African hair types.</p>',
'Natural kinky straight texture wig. Mimics blown-out Afro hair. 13x4 lace frontal.',
175.00, NULL, 'BW-KINKY-16', 20, 1, 'Hair Aura', 'human_hair', 'kinky_straight', 16, 240, 'medium', 'hd_lace', '180%', '1B Natural Black', 0, 1, 0,
'Kinky Straight Wig Ghana | Natural Texture', 'Shop kinky straight lace wig in Ghana. Natural blown-out look. Perfect for African hair texture.'),

('Blonde Highlight Body Wave Wig', 'blonde-highlight-body-wave',
'<p>Make a statement with our Blonde Highlight Body Wave Wig:</p>
<ul>
<li>100% Brazilian human hair</li>
<li>Beautiful blonde highlights on brown base</li>
<li>13x4 lace frontal</li>
<li>150% density</li>
<li>Pre-colored, ready to wear</li>
<li>Can be restyled with heat tools</li>
</ul>
<p>This stunning highlighted wig is perfect for those who want to experiment with color without damaging their natural hair.</p>',
'Stunning blonde highlight wig with body wave texture. Pre-colored and ready to wear.',
210.00, 189.99, 'BW-HIGHLIGHT-18', 12, 1, 'Hair Aura', 'human_hair', 'body_wave', 18, 260, 'medium', 'transparent_lace', '150%', 'P4/27 Highlight', 1, 0, 1,
'Blonde Highlight Wig Ghana | Colored Hair', 'Buy blonde highlight body wave wig in Ghana. Pre-colored, no damage to natural hair.'),

-- Lace Front Wigs
('HD Transparent Lace Frontal Wig', 'hd-transparent-lace-frontal',
'<p>The ultimate in undetectable wigs - our HD Transparent Lace Frontal:</p>
<ul>
<li>HD lace that melts into any skin tone</li>
<li>100% virgin human hair</li>
<li>13x6 frontal for deep parting</li>
<li>200% density</li>
<li>Invisible knots</li>
<li>Can be parted anywhere</li>
</ul>
<p>Our HD lace is the most advanced lace technology, virtually invisible on all skin tones.</p>',
'HD transparent lace wig that melts into any skin tone. 13x6 frontal, 200% density.',
245.00, 219.99, 'HD-FRONTAL-20', 10, 2, 'Hair Aura', 'human_hair', 'straight', 20, 300, 'medium', 'hd_lace', '200%', '1B Natural Black', 1, 0, 1,
'HD Lace Wig Ghana | Transparent Lace', 'Shop HD transparent lace frontal wig in Ghana. Melts into any skin tone. Undetectable lace.'),

('360 Lace Frontal Wig', '360-lace-frontal-wig',
'<p>Style your hair in any direction with our 360 Lace Frontal Wig:</p>
<ul>
<li>Lace all around the perimeter</li>
<li>Can be worn in high ponytails</li>
<li>100% Brazilian virgin hair</li>
<li>Body wave texture</li>
<li>150% density</li>
<li>Adjustable straps inside</li>
</ul>
<p>The 360 lace design gives you maximum styling versatility - high ponytails, updos, half-up styles, and more.</p>',
'360 lace wig for versatile styling. Wear in high ponytails. Lace all around perimeter.',
225.00, NULL, '360-LACE-18', 14, 2, 'Hair Aura', 'human_hair', 'body_wave', 18, 280, 'medium', 'transparent_lace', '150%', '1B Natural Black', 0, 1, 0,
'360 Lace Wig Ghana | Ponytail Ready', 'Buy 360 lace frontal wig in Ghana. High ponytail ready. Full perimeter lace.'),

('Bob Lace Front Wig', 'bob-lace-front-wig',
'<p>Chic and stylish Bob Lace Front Wig:</p>
<ul>
<li>100% human hair</li>
<li>12-inch bob cut</li>
<li>13x4 lace frontal</li>
<li>Blunt cut or layered options</li>
<li>130% density</li>
<li>Low maintenance</li>
</ul>
<p>The perfect bob wig for a sophisticated, professional look. Easy to maintain and style.</p>',
'Chic bob wig with lace frontal. 12 inches, professional style. Low maintenance.',
145.00, 129.99, 'BOB-LACE-12', 22, 2, 'Hair Aura', 'human_hair', 'straight', 12, 180, 'medium', 'transparent_lace', '130%', '1B Natural Black', 1, 1, 0,
'Bob Wig Ghana | Lace Front Short Hair', 'Shop bob lace front wig in Ghana. 12-inch chic cut. Professional style.'),

('Water Wave Lace Front Wig', 'water-wave-lace-front',
'<p>Beautiful Water Wave Lace Front Wig:</p>
<ul>
<li>100% virgin human hair</li>
<li>Water wave pattern</li>
<li>13x4 lace frontal</li>
<li>180% density</li>
<li>Natural wet look</li>
<li>Can be straightened</li>
</ul>
<p>The water wave pattern gives you that beautiful "wet hair" look that\'s so popular right now.</p>',
'Water wave pattern wig with wet look. 13x4 lace frontal, 180% density.',
195.00, NULL, 'WW-LACE-20', 16, 2, 'Hair Aura', 'human_hair', 'water_wave', 20, 290, 'medium', 'transparent_lace', '180%', '1B Natural Black', 0, 0, 1,
'Water Wave Wig Ghana | Wet Look', 'Buy water wave lace front wig in Ghana. Beautiful wet hair look. Trendy style.'),

-- Synthetic Wigs
('Heat Resistant Synthetic Curly Wig', 'heat-resistant-synthetic-curly',
'<p>Affordable beauty with our Heat Resistant Synthetic Curly Wig:</p>
<ul>
<li>High-quality heat-resistant fiber</li>
<li>Can withstand heat up to 180°C</li>
<li>Beautiful curly pattern</li>
<li>Adjustable cap</li>
<li>Multiple color options</li>
<li>Easy maintenance</li>
</ul>
<p>Perfect for trying new styles without breaking the bank. The heat-resistant fiber allows for some styling versatility.</p>',
'Heat-resistant synthetic curly wig. Up to 180°C styling. Affordable and stylish.',
65.00, 49.99, 'SYN-CURLY-16', 35, 3, 'Hair Aura', 'synthetic', 'curly', 16, 200, 'average', NULL, NULL, '1B', 1, 1, 0,
'Synthetic Curly Wig Ghana | Heat Resistant', 'Shop heat-resistant synthetic curly wig in Ghana. Affordable, trendy styles.'),

('Long Straight Synthetic Wig', 'long-straight-synthetic',
'<p>Glamorous long straight synthetic wig:</p>
<ul>
<li>High-quality synthetic fiber</li>
<li>26 inches long</li>
<li>Yaki texture for natural look</li>
<li>Adjustable straps</li>
<li>Natural black color</li>
</ul>
<p>Get that long, sleek look instantly with this affordable synthetic option.</p>',
'26-inch long straight synthetic wig. Yaki texture for natural appearance.',
75.00, NULL, 'SYN-LONG-26', 28, 3, 'Hair Aura', 'synthetic', 'straight', 26, 250, 'average', NULL, NULL, '1B', 0, 0, 1,
'Long Synthetic Wig Ghana | 26 Inch', 'Buy long straight synthetic wig in Ghana. 26 inches, yaki texture. Budget-friendly.'),

('Short Pixie Synthetic Wig', 'short-pixie-synthetic',
'<p>Bold and beautiful Short Pixie Wig:</p>
<ul>
<li>High-quality synthetic fiber</li>
<li>Pixie cut style</li>
<li>Multiple color options</li>
<li>Ready to wear</li>
<li>Lightweight and comfortable</li>
</ul>
<p>Perfect for summer or when you want a bold, low-maintenance look.</p>',
'Bold pixie cut synthetic wig. Short, stylish, and easy to maintain.',
55.00, 45.00, 'SYN-PIXIE-8', 40, 3, 'Hair Aura', 'synthetic', 'straight', 8, 120, 'average', NULL, NULL, '1B', 1, 0, 0,
'Pixie Wig Ghana | Short Synthetic Hair', 'Shop short pixie synthetic wig in Ghana. Bold style, easy maintenance.'),

('Ombre Synthetic Wig', 'ombre-synthetic-wig',
'<p>Trendy ombre color synthetic wig:</p>
<ul>
<li>Beautiful ombre color transition</li>
<li>High-quality fiber</li>
<li>Body wave style</li>
<li>Heat resistant</li>
<li>18 inches</li>
</ul>
<p>Get the trendy ombre look without any chemical processing.</p>',
'Trendy ombre synthetic wig. Beautiful color transition, body wave style.',
85.00, 69.99, 'SYN-OMBRE-18', 25, 3, 'Hair Aura', 'synthetic', 'body_wave', 18, 220, 'average', NULL, NULL, 'T1B/30', 1, 1, 1,
'Ombre Wig Ghana | Colored Synthetic', 'Buy ombre synthetic wig in Ghana. Trendy colors, no chemical damage.'),

-- Hair Extensions
('Brazilian Virgin Hair Bundles', 'brazilian-virgin-bundles',
'<p>Premium Brazilian Virgin Hair Bundles:</p>
<ul>
<li>100% unprocessed Brazilian hair</li>
<li>Single donor hair</li>
<li>Double machine weft</li>
<li>No shedding, no tangles</li>
<li>Can be dyed and bleached</li>
<li>Available in various lengths</li>
</ul>
<p>Our Brazilian bundles are the highest quality, perfect for sew-ins and wig making.</p>',
'Premium Brazilian virgin hair bundles. Single donor, double weft. No shedding.',
85.00, NULL, 'EXT-BRZ-12', 50, 4, 'Hair Aura', 'human_hair', 'body_wave', 12, 100, NULL, NULL, NULL, '1B', 1, 1, 0,
'Brazilian Bundles Ghana | Virgin Hair', 'Shop Brazilian virgin hair bundles in Ghana. Single donor, double weft. Wholesale available.'),

('Peruvian Straight Bundles', 'peruvian-straight-bundles',
'<p>Silky Peruvian Straight Bundles:</p>
<ul>
<li>100% Peruvian virgin hair</li>
<li>Silky straight texture</li>
<li>Thick from top to bottom</li>
<li>Minimal shedding</li>
<li>Can be curled</li>
</ul>
<p>Peruvian hair is known for its thickness and versatility. These bundles blend beautifully with natural hair.</p>',
'Silky Peruvian straight bundles. Thick, full, and versatile styling.',
95.00, 85.00, 'EXT-PER-14', 40, 4, 'Hair Aura', 'human_hair', 'straight', 14, 110, NULL, NULL, NULL, '1B', 0, 0, 1,
'Peruvian Bundles Ghana | Straight Hair', 'Buy Peruvian straight bundles in Ghana. Silky texture, thick and full.'),

('Clip-In Hair Extensions', 'clip-in-extensions',
'<p>Easy-to-use Clip-In Hair Extensions:</p>
<ul>
<li>100% human hair</li>
<li>7-piece set</li>
<li>Clip attachments included</li>
<li>120 grams total weight</li>
<li>Can be styled with heat</li>
</ul>
<p>The easiest way to add length and volume instantly. Perfect for special occasions.</p>',
'7-piece clip-in extension set. 100% human hair, easy application.',
120.00, NULL, 'EXT-CLIP-18', 30, 4, 'Hair Aura', 'human_hair', 'straight', 18, 120, NULL, NULL, NULL, '1B', 1, 0, 0,
'Clip-In Extensions Ghana | Human Hair', 'Shop clip-in hair extensions in Ghana. Easy application, instant volume.'),

-- Hair Toppers
('Silk Base Hair Topper', 'silk-base-hair-topper',
'<p>Premium Silk Base Hair Topper for thinning hair:</p>
<ul>
<li>100% human hair</li>
<li>Silk base for most natural look</li>
<li>Covers crown area</li>
<li>Clips for secure attachment</li>
<li>Various sizes available</li>
</ul>
<p>The perfect solution for thinning hair or adding volume to the crown area.</p>',
'Silk base hair topper for thinning hair. Natural look, secure clips.',
150.00, 135.00, 'TOP-SILK-12', 20, 5, 'Hair Aura', 'human_hair', 'straight', 12, 80, NULL, 'silk_base', NULL, '1B', 1, 0, 0,
'Hair Topper Ghana | Silk Base', 'Buy silk base hair topper in Ghana. Solution for thinning hair. Natural look.'),

('Lace Closure 4x4', 'lace-closure-4x4',
'<p>Versatile 4x4 Lace Closure:</p>
<ul>
<li>100% human hair</li>
<li>4x4 inch lace area</li>
<li>Free part/middle part/three part options</li>
<li>Bleached knots available</li>
<li>Perfect for sew-ins</li>
</ul>
<p>Essential for completing your sew-in install with a natural-looking part.</p>',
'4x4 lace closure for sew-ins. Free parting, bleached knots available.',
75.00, NULL, 'CLS-4X4-14', 35, 5, 'Hair Aura', 'human_hair', 'body_wave', 14, 40, NULL, 'lace_closure', NULL, '1B', 0, 1, 0,
'Lace Closure Ghana | 4x4 Sew-In', 'Shop 4x4 lace closure in Ghana. Free parting, perfect for sew-ins.'),

-- Hair Accessories
('Wig Grip Band', 'wig-grip-band',
'<p>Essential Wig Grip Band:</p>
<ul>
<li>Velvet material</li>
<li>Keeps wigs secure</li>
<li>Prevents slipping</li>
<li>Adjustable fit</li>
<li>Protects edges</li>
</ul>
<p>A must-have accessory for secure, comfortable wig wear.</p>',
'Velvet wig grip band. Keeps wigs secure, protects edges.',
25.00, NULL, 'ACC-GRIP-01', 100, 6, 'Hair Aura', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Black', 0, 1, 0,
'Wig Grip Ghana | Secure Fit', 'Buy wig grip band in Ghana. Secure fit, protects edges. Essential accessory.'),

('Lace Wig Adhesive', 'lace-wig-adhesive',
'<p>Professional Lace Wig Adhesive:</p>
<ul>
<li>Strong hold</li>
<li>Waterproof</li>
<li>Safe for skin</li>
<li>Clear drying</li>
<li>Long-lasting</li>
</ul>
<p>Professional-grade adhesive for secure lace front application.</p>',
'Professional lace wig adhesive. Strong, waterproof, skin-safe hold.',
45.00, 39.99, 'ACC-GLUE-01', 60, 6, 'Hair Aura', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1,
'Wig Adhesive Ghana | Strong Hold', 'Shop lace wig adhesive in Ghana. Professional grade, waterproof hold.');

-- ============================================
-- PRODUCT IMAGES
-- ============================================
INSERT INTO `product_images` (`product_id`, `image_path`, `alt_text`, `is_primary`, `sort_order`) VALUES
(1, 'products/brazilian-body-wave-1.jpg', 'Brazilian Body Wave Lace Front Wig - Front View', 1, 1),
(1, 'products/brazilian-body-wave-2.jpg', 'Brazilian Body Wave Wig - Side View', 0, 2),
(1, 'products/brazilian-body-wave-3.jpg', 'Brazilian Body Wave Wig - Back View', 0, 3),
(2, 'products/peruvian-straight-1.jpg', 'Peruvian Straight Lace Front Wig', 1, 1),
(3, 'products/deep-curly-1.jpg', 'Deep Curly Human Hair Wig', 1, 1),
(4, 'products/kinky-straight-1.jpg', 'Kinky Straight Lace Wig', 1, 1),
(5, 'products/blonde-highlight-1.jpg', 'Blonde Highlight Body Wave Wig', 1, 1),
(6, 'products/hd-lace-1.jpg', 'HD Transparent Lace Frontal Wig', 1, 1),
(7, 'products/360-lace-1.jpg', '360 Lace Frontal Wig', 1, 1),
(8, 'products/bob-wig-1.jpg', 'Bob Lace Front Wig', 1, 1),
(9, 'products/water-wave-1.jpg', 'Water Wave Lace Front Wig', 1, 1),
(10, 'products/synthetic-curly-1.jpg', 'Heat Resistant Synthetic Curly Wig', 1, 1),
(11, 'products/synthetic-long-1.jpg', 'Long Straight Synthetic Wig', 1, 1),
(12, 'products/pixie-wig-1.jpg', 'Short Pixie Synthetic Wig', 1, 1),
(13, 'products/ombre-wig-1.jpg', 'Ombre Synthetic Wig', 1, 1),
(14, 'products/brazilian-bundles-1.jpg', 'Brazilian Virgin Hair Bundles', 1, 1),
(15, 'products/peruvian-bundles-1.jpg', 'Peruvian Straight Bundles', 1, 1),
(16, 'products/clip-in-1.jpg', 'Clip-In Hair Extensions', 1, 1),
(17, 'products/silk-topper-1.jpg', 'Silk Base Hair Topper', 1, 1),
(18, 'products/lace-closure-1.jpg', 'Lace Closure 4x4', 1, 1),
(19, 'products/wig-grip-1.jpg', 'Wig Grip Band', 1, 1),
(20, 'products/wig-adhesive-1.jpg', 'Lace Wig Adhesive', 1, 1);

-- ============================================
-- TESTIMONIALS
-- ============================================
INSERT INTO `testimonials` (`customer_name`, `customer_location`, `rating`, `title`, `content`, `is_featured`, `sort_order`) VALUES
('Ama Owusu', 'Accra, Ghana', 5, 'Best Wigs in Ghana!', 'I\'ve been buying wigs from Hair Aura for over a year now, and the quality is consistently amazing. The Brazilian body wave is my favorite - it lasts for months with proper care. Customer service is excellent too!', 1, 1),
('Kwasi Mensah', 'Kumasi, Ghana', 5, 'My Wife Loves It', 'Bought a lace front wig for my wife\'s birthday and she absolutely loves it! The HD lace is truly undetectable. Will definitely be ordering again.', 1, 2),
('Abena Darko', 'Tema, Ghana', 5, 'Fast Delivery & Great Quality', 'Ordered on Monday, received on Wednesday in Tema! The Peruvian straight wig is so soft and silky. No shedding at all. Highly recommend!', 1, 3),
('Yaa Asantewaa', 'Sunyani, Ghana', 5, 'Changed My Look Completely', 'The kinky straight wig blends perfectly with my natural hair. I get compliments everywhere I go. Thank you Hair Aura for helping me unlock my aura!', 1, 4),
('Efua Mensah', 'Cape Coast, Ghana', 5, 'Professional Quality', 'As a makeup artist, I recommend Hair Aura to all my clients. The quality is professional grade and the prices are fair. The 360 lace wigs are perfect for bridal styling.', 0, 5),
('Kofi Addo', 'Takoradi, Ghana', 4, 'Great Value for Money', 'Bought the synthetic curly wig for my sister and she loves it. Great quality for the price. Delivery was prompt.', 0, 6);

-- ============================================
-- BLOG POSTS
-- ============================================
INSERT INTO `blog_posts` (`title`, `slug`, `excerpt`, `content`, `author_id`, `category`, `tags`, `meta_title`, `meta_description`, `is_published`, `published_at`) VALUES
('How to Care for Your Human Hair Wig', 'how-to-care-human-hair-wig',
'Learn the essential tips for maintaining your human hair wig to ensure it lasts for years.',
'<h2>Proper Care Makes All the Difference</h2>
<p>Investing in a quality human hair wig is just the first step. Proper care and maintenance are essential to ensure your wig stays beautiful and lasts for years to come.</p>

<h3>Washing Your Wig</h3>
<p>Wash your human hair wig every 7-10 wears, or when product buildup becomes noticeable:</p>
<ul>
<li>Use sulfate-free shampoo and conditioner</li>
<li>Detangle gently before washing</li>
<li>Wash in cool water, never hot</li>
<li>Pat dry with a towel - never rub</li>
<li>Air dry on a wig stand</li>
</ul>

<h3>Styling Tips</h3>
<p>Human hair wigs can be styled just like your natural hair:</p>
<ul>
<li>Always use heat protectant before styling</li>
<li>Keep heat tools below 180°C</li>
<li>Deep condition monthly</li>
<li>Store on a wig stand when not in use</li>
</ul>

<h3>Nighttime Care</h3>
<p>Never sleep in your wig! Remove it before bed and store properly to maintain its shape and prevent tangling.</p>

<p>Follow these tips and your Hair Aura wig will maintain its beauty for years!</p>',
1, 'Wig Care', 'wig care, human hair, maintenance, washing',
'How to Care for Human Hair Wig Ghana | Hair Aura',
'Learn essential tips for caring for your human hair wig. Washing, styling, and maintenance guide from Hair Aura.',
1, NOW()),

('Choosing the Right Wig for Your Face Shape', 'choosing-wig-face-shape',
'Find the perfect wig style that complements your unique face shape.',
'<h2>The Perfect Wig for Every Face</h2>
<p>Not all wigs suit every face shape. Understanding your face shape is key to choosing a wig that enhances your natural beauty.</p>

<h3>Oval Face Shape</h3>
<p>Lucky you! Oval faces can pull off almost any wig style. Try:</p>
<ul>
<li>Long layers</li>
<li>Bob cuts</li>
<li>Curly or straight styles</li>
</ul>

<h3>Round Face Shape</h3>
<p>Create the illusion of length with:</p>
<ul>
<li>Long, layered wigs</li>
<li>Side-swept bangs</li>
<li>Height at the crown</li>
<li>Avoid chin-length bobs</li>
</ul>

<h3>Square Face Shape</h3>
<p>Soften angular features with:</p>
<ul>
<li>Wavy or curly textures</li>
<li>Side parts</li>
<li>Layers around the face</li>
<li>Avoid blunt cuts</li>
</ul>

<h3>Heart Face Shape</h3>
<p>Balance a wider forehead with:</p>
<ul>
<li>Chin-length bobs</li>
<li>Side-swept bangs</li>
<li>Volume at the jawline</li>
</ul>

<p>Visit Hair Aura to find your perfect wig match!</p>',
1, 'Wig Guide', 'face shape, wig selection, styling tips',
'Choose Wig for Face Shape Ghana | Hair Aura Guide',
'Find the perfect wig for your face shape. Expert guide from Hair Aura on selecting flattering wig styles.',
1, NOW()),

('Lace Front vs Full Lace Wigs: What\'s the Difference?', 'lace-front-vs-full-lace',
'Understanding the differences between lace front and full lace wigs to make the right choice.',
'<h2>Lace Front vs Full Lace: The Breakdown</h2>
<p>When shopping for wigs, you\'ll often see "lace front" and "full lace" options. But what\'s the difference, and which is right for you?</p>

<h3>Lace Front Wigs</h3>
<p>Lace front wigs have lace only at the front hairline:</p>
<ul>
<li>More affordable</li>
<li>Natural-looking hairline</li>
<li>Cannot be parted everywhere</li>
<li>Less styling versatility</li>
<li>More durable construction</li>
</ul>

<h3>Full Lace Wigs</h3>
<p>Full lace wigs have lace covering the entire cap:</p>
<ul>
<li>Can be parted anywhere</li>
<li>Can be worn in high ponytails</li>
<li>More breathable</li>
<li>Higher price point</li>
<li>Requires more careful handling</li>
</ul>

<h3>Which Should You Choose?</h3>
<p>Choose lace front if you:</p>
<ul>
<li>Want a natural look on a budget</li>
<li>Don\'t need high ponytail styles</li>
<li>Want a more durable option</li>
</ul>

<p>Choose full lace if you:</p>
<ul>
<li>Want maximum styling versatility</li>
<li>Wear high ponytails or updos</li>
<li>Prioritize breathability</li>
</ul>

<p>Hair Aura offers both options to suit your needs and budget!</p>',
1, 'Wig Education', 'lace front, full lace, wig types, comparison',
'Lace Front vs Full Lace Wigs Ghana | Hair Aura',
'Understand the difference between lace front and full lace wigs. Expert comparison from Hair Aura.',
1, NOW()),

('5 Trending Wig Styles for 2024', 'trending-wig-styles-2024',
'Discover the hottest wig trends taking Ghana and Africa by storm this year.',
'<h2>2024 Wig Trends You Need to Know</h2>
<p>The wig industry is constantly evolving, and 2024 brings exciting new trends. Here are the top 5 styles dominating the Ghana and African markets:</p>

<h3>1. The Wet Look</h3>
<p>Water wave and deep wave wigs styled to look wet are everywhere. This sleek, glossy look is perfect for both casual and formal occasions.</p>

<h3>2. Bold Colors</h3>
<p>From honey blonde to burgundy to fashion colors, bold is beautiful. More women are experimenting with colored wigs to express their personality.</p>

<h3>3. The Modern Bob</h3>
<p>The classic bob gets an update with blunt cuts, asymmetrical lines, and textured ends. It\'s chic, professional, and low maintenance.</p>

<h3>4. Kinky Textures</h3>
<p>Embracing natural textures is a major trend. Kinky straight and Afro-textured wigs that blend with natural hair are in high demand.</p>

<h3>5. HD Lace Everything</h3>
<p>HD lace wigs that melt into any skin tone are becoming the standard. The undetectable finish is a game-changer.</p>

<p>Shop all these trending styles at Hair Aura and stay ahead of the fashion curve!</p>',
1, 'Trends', 'wig trends 2024, fashion, styles, Ghana',
'Trending Wig Styles 2024 Ghana | Hair Aura',
'Discover 2024\'s hottest wig trends in Ghana. Water waves, bold colors, modern bobs and more at Hair Aura.',
1, NOW()),

('How to Secure Your Lace Front Wig', 'secure-lace-front-wig',
'Expert tips for keeping your lace front wig secure and comfortable all day long.',
'<h2>Keep Your Wig Secure All Day</h2>
<p>Nothing is more frustrating than a shifting wig. Here are professional tips to keep your lace front wig secure:</p>

<h3>Preparation is Key</h3>
<ul>
<li>Start with clean, dry skin</li>
<li>Use alcohol to remove oils from hairline</li>
<li>Protect your edges with a wig grip</li>
</ul>

<h3>Application Techniques</h3>
<ul>
<li>Use quality adhesive or wig tape</li>
<li>Apply thin, even layers of glue</li>
<li>Wait for adhesive to get tacky before applying</li>
<li>Press lace firmly into place</li>
<li>Tie down with a scarf for 10-15 minutes</li>
</ul>

<h3>Maintenance Throughout the Day</h3>
<ul>
<li>Avoid excessive sweating when possible</li>
<li>Carry blotting papers for oily skin</li>
<li>Keep a small emergency kit with extra tape</li>
</ul>

<h3>Removal</h3>
<p>Always use proper adhesive remover and be gentle with your edges. Never rip the wig off!</p>

<p>Shop wig adhesives and accessories at Hair Aura for the best hold.</p>',
1, 'Wig Tips', 'lace front, wig security, adhesive, application',
'Secure Lace Front Wig Ghana | Hair Aura Tips',
'Learn how to secure your lace front wig. Professional application tips from Hair Aura.',
1, NOW());

-- ============================================
-- NEWSLETTER SUBSCRIBERS
-- ============================================
INSERT INTO `newsletter_subscribers` (`email`, `first_name`, `is_active`) VALUES
('subscriber1@email.com', 'Grace', 1),
('subscriber2@email.com', 'Priscilla', 1),
('subscriber3@email.com', 'Esther', 1);

-- ============================================
-- COUPONS
-- ============================================
INSERT INTO `coupons` (`code`, `description`, `discount_type`, `discount_value`, `min_order_amount`, `max_discount`, `usage_limit`, `starts_at`, `expires_at`, `is_active`) VALUES
('WELCOME10', '10% off first order', 'percentage', 10.00, 50.00, 50.00, 100, NOW(), DATE_ADD(NOW(), INTERVAL 90 DAY), 1),
('AURA20', '20% off orders over GH₵150', 'percentage', 20.00, 150.00, 75.00, 50, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 1),
('FREESHIP', 'Free shipping on orders over GH₵100', 'fixed', 15.00, 100.00, 15.00, 200, NOW(), DATE_ADD(NOW(), INTERVAL 60 DAY), 1);
