-- FORCE UPDATE CATEGORIES WITH PREMIUM CONTENT
-- This script ensures all 7 categories have the correct, high-converting descriptions and SEO data.

SET SESSION FOREIGN_KEY_CHECKS = 0;

-- Category 1: Bone-straight
UPDATE `categories` SET 
    `name` = 'Bone-straight',
    `description` = 'Premium 100% human hair bone straight wigs. Silky, frizz-free, and perfectly leveled for a sophisticated look.',
    `meta_title` = 'Luxury Bone Straight Hair Ghana',
    `meta_description` = 'Indulge in the ultimate sleekness with our premium bone straight wigs. Silky, frizz-free, and perfectly leveled for a sophisticated look.'
WHERE `id` = 1;

-- Category 2: Body wave
UPDATE `categories` SET 
    `name` = 'Body wave',
    `description` = 'Enhance your natural beauty with our voluminous, bouncy waves. High-quality 100% human hair that maintains its pattern.',
    `meta_title` = 'Premium Body Wave Hair Ghana',
    `meta_description` = 'Enhance your natural beauty with our voluminous body wave hair. Soft, bouncy waves that maintain their pattern and luster.'
WHERE `id` = 2;

-- Category 3: Pixie cut
UPDATE `categories` SET 
    `name` = 'Pixie cut',
    `description` = 'Chic and effortless tapered pixie cut wigs for a bold, sophisticated aesthetic and low-maintenance style.',
    `meta_title` = 'Chic Tapered Pixie Cut Wigs',
    `meta_description` = 'Effortless elegance in a short style. Our tapered pixie cut wigs offer a bold, sophisticated look that\'s easy to maintain.'
WHERE `id` = 3;

-- Category 4: Pixie curls
UPDATE `categories` SET 
    `name` = 'Pixie curls',
    `description` = 'Bouncy and short curly units with high-definition texture. Playful, chic, and full of personality.',
    `meta_title` = 'Bouncy Pixie Curls Units',
    `meta_description` = 'Playful and chic short curly units. Manageable, high-definition curls that add texture and personality to your style.'
WHERE `id` = 4;

-- Category 5: Deep wave
UPDATE `categories` SET 
    `name` = 'Deep wave',
    `description` = 'Intense wave pattern delivering maximum volume and defined curls for a stunning ocean-kissed look.',
    `meta_title` = 'Defined Deep Wave Hair Units',
    `meta_description` = 'Dive into deep texture with our premium deep wave wigs. Intense wave patterns that deliver maximum volume and a stunning ocean-kissed look.'
WHERE `id` = 5;

-- Category 6: Raw hair
UPDATE `categories` SET 
    `name` = 'Raw hair',
    `description` = 'Unprocessed single donor hair offering unmatched longevity, strength, and styling versatility.',
    `meta_title` = 'Premium unprocessed Raw Donor Hair',
    `meta_description` = 'The pinnacle of hair quality. Unprocessed, single-donor raw hair that offers unmatched longevity, strength, and styling versatility.'
WHERE `id` = 6;

-- Category 7: Blunt cut
UPDATE `categories` SET 
    `name` = 'Blunt cut',
    `description` = 'Sharp, leveled bob styles for a clean, modern, and timeless aesthetic that turns heads.',
    `meta_title` = 'Modern Sleek Blunt Cut Bobs',
    `meta_description` = 'Sharp, edgy, and timeless. Our blunt cut bob wigs are perfectly leveled for a clean, modern aesthetic that turns heads.'
WHERE `id` = 7;

SET SESSION FOREIGN_KEY_CHECKS = 1;

-- VERIFICATION
SELECT id, name, LEFT(description, 50) as desc_preview FROM categories WHERE id BETWEEN 1 AND 7;
