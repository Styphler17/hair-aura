-- SQL to restore missing blog featured images for Hair Aura
-- Affected IDs: 2, 3, 4, 5, 6, 7, 8, 9, 10

UPDATE blog_posts SET featured_image = 'blog_face_shape_2026.webp' WHERE id = 2;
UPDATE blog_posts SET featured_image = 'blog_lace_comparison_2026.webp' WHERE id = 3;
UPDATE blog_posts SET featured_image = 'blog_trends_2024_2026.webp' WHERE id = 4;
UPDATE blog_posts SET featured_image = 'blog_secure_wig_2026.webp' WHERE id = 5;
UPDATE blog_posts SET featured_image = 'blog_glueless_wigs_2026.webp' WHERE id = 6;
UPDATE blog_posts SET featured_image = 'blog_hair_comparison_2026.webp' WHERE id = 7;
UPDATE blog_posts SET featured_image = 'blog_humidity_care_2026.webp' WHERE id = 8;
UPDATE blog_posts SET featured_image = 'blog_bridal_hair_2026.webp' WHERE id = 9;
UPDATE blog_posts SET featured_image = 'blog_lace_tinting_2026.webp' WHERE id = 10;
