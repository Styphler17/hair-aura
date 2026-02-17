<?php
// Parameters:
// $inputName: string (e.g. 'library_image')
// $mediaImages: array
// $currentValue: string|array (selected value(s))
// $isMultiple: bool (default false)
// $label: string (default 'Pick From Media Library')

$inputName = $inputName ?? 'library_image';
$mediaImages = $mediaImages ?? [];
$isMultiple = $isMultiple ?? false;
$currentValue = $currentValue ?? ($isMultiple ? [] : '');
$label = $label ?? 'Pick From Media Library';
$containerId = 'media_container_' . uniqid();

// Helper to check selection
$isSelected = function($path) use ($currentValue, $isMultiple) {
    $path = ltrim($path, '/');
    if ($isMultiple && is_array($currentValue)) {
        foreach ($currentValue as $val) {
            if (ltrim((string)$val, '/') === $path) return true;
        }
        return false;
    }
    return ltrim((string)$currentValue, '/') === $path;
};

// Handle multiple radio/checkbox logic
$inputType = $isMultiple ? 'checkbox' : 'radio';
$inputNameAttr = $isMultiple ? $inputName . '[]' : $inputName;
?>

<div class="col-12 mt-3">
    <label class="form-label"><?= htmlspecialchars($label) ?></label>
    <div class="border rounded p-3 bg-white">
        <div class="d-flex justify-content-between mb-2">
            <input type="text" class="form-control w-auto" placeholder="Search library..." onkeyup="filterMediaCheckboxes(this)">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearMediaSelection('<?= $containerId ?>', '<?= $inputNameAttr ?>')">Clear Selection</button>
        </div>
        
        <div id="<?= $containerId ?>" class="d-flex flex-wrap gap-2 media-checkbox-container" style="max-height: 300px; overflow-y: auto;">
            <?php foreach ($mediaImages as $media): ?>
                <?php 
                    $mPath = $media['file_path'] ?? '';
                    $mPathRel = ltrim($mPath, '/');
                    $mName = $media['file_name'] ?? 'image';
                    $mId = $media['id'] ?? uniqid();
                    $selected = $isSelected($mPathRel);
                ?>
                <div class="media-checkbox-option position-relative" style="width: 100px; height: 100px;" data-name="<?= htmlspecialchars($mName) ?>">
                    <input type="<?= $inputType ?>" name="<?= $inputNameAttr ?>" value="<?= htmlspecialchars($mPathRel) ?>" id="media_<?= $mId ?>" class="btn-check" <?= $selected ? 'checked' : '' ?>>
                    <label class="btn btn-outline-light p-0 w-100 h-100 overflow-hidden border shadow-sm d-flex align-items-center justify-content-center" for="media_<?= $mId ?>">
                        <img src="<?= asset('/' . $mPathRel) ?>" alt="<?= htmlspecialchars($mName) ?>" 
                             class="w-100 h-100" style="object-fit: cover; object-position: center;"
                             title="<?= htmlspecialchars($mName) ?>"
                             onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp'); ?>';">
                    </label>
                    <div class="position-absolute top-0 end-0 p-1">
                        <i class="fas fa-check-circle text-primary bg-white rounded-circle check-icon" style="opacity: 0; transition: opacity 0.2s;"></i>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="form-text"><?= $isMultiple ? 'Select multiple images.' : 'Selecting an image sets it as active.' ?></div>
</div>

<?php if (!defined('MEDIA_LIBRARY_ASSETS_INCLUDED')): define('MEDIA_LIBRARY_ASSETS_INCLUDED', true); ?>
<style>
.btn-check:checked + label {
    border-color: var(--bs-primary, #0d6efd) !important;
    border-width: 3px !important;
}
.btn-check:checked ~ div .check-icon {
    opacity: 1 !important;
}
.media-checkbox-option label:hover {
    border-color: #adb5bd !important;
}
</style>
<script>
// Use robust namespace or existing checks?
// Assuming this is global scope
function filterMediaCheckboxes(input) {
    const filter = input.value.toLowerCase();
    const container = input.closest('.border').querySelector('.media-checkbox-container'); 
    const items = container.querySelectorAll('.media-checkbox-option[data-name]');
    items.forEach(item => {
        const name = item.getAttribute('data-name').toLowerCase();
        if (name.includes(filter)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}
function clearMediaSelection(containerId, inputName) {
    const container = document.getElementById(containerId);
    if (!container) return;
    // Handle specific input name (with [] if multiple)
    // Escape quotes in selector
    const selector = `input[name='${inputName}']`;
    container.querySelectorAll(selector).forEach(el => el.checked = false);
}
</script>
<?php endif; ?>
