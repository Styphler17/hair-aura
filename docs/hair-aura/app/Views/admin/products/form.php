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
            <label class="form-label">Product Name</label>
            <input type="text" name="name" id="productName" class="form-control" value="<?= htmlspecialchars($product?->name ?? '') ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" id="productSlug" class="form-control" value="<?= htmlspecialchars($product?->slug ?? '') ?>" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" value="<?= htmlspecialchars($product?->sku ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select" required>
                <option value="">Select category</option>
                <?php foreach (($categories ?? []) as $category): ?>
                    <option value="<?= (int) $category['id'] ?>" <?= ((int) ($product?->category_id ?? 0) === (int) $category['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control" value="<?= htmlspecialchars($product?->brand ?? 'Hair Aura') ?>">
        </div>

        <div class="col-md-4">
            <label class="form-label">Price (GHS)</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars((string) ($product?->price ?? '')) ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Sale Price (GHS)</label>
            <input type="number" step="0.01" name="sale_price" class="form-control" value="<?= htmlspecialchars((string) ($product?->sale_price ?? '')) ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control" value="<?= htmlspecialchars((string) ($product?->stock_quantity ?? '0')) ?>" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Stock Status</label>
            <select name="stock_status" class="form-select">
                <?php $stockStatus = (string) ($product?->stock_status ?? 'in_stock'); ?>
                <option value="in_stock" <?= $stockStatus === 'in_stock' ? 'selected' : '' ?>>In Stock</option>
                <option value="out_of_stock" <?= $stockStatus === 'out_of_stock' ? 'selected' : '' ?>>Out of Stock</option>
                <option value="backorder" <?= $stockStatus === 'backorder' ? 'selected' : '' ?>>Backorder</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Hair Type</label>
            <input type="text" name="hair_type" class="form-control" value="<?= htmlspecialchars($product?->hair_type ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Texture</label>
            <input type="text" name="texture" class="form-control" value="<?= htmlspecialchars($product?->texture ?? '') ?>">
        </div>

        <div class="col-md-4">
            <label class="form-label">Length (inches)</label>
            <input type="number" name="length_inches" class="form-control" value="<?= htmlspecialchars((string) ($product?->length_inches ?? '')) ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Color</label>
            <input type="text" name="color" class="form-control" value="<?= htmlspecialchars($product?->color ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Density</label>
            <input type="text" name="density" class="form-control" value="<?= htmlspecialchars($product?->density ?? '') ?>">
        </div>

        <div class="col-12">
            <label class="form-label">Short Description</label>
            <textarea name="short_description" class="form-control" rows="2"><?= htmlspecialchars($product?->short_description ?? '') ?></textarea>
        </div>

        <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="6"><?= htmlspecialchars($product?->description ?? '') ?></textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="<?= htmlspecialchars($product?->meta_title ?? '') ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Meta Description</label>
            <input type="text" name="meta_description" class="form-control" value="<?= htmlspecialchars($product?->meta_description ?? '') ?>">
        </div>

        <div class="col-12">
            <label class="form-label">Meta Keywords</label>
            <input type="text" name="meta_keywords" class="form-control" value="<?= htmlspecialchars($product?->meta_keywords ?? '') ?>">
        </div>

        <div class="col-12">
            <label class="form-label">Upload Product Images</label>
            <input type="file" name="images[]" id="productImages" class="form-control" accept=".jpg,.jpeg,.png,.webp" multiple>
            <div id="imagePreview" class="mt-2 d-flex flex-wrap gap-2"></div>
        </div>

        <div class="col-12">
            <label class="form-label">Or Pick Images From Media Library</label>
            <select name="library_images[]" class="form-select" multiple size="6">
                <?php foreach ($mediaImages as $media): ?>
                    <option value="<?= htmlspecialchars((string) ($media['file_path'] ?? '')) ?>">
                        <?= htmlspecialchars((string) ($media['file_name'] ?? 'image')) ?> (<?= htmlspecialchars((string) ($media['folder'] ?? 'media')) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="form-text">Hold Ctrl/Cmd to select multiple images. You can also open <a href="<?= url('/admin/media') ?>" target="_blank" rel="noopener">Media Library</a>.</div>
        </div>

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
    <div class="card-header"><h5 class="mb-0">Current Images</h5></div>
    <div class="card-body d-flex flex-wrap gap-2">
        <?php foreach ($images as $image): ?>
            <img src="<?= asset('/uploads/products/' . $image['image_path']) ?>" alt="<?= htmlspecialchars($image['alt_text'] ?? '') ?>" style="width:90px;height:90px;object-fit:cover;border-radius:8px;">
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
