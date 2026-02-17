<?php
$isEdit = isset($product) && $product !== null;
$title = $isEdit ? 'Edit Product' : 'Add Product';
$mediaImages = $mediaImages ?? [];
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0"><?= $title ?></h2>
    <a href="<?= url('/admin/products') ?>" class="btn btn-outline-secondary">Back to Products</a>
</div>

<form method="post" action="<?= url('/admin/products/save') ?>" enctype="multipart/form-data" class="card">
    <div class="card-body row g-3">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
        <input type="hidden" name="id" value="<?= (int) ($product?->id ?? 0) ?>">

        <div class="col-md-8">
            <label class="form-label text-primary fw-bold"><i class="fas fa-tag me-1"></i> Product Name</label>
            <input type="text" name="name" id="productName" class="form-control hover-shadow transition" value="<?= htmlspecialchars($product?->name ?? '') ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label text-primary fw-bold"><i class="fas fa-link me-1"></i> Slug</label>
            <input type="text" name="slug" id="productSlug" class="form-control hover-shadow transition" value="<?= htmlspecialchars($product?->slug ?? '') ?>" required>
        </div>

        <div class="col-md-4">
            <label class="form-label text-primary fw-bold"><i class="fas fa-barcode me-1"></i> SKU</label>
            <input type="text" name="sku" class="form-control hover-shadow transition" value="<?= htmlspecialchars($product?->sku ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label text-success fw-bold"><i class="fas fa-layer-group me-1"></i> Category</label>
            <select name="category_id" class="form-select hover-shadow transition" required>
                <option value="">Select category</option>
                <?php foreach (($categories ?? []) as $category): ?>
                    <option value="<?= (int) $category['id'] ?>" <?= ((int) ($product?->category_id ?? 0) === (int) $category['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label text-success fw-bold"><i class="fas fa-copyright me-1"></i> Brand</label>
            <input type="text" name="brand" class="form-control hover-shadow transition" value="<?= htmlspecialchars($product?->brand ?? 'Hair Aura') ?>">
        </div>

        <div class="col-md-4">
            <label class="form-label text-info fw-bold"><i class="fas fa-money-bill-wave me-1"></i> Price (GHS)</label>
            <input type="number" step="0.01" name="price" class="form-control hover-shadow transition" value="<?= htmlspecialchars((string) ($product?->price ?? '')) ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label text-info fw-bold"><i class="fas fa-percentage me-1"></i> Sale Price (GHS)</label>
            <input type="number" step="0.01" name="sale_price" class="form-control hover-shadow transition" value="<?= htmlspecialchars((string) ($product?->sale_price ?? '')) ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label text-info fw-bold"><i class="fas fa-cubes me-1"></i> Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control hover-shadow transition" value="<?= htmlspecialchars((string) ($product?->stock_quantity ?? '0')) ?>" required>
        </div>

        <div class="col-md-4">
            <label class="form-label text-info fw-bold"><i class="fas fa-clipboard-check me-1"></i> Stock Status</label>
            <select name="stock_status" class="form-select hover-shadow transition">
                <?php $stockStatus = (string) ($product?->stock_status ?? 'in_stock'); ?>
                <option value="in_stock" <?= $stockStatus === 'in_stock' ? 'selected' : '' ?>>In Stock</option>
                <option value="out_of_stock" <?= $stockStatus === 'out_of_stock' ? 'selected' : '' ?>>Out of Stock</option>
                <option value="backorder" <?= $stockStatus === 'backorder' ? 'selected' : '' ?>>Backorder</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label text-dark fw-bold"><i class="fas fa-wind me-1"></i> Hair Type</label>
            <input type="text" name="hair_type" class="form-control hover-shadow transition" value="<?= htmlspecialchars($product?->hair_type ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label text-dark fw-bold"><i class="fas fa-fingerprint me-1"></i> Texture</label>
            <input type="text" name="texture" class="form-control hover-shadow transition" value="<?= htmlspecialchars($product?->texture ?? '') ?>">
        </div>

        <div class="col-md-4">
            <label class="form-label text-dark fw-bold"><i class="fas fa-ruler-vertical me-1"></i> Length (inches)</label>
            <input type="number" name="length_inches" class="form-control hover-shadow transition" value="<?= htmlspecialchars((string) ($product?->length_inches ?? '')) ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label text-dark fw-bold"><i class="fas fa-palette me-1"></i> Color</label>
            <input type="text" name="color" class="form-control hover-shadow transition" value="<?= htmlspecialchars($product?->color ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label text-dark fw-bold"><i class="fas fa-compress-arrows-alt me-1"></i> Density</label>
            <input type="text" name="density" class="form-control hover-shadow transition" value="<?= htmlspecialchars($product?->density ?? '') ?>">
        </div>

        <div class="col-12">
            <label class="form-label text-muted fw-bold"><i class="fas fa-quote-left me-1"></i> Short Description</label>
            <textarea name="short_description" class="form-control hover-shadow transition" rows="2"><?= htmlspecialchars($product?->short_description ?? '') ?></textarea>
        </div>

        <div class="col-12">
            <label class="form-label text-muted fw-bold"><i class="fas fa-align-left me-1"></i> Description</label>
            <textarea name="description" class="form-control hover-shadow transition" rows="6"><?= htmlspecialchars($product?->description ?? '') ?></textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label text-secondary fw-bold"><i class="fas fa-search me-1"></i> Meta Title</label>
            <input type="text" name="meta_title" class="form-control hover-shadow transition" value="<?= htmlspecialchars($product?->meta_title ?? '') ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label text-secondary fw-bold"><i class="fas fa-info-circle me-1"></i> Meta Description</label>
            <input type="text" name="meta_description" class="form-control hover-shadow transition" value="<?= htmlspecialchars($product?->meta_description ?? '') ?>">
        </div>

        <div class="col-12">
            <label class="form-label text-secondary fw-bold"><i class="fas fa-key me-1"></i> Meta Keywords</label>
            <input type="text" name="meta_keywords" class="form-control hover-shadow transition" value="<?= htmlspecialchars($product?->meta_keywords ?? '') ?>">
        </div>

        <div class="col-12">
            <label class="form-label text-warning fw-bold"><i class="fas fa-images me-1"></i> Upload Product Images</label>
            <input type="file" name="images[]" id="productImages" class="form-control hover-shadow transition" accept=".jpg,.jpeg,.png,.webp" multiple>
            <div id="imagePreview" class="mt-2 d-flex flex-wrap gap-2"></div>
        </div>

        <?php
            // Setup for partial
            $inputName = 'library_images';
            $isMultiple = true;
            $currentValue = []; // Start empty for products (adds new)
            $label = 'Or Pick Images From Media Library';
            include __DIR__ . '/../partials/media_library_selector.php';
        ?>

        <div class="col-12 d-flex flex-wrap gap-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" <?= !empty($product?->featured) ? 'checked' : '' ?>>
                <label class="form-check-label" for="featured">Featured</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="bestseller" id="bestseller" value="1" <?= !empty($product?->bestseller) ? 'checked' : '' ?>>
                <label class="form-check-label" for="bestseller">Bestseller</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="new_arrival" id="new_arrival" value="1" <?= !empty($product?->new_arrival) ? 'checked' : '' ?>>
                <label class="form-check-label" for="new_arrival">New Arrival</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" <?= isset($product) ? (!empty($product?->is_active) ? 'checked' : '') : 'checked' ?>>
                <label class="form-check-label" for="is_active">Active</label>
            </div>
        </div>

        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save Product</button>
            <a href="<?= url('/admin/products') ?>" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </div>
</form>

<?php if (!empty($images)): ?>
<div class="card mt-3">
    <div class="card-header"><h5 class="mb-0">Current Product Images</h5></div>
    <div class="card-body d-flex flex-wrap gap-3">
        <?php foreach ($images as $image): ?>
            <div class="position-relative" style="width: 120px; height: 120px;">
                <?php
                $imgPath = (string) $image['image_path'];
                if (str_starts_with($imgPath, 'http')) {
                    $fullImgPath = $imgPath;
                } elseif (str_starts_with($imgPath, 'uploads/') || str_starts_with($imgPath, 'img/')) {
                    $fullImgPath = asset('/' . ltrim($imgPath, '/'));
                } else {
                    $fullImgPath = asset('/uploads/products/' . $imgPath);
                }
                ?>
                <img src="<?= $fullImgPath ?>" 
                     alt="<?= htmlspecialchars($image['alt_text'] ?? '') ?>" 
                     class="w-100 h-100 rounded border shadow-sm" 
                     style="object-fit: cover;"
                     onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.webp'); ?>';">
                
                <form action="<?= url('/admin/products/images/delete/' . $image['id']) ?>" method="post" 
                      onsubmit="return confirm('Are you sure you want to remove this image?');" 
                      class="position-absolute top-0 end-0 m-1">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <button type="submit" class="btn btn-sm btn-danger p-0 d-flex align-items-center justify-content-center rounded-circle shadow" style="width: 28px; height: 28px;" title="Remove Image">
                        <i class="fas fa-times"></i>
                    </button>
                </form>
                
                <?php if (!empty($image['is_primary'])): ?>
                    <div class="position-absolute bottom-0 start-0 w-100 p-1 text-center">
                        <span class="badge bg-primary shadow-sm">Main Image</span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>


