<h2 class="mb-3">Contact Information</h2>

<form method="post" action="<?= url('/admin/contact-info') ?>" class="card">
    <div class="card-body row g-3">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">

        <div class="col-md-6">
            <label class="form-label">Support Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($contact['email'] ?? '') ?>" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($contact['phone'] ?? '') ?>" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">WhatsApp</label>
            <input type="text" name="whatsapp" class="form-control" value="<?= htmlspecialchars($contact['whatsapp'] ?? '') ?>" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($contact['location'] ?? '') ?>" required>
        </div>

        <div class="col-12">
            <label class="form-label">Business Hours</label>
            <input type="text" name="business_hours" class="form-control" value="<?= htmlspecialchars($contact['business_hours'] ?? '') ?>">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save Contact Information</button>
        </div>
    </div>
</form>