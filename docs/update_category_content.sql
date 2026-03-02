-- SQL Update Script for Hair Aura Category Content and SEO
-- This script improves category descriptions and populates meta data for SEO.
-- Updated with re-indexed IDs (1-7).

START TRANSACTION;

-- Category ID 1: Bone-straight
UPDATE `categories` SET 
    `meta_title` = 'Luxury Bone Straight Hair',
    `meta_description` = 'Indulge in the ultimate sleekness with our premium bone straight wigs. Silky, frizz-free, and perfectly leveled for a sophisticated look.'
WHERE `id` = 1;

-- Category ID 2: Body wave (Re-indexed from 18)
UPDATE `categories` SET 
    `meta_title` = 'Bouncy Body Wave Units',
    `meta_description` = 'Enhance your natural beauty with our voluminous body wave hair. Soft, bouncy waves that maintain their pattern and luster.'
WHERE `id` = 2;

-- Category ID 3: Pixie cut (Re-indexed from 19)
UPDATE `categories` SET 
    `image` = 'Pixie-cut.webp',
    `meta_title` = 'Chic Pixie Cut Wigs',
    `meta_description` = 'Effortless elegance in a short style. Our tapered pixie cut wigs offer a bold, sophisticated look that\'s easy to maintain.'
WHERE `id` = 3;

-- Category ID 4: Pixie curls (Re-indexed from 20)
UPDATE `categories` SET 
    `image` = 'Pixie-curls.webp',
    `meta_title` = 'Bouncy Pixie Curls',
    `meta_description` = 'Playful and chic short curly units. Manageable, high-definition curls that add texture and personality to your style.'
WHERE `id` = 4;

-- Category ID 5: Deep wave (Re-indexed from 21)
UPDATE `categories` SET 
    `image` = 'Deep-wave.webp',
    `meta_title` = 'Defined Deep Wave Hair',
    `meta_description` = 'Dive into deep texture with our premium deep wave wigs. Intense wave patterns that deliver maximum volume and a stunning ocean-kissed look.'
WHERE `id` = 5;

-- Category ID 6: Raw hair (Re-indexed from 23)
UPDATE `categories` SET 
    `image` = 'Raw-hair.webp',
    `meta_title` = 'Premium Raw Donor Hair',
    `meta_description` = 'The pinnacle of hair quality. Unprocessed, single-donor raw hair that offers unmatched longevity, strength, and styling versatility.'
WHERE `id` = 6;

-- Category ID 7: Blunt cut (Re-indexed from 24)
UPDATE `categories` SET 
    `image` = 'Blunt-cut.webp',
    `meta_title` = 'Modern Blunt Cut Bobs',
    `meta_description` = 'Sharp, edgy, and timeless. Our blunt cut bob wigs are perfectly leveled for a clean, modern aesthetic that turns heads.'
WHERE `id` = 7;

COMMIT;
