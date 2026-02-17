<h2 class="mb-3">Admin Profile Settings</h2>

<div class="row g-3">
    <div class="col-lg-7">
        <form method="post" action="<?= url('/admin/profile') ?>" enctype="multipart/form-data" class="card">
            <div class="card-body row g-3">
                <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">

                <div class="col-12 mb-3">
                    <label class="form-label">Profile Avatar</label>
                    <div class="d-flex align-items-center gap-3 p-3 border rounded bg-light">
                         <img src="<?= asset($adminUser->getAvatarUrl()) ?>" alt="<?= htmlspecialchars($adminUser->getFullName()) ?>" style="width:72px;height:72px;border-radius:50%;object-fit:cover;border:2px solid rgba(212,165,116,.45);">
                         <div>
                             <div class="fw-bold">Current Avatar</div>
                             <code class="text-muted"><?= htmlspecialchars($adminUser->avatar ?? 'Default') ?></code>
                         </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Upload New Avatar</label>
                    <input type="file" name="avatar" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                    <div class="form-text">Uploading creates a new avatar file.</div>
                </div>

                <div class="col-12">
                    <label class="form-label">Or Pick From Media Library</label>
                    <div class="border rounded p-3 bg-white">
                        <div class="d-flex justify-content-between mb-2">
                            <input type="text" class="form-control w-auto" placeholder="Search library..." onkeyup="filterMediaCheckboxes(this)">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.querySelectorAll('input[name=library_avatar]').forEach(el => el.checked = false)">Clear Selection</button>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-2 media-checkbox-container" style="max-height: 300px; overflow-y: auto;">
                            <?php foreach (($mediaImages ?? []) as $media): ?>
                                <?php 
                                    $mPath = $media['file_path'] ?? '';
                                    // Ensure path is relative to public root for display/value
                                    // If stored with leading slash, remove it for consistency?
                                    // User model handles '/' in getAvatarUrl.
                                    // Let's use clean relative path 'uploads/media/...'
                                    $mPathRel = ltrim($mPath, '/');
                                    
                                    $mName = $media['file_name'] ?? 'image';
                                    $mId = $media['id'] ?? uniqid();
                                    // Check if selected: current avatar matches this path (allowing for leading slash diff)
                                    $current = ltrim($adminUser->avatar ?? '', '/');
                                    $isSelected = $current === $mPathRel;
                                ?>
                                <div class="media-checkbox-option position-relative" style="width: 100px; height: 100px;" data-name="<?= htmlspecialchars($mName) ?>">
                                    <input type="radio" name="library_avatar" value="<?= htmlspecialchars($mPathRel) ?>" id="media_<?= $mId ?>" class="btn-check" <?= $isSelected ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-light p-0 w-100 h-100 overflow-hidden border shadow-sm d-flex align-items-center justify-content-center" for="media_<?= $mId ?>">
                                        <img src="<?= asset('/' . $mPathRel) ?>" alt="<?= htmlspecialchars($mName) ?>" 
                                             class="w-100 h-100" style="object-fit: cover;"
                                             title="<?= htmlspecialchars($mName) ?>"
                                             onerror="this.onerror=null;this.src='<?= asset('/img/product-placeholder.png') ?>';">
                                    </label>
                                    <div class="position-absolute top-0 end-0 p-1">
                                        <i class="fas fa-check-circle text-primary bg-white rounded-circle check-icon" style="opacity: 0; transition: opacity 0.2s;"></i>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="form-text">Selecting a library image sets it as your avatar.</div>
                </div>

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
                </script>

                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($adminUser->first_name ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($adminUser->last_name ?? '') ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($adminUser->email ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($adminUser->phone ?? '') ?>" required>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save Profile</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-lg-5">
        <form method="post" action="<?= url('/admin/profile/password') ?>" class="card">
            <div class="card-body row g-3">
                <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">

                <div class="col-12">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-outline-primary">Change Password</button>
                </div>
            </div>
        </form>
    </div>
</div>
