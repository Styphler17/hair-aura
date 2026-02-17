<?php
$resolveCategoryImage = static function (?string $image): string {
    $name = trim((string) $image);
    if ($name === '') {
        return asset('/img/product-placeholder.png');
    }

    if (str_starts_with($name, 'http://') || str_starts_with($name, 'https://')) {
        return $name;
    }

    // If it starts with 'uploads/' or 'img/', assumes it's from root
    if (str_starts_with($name, 'uploads/') || str_starts_with($name, 'img/')) {
        return asset('/' . ltrim($name, '/'));
    }

    // Otherwise, treat as relative to categories folder (even if it has ..)
    return asset('/uploads/categories/' . $name);
};
$mediaImages = $mediaImages ?? [];
?>

<h2 class="mb-3">Categories</h2>

<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0">Add Category</h5>
    </div>
    <div class="card-body">
        <form method="post" action="<?= url('/admin/categories/save') ?>" enctype="multipart/form-data" class="row g-2">
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
            <div class="col-md-4">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0">
            </div>
            <div class="col-md-3">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Category Image</label>
                <input type="file" name="image_file" class="form-control" accept=".jpg,.jpeg,.png,.webp">
            </div>
            <div class="col-md-6">
                <label class="form-label">Or Pick From Media Library</label>
                <div class="dropdown">
                    <input type="hidden" name="library_image" id="library_image_new">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start text-truncate" type="button" id="btn_library_image_new" data-bs-toggle="dropdown" aria-expanded="false">
                        Choose image from library
                    </button>
                    <div class="dropdown-menu p-2 shadow" style="width: 100%; min-width: 300px;">
                        <input type="text" class="form-control mb-2 form-control-sm" placeholder="Search..." onkeyup="filterMedia(this)">
                        <div class="d-flex flex-wrap gap-2 media-grid-container" style="max-height: 250px; overflow-y: auto;">
                            <div class="media-option" style="width: 60px; height: 60px; cursor: pointer; display: flex; align-items: center; justify-content: center; background: #f8f9fa; border: 1px solid #dee2e6;" 
                                 onclick="setMediaImage('library_image_new', '', 'btn_library_image_new', 'Choose image from library')" title="None">
                                <i class="fas fa-ban text-muted"></i>
                            </div>
                            <?php foreach ($mediaImages as $media): ?>
                                <?php 
                                    $mPath = $media['file_path'] ?? ''; 
                                    $mName = $media['file_name'] ?? 'image';
                                ?>
                                <div class="media-option" style="width: 60px; height: 60px; cursor: pointer;" 
                                     onclick="setMediaImage('library_image_new', '<?= htmlspecialchars($mPath) ?>', 'btn_library_image_new', '<?= htmlspecialchars($mName) ?>')"
                                     data-name="<?= htmlspecialchars(strtolower($mName)) ?>">
                                    <img src="<?= asset($mPath) ?>" alt="<?= htmlspecialchars($mName) ?>" 
                                         class="img-thumbnail w-100 h-100" style="object-fit: cover;"
                                         title="<?= htmlspecialchars($mName) ?>"
                                         onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.png') ?>';">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="2"></textarea>
            </div>
            <div class="col-12 d-flex gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_active" id="newCategoryActive" value="1" checked>
                    <label class="form-check-label" for="newCategoryActive">Active</label>
                </div>
                <button type="submit" class="btn btn-primary">Create Category</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 admin-table-mobile">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Slug</th>
                        <th>Products</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td data-label="Name">
                                    <strong><?= htmlspecialchars((string) ($category['name'] ?? '')) ?></strong>
                                    <?php if (!empty($category['description'])): ?>
                                        <div class="small text-muted"><?= htmlspecialchars(strlen((string) $category['description']) > 80 ? substr((string) $category['description'], 0, 77) . '...' : (string) $category['description']) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Image">
                                    <img
                                        src="<?= htmlspecialchars($resolveCategoryImage((string) ($category['image'] ?? ''))) ?>"
                                        alt="<?= htmlspecialchars((string) ($category['name'] ?? 'Category')) ?>"
                                        class="category-thumb"
                                        onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.png') ?>';"
                                    >
                                </td>
                                <td data-label="Slug"><?= htmlspecialchars((string) ($category['slug'] ?? '')) ?></td>
                                <td data-label="Products"><?= (int) ($category['product_count'] ?? 0) ?></td>
                                <td data-label="Sort"><?= (int) ($category['sort_order'] ?? 0) ?></td>
                                <td data-label="Status">
                                    <?php if (!empty($category['is_active'])): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Action" class="text-end">
                                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#editCategory<?= (int) $category['id'] ?>">Edit</button>
                                </td>
                            </tr>
                            <tr class="collapse" id="editCategory<?= (int) $category['id'] ?>">
                                <td colspan="7">
                                    <form method="post" action="<?= url('/admin/categories/save') ?>" enctype="multipart/form-data" class="row g-2">
                                        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                        <input type="hidden" name="id" value="<?= (int) $category['id'] ?>">
                                        <div class="col-md-3">
                                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars((string) ($category['name'] ?? '')) ?>" required>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars((string) ($category['slug'] ?? '')) ?>" required>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="sort_order" class="form-control" value="<?= (int) ($category['sort_order'] ?? 0) ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="meta_title" class="form-control" value="<?= htmlspecialchars((string) ($category['meta_title'] ?? '')) ?>" placeholder="Meta title">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_active" id="active<?= (int) $category['id'] ?>" value="1" <?= !empty($category['is_active']) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="active<?= (int) $category['id'] ?>">Active</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="file" name="image_file" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dropdown">
                                                <input type="hidden" name="library_image" id="library_image_<?= $category['id'] ?>">
                                                <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start text-truncate" type="button" id="btn_library_image_<?= $category['id'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Pick from media library
                                                </button>
                                                <div class="dropdown-menu p-2 shadow" style="width: 100%; min-width: 300px;">
                                                    <input type="text" class="form-control mb-2 form-control-sm" placeholder="Search..." onkeyup="filterMedia(this)">
                                                    <div class="d-flex flex-wrap gap-2 media-grid-container" style="max-height: 250px; overflow-y: auto;">
                                                        <div class="media-option" style="width: 60px; height: 60px; cursor: pointer; display: flex; align-items: center; justify-content: center; background: #f8f9fa; border: 1px solid #dee2e6;" 
                                                             onclick="setMediaImage('library_image_<?= $category['id'] ?>', '', 'btn_library_image_<?= $category['id'] ?>', 'Pick from media library')" title="None">
                                                            <i class="fas fa-ban text-muted"></i>
                                                        </div>
                                                        <?php foreach ($mediaImages as $media): ?>
                                                            <?php 
                                                                $mPath = $media['file_path'] ?? ''; 
                                                                $mName = $media['file_name'] ?? 'image';
                                                            ?>
                                                            <div class="media-option" style="width: 60px; height: 60px; cursor: pointer;" 
                                                                 onclick="setMediaImage('library_image_<?= $category['id'] ?>', '<?= htmlspecialchars($mPath) ?>', 'btn_library_image_<?= $category['id'] ?>', '<?= htmlspecialchars($mName) ?>')"
                                                                 data-name="<?= htmlspecialchars(strtolower($mName)) ?>">
                                                                <img src="<?= asset($mPath) ?>" alt="<?= htmlspecialchars($mName) ?>" 
                                                                     class="img-thumbnail w-100 h-100" style="object-fit: cover;"
                                                                     title="<?= htmlspecialchars($mName) ?>"
                                                                     onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.png') ?>';">
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remove_image" id="removeImage<?= (int) $category['id'] ?>" value="1">
                                                <label class="form-check-label" for="removeImage<?= (int) $category['id'] ?>">Remove image</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1 d-flex align-items-center">
                                            <img
                                                src="<?= htmlspecialchars($resolveCategoryImage((string) ($category['image'] ?? ''))) ?>"
                                                alt="<?= htmlspecialchars((string) ($category['name'] ?? 'Category')) ?>"
                                                class="category-thumb"
                                                onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.png') ?>';"
                                            >
                                        </div>
                                        <div class="col-12">
                                            <textarea name="description" class="form-control" rows="2" placeholder="Description"><?= htmlspecialchars((string) ($category['description'] ?? '')) ?></textarea>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="meta_description" class="form-control" value="<?= htmlspecialchars((string) ($category['meta_description'] ?? '')) ?>" placeholder="Meta description">
                                        </div>
                                        <div class="col-md-2 d-grid">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No categories found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function setMediaImage(inputId, value, buttonId, label) {
    document.getElementById(inputId).value = value;
    const btn = document.getElementById(buttonId);
    if(btn) btn.innerText = label ? label.substring(0, 20) + (label.length > 20 ? '...' : '') : 'Select Image';
}

function filterMedia(input) {
    const filter = input.value.toLowerCase();
    const container = input.nextElementSibling; 
    const items = container.querySelectorAll('.media-option[data-name]');
    items.forEach(item => {
        const name = item.getAttribute('data-name');
        if (name.includes(filter)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>
