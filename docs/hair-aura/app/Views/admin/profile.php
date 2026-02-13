<h2 class="mb-3">Admin Profile Settings</h2>

<div class="row g-3">
    <div class="col-lg-7">
        <form method="post" action="<?= url('/admin/profile') ?>" enctype="multipart/form-data" class="card">
            <div class="card-body row g-3">
                <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">

                <div class="col-12 d-flex align-items-center gap-3">
                    <img src="<?= asset($adminUser->getAvatarUrl()) ?>" alt="<?= htmlspecialchars($adminUser->getFullName()) ?>" style="width:72px;height:72px;border-radius:50%;object-fit:cover;border:2px solid rgba(212,165,116,.45);">
                    <div class="flex-grow-1">
                        <label class="form-label">Profile Avatar</label>
                        <input type="file" name="avatar" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                        <div class="form-text">Recommended square image, max 2MB.</div>
                    </div>
                </div>

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
