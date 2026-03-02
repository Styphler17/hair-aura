-- SQL Update Script for Hair Aura Product Content and SEO
-- This script improves product descriptions and populates meta data for SEO.

START TRANSACTION;

-- Product ID 1: Brazilian Body Wave Lace Front
UPDATE `products` SET 
    `description` = 'Indulge in the effortless elegance of our Brazilian Body Wave Lace Front wig. Sourced from high-quality 10A human hair, this unit features a natural, voluminous wave pattern that remains bouncy and vibrant. The HD lace frontal ensures a seamless "melt" into your skin for an undetectable hairline.',
    `short_description` = 'High-quality 10A Brazilian human hair with 180% density and breathable HD lace.',
    `meta_title` = 'Brazilian Body Wave Lace Front Wig | Premium Human Hair',
    `meta_description` = 'Shop our premium Brazilian Body Wave Lace Front wig. High-quality 10A human hair, 180% density, and HD lace for a natural look.',
    `meta_keywords` = 'brazilian body wave, lace front wig, human hair wig, HD lace wig, hair aura'
WHERE `id` = 1;

-- Product ID 3: Body wave Special
UPDATE `products` SET 
    `description` = 'Our "Body Wave Special" is a curated luxury unit designed for maximum volume and glamor. This single-donor hair features an intense, deep wave pattern that is incredibly soft to the touch and easy to style. Perfect for those who want a dramatic yet natural appearance.',
    `short_description` = 'Luxury single-donor body wave with voluminous 200% density and natural luster.',
    `meta_title` = 'Body Wave Special Luxury Wig | Extra Volume & Luster',
    `meta_description` = 'Exclusively curated Body Wave Special wig with 200% density. Premium single-donor hair for a voluminous, glam look.',
    `meta_keywords` = 'body wave special, luxury wig, high density wig, premium hair, hair aura'
WHERE `id` = 3;

-- Product ID 21: Curly hair
UPDATE `products` SET 
    `name` = 'Luxe Natural Curls',
    `description` = 'The Luxe Natural Curls wig offers tight, bouncy coils that mimic natural hair perfectly. This short, chic unit is designed for the modern woman who values style and ease. Low maintenance yet high impact, these curls are soft, tangle-free, and retain their shape wash after wash.',
    `meta_title` = 'Luxe Natural Curls Short Wig | Bouncy & Tangle-Free',
    `meta_description` = 'Elegant Luxe Natural Curls wig featuring bouncy, short coils. 100% human hair, low maintenance, and tangle-free.',
    `meta_keywords` = 'curly wig, natural curls, short curly wig, bouncy hair, hair aura'
WHERE `id` = 21;

-- Product ID 23: Straight hair
UPDATE `products` SET 
    `name` = 'Classic Silky Straight',
    `description` = 'Achieve the sleekest look with our Classic Silky Straight bundles. This 10A Grade hair is flawlessly smooth from root to tip, reflecting light with a healthy, natural shine. It can be easily dyed, curled, or styled while maintaining its pristine straightness.',
    `meta_title` = 'Classic Silky Straight Hair | 10A Grade Human Hair',
    `meta_description` = 'Experience the sleek perfection of Classic Silky Straight hair. 10A Grade, healthy shine, and versatile styling options.',
    `meta_keywords` = 'silky straight hair, human hair bundles, straight hair ghana, premium hair'
WHERE `id` = 23;

-- Product ID 24: Luxury Vietnamese Bone Straight
UPDATE `products` SET 
    `meta_title` = 'Luxury Vietnamese Bone Straight | Super Double Drawn',
    `meta_description` = 'The ultimate in luxury. Vietnamese Bone Straight hair, super double drawn and sourced from single donors for maximum silkiness.',
    `meta_keywords` = 'vietnamese bone straight, super double drawn, hair aura, luxury hair'
WHERE `id` = 24;

-- Product ID 25: Ocean Deep Wave Frontal Wig
UPDATE `products` SET 
    `meta_title` = 'Ocean Deep Wave Frontal Wig | HD Lace 200% Density',
    `meta_description` = 'Get the perfect wet look with our Ocean Deep Wave 13x4 Frontal wig. HD lace and 200% density for a natural, voluminous finish.',
    `meta_keywords` = 'ocean deep wave, frontal wig, HD lace, wet look hair'
WHERE `id` = 25;

-- Product ID 28: Sharp Blunt Cut Bob
UPDATE `products` SET 
    `meta_title` = 'Sharp Blunt Cut Bob #1B | Sleek 4x4 Closure Wig',
    `meta_description` = 'A timeless, sophisticated look. Our sharp blunt cut bob features precision-leveled ends and a pre-plucked 4x4 closure.',
    `meta_keywords` = 'blunt cut bob, bob wig, closure wig, sleek bob, hair aura'
WHERE `id` = 28;

-- Product ID 29: Honey Blonde Straight Wig
UPDATE `products` SET 
    `meta_title` = 'Honey Blonde Straight Wig | Color #27 HD Lace',
    `meta_description` = 'Stunning Honey Blonde #27 Straight wig. 13x4 HD lace frontal for a seamless melt and head-turning appearance.',
    `meta_keywords` = 'honey blonde wig, colored wig, straight frontal wig, blonde hair'
WHERE `id` = 29;

-- Product ID 30: Kinky Straight 13x4 Frontal
UPDATE `products` SET 
    `meta_title` = 'Kinky Straight 13x4 Frontal | Natural Texture Melt',
    `meta_description` = 'The perfect natural blend. Kinky Straight 13x4 frontal wig that mimics blown-out natural hair with 180% density.',
    `meta_keywords` = 'kinky straight wig, natural hair blend, blow out texture, hair aura'
WHERE `id` = 30;

-- Product ID 31: Tapered Cut Pixie Wig
UPDATE `products` SET 
    `meta_title` = 'Tapered Cut Pixie Wig | Chic & Sophisticated Short Hair',
    `meta_description` = 'Bold and chic. Our Tapered Cut Pixie wig highlights your features with a sophisticated, low-maintenance short style.',
    `meta_keywords` = 'pixie wig, short hair wig, tapered cut, chic hair'
WHERE `id` = 31;

-- Product ID 33: Double Drawn Body Wave
UPDATE `products` SET 
    `meta_title` = 'Double Drawn Body Wave | Maximum Thickness & Volume',
    `meta_description` = 'Full from top to bottom. Our super double drawn body wave offers maximum thickness and natural bounce.',
    `meta_keywords` = 'double drawn hair, body wave, thick hair bundles, hair aura'
WHERE `id` = 33;

-- Product ID 34: Pixie Curls
UPDATE `products` SET 
    `description` = 'The Pixie Curls unit is a vibrant, easy-to-wear short wig featuring tight, defined curls. Crafted from premium human hair, it provides a playful yet sophisticated look that requires minimal styling while offering maximum impact. Perfect for the woman on the go.',
    `short_description` = 'Short, bouncy pixie curls with premium definition and natural shine.',
    `meta_title` = 'Short Pixie Curls Human Hair Wig | Bouncy & Defined',
    `meta_description` = 'Playful and sophisticated Pixie Curls short wig. Premium defined curls, minimal styling required, maximum impact.',
    `meta_keywords` = 'pixie curls, short curly wig, human hair, hair aura'
WHERE `id` = 34;

COMMIT;
