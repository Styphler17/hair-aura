<?php
/**
 * Reusable Button Component
 * 
 * @var string $text The button text
 * @var string $url The link URL (if provided, renders as <a>, else <button>)
 * @var string $type primary, outline-primary, outline-light, secondary, gold
 * @var string $size sm, md, lg
 * @var string $icon Lucide or FontAwesome icon class
 * @var string $class Additional CSS classes
 * @var array  $attr Additional HTML attributes
 */

$text = $text ?? 'Click Here';
$url = $url ?? null;
$type = $type ?? 'primary';
$size = $size ?? 'md';
$icon = $icon ?? null;
$extraClass = $class ?? '';
$attributes = '';

if (isset($attr) && is_array($attr)) {
    foreach ($attr as $key => $value) {
        $attributes .= " $key=\"" . htmlspecialchars((string)$value) . "\"";
    }
}

$classes = "btn btn-{$type} btn-{$size} {$extraClass}";

if ($url): ?>
    <a href="<?= $url ?>" class="<?= $classes ?>"<?= $attributes ?>>
        <?php if ($icon): ?><i class="<?= $icon ?>"></i><?php endif; ?>
        <span><?= htmlspecialchars($text) ?></span>
    </a>
<?php else: ?>
    <button type="submit" class="<?= $classes ?>"<?= $attributes ?>>
        <?php if ($icon): ?><i class="<?= $icon ?>"></i><?php endif; ?>
        <span><?= htmlspecialchars($text) ?></span>
    </button>
<?php endif; ?>
