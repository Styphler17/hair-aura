<?php
$isEdit = isset($account) && $account !== null;
$title = $isEdit ? 'Edit User' : 'Add User';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0"><?= $title ?></h2>
    <a href="<?= url('/admin/users') ?>" class="btn btn-outline-secondary">Back to Users</a>
</div>

<form method="post" action="<?= url('/admin/users/save') ?>" class="card">
    <div class="card-body row g-3">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
        <input type="hidden" name="id" value="<?= (int) ($account?->id ?? 0) ?>">

        <div class="col-md-6">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($account?->first_name ?? '') ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($account?->last_name ?? '') ?>" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($account?->email ?? '') ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($account?->phone ?? '') ?>" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="customer" <?= (($account?->role ?? 'customer') === 'customer') ? 'selected' : '' ?>>Customer</option>
                <option value="admin" <?= (($account?->role ?? '') === 'admin') ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

        <div class="col-md-6 d-flex align-items-end">
            <div class="form-check mb-2">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" <?= (($account?->is_active ?? 1) ? 'checked' : '') ?>>
                <label class="form-check-label" for="is_active">Active account</label>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label"><?= $isEdit ? 'New Password (optional)' : 'Password' ?></label>
            <input type="password" name="password" class="form-control" <?= $isEdit ? '' : 'required' ?>>
        </div>

        <?php if (!$isEdit): ?>
        <div class="col-md-6 d-flex align-items-end">
            <div class="form-check mb-2">
                <input type="checkbox" class="form-check-input" id="email_verified" name="email_verified" value="1" checked>
                <label class="form-check-label" for="email_verified">Email verified</label>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save User</button>
            <a href="<?= url('/admin/users') ?>" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </div>
</form>
