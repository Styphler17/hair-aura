<section class="py-5">
    <div class="container">
        <h1 class="mb-4">My Profile</h1>
        <div class="row g-4">
            <div class="col-lg-6">
                <h5 class="mb-3">Update Profile</h5>
                <form method="post" action="<?= url('/account/profile') ?>" enctype="multipart/form-data" class="row g-3">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <div class="col-12 d-flex align-items-center gap-3">
                        <img src="<?= asset($user->getAvatarUrl()) ?>" alt="<?= htmlspecialchars($user->getFullName()) ?>" style="width:72px;height:72px;border-radius:50%;object-fit:cover;border:2px solid rgba(212,165,116,.4);">
                        <div class="flex-grow-1">
                            <label class="form-label">Profile Avatar</label>
                            <input type="file" name="avatar" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                            <div class="form-text">Recommended square image, max 2MB.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($user->first_name ?? '') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($user->last_name ?? '') ?>" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user->phone ?? '') ?>" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save Profile</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                <h5 class="mb-3">Change Password</h5>
                <form method="post" action="<?= url('/account/password') ?>" class="row g-3">
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
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
