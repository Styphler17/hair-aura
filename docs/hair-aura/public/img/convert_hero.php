<?php
$images = [
    'e:/hair-aura/public/img/hero-1',
    'e:/hair-aura/public/img/hero-2',
    'e:/hair-aura/public/img/hero-3'
];

foreach ($images as $base) {
    if (file_exists($base . '.png')) {
        $img = imagecreatefrompng($base . '.png');
        if ($img) {
            imagewebp($img, $base . '.webp', 90);
            imagedestroy($img);
            unlink($base . '.png');
            echo "Converted $base.png to .webp\n";
        } else {
            echo "Failed to load $base.png\n";
        }
    } else {
        echo "File $base.png not found\n";
    }
}
?>
