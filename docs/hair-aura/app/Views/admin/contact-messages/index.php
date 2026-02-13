<h2 class="mb-3">Contact Messages</h2>

<form method="get" action="<?= url('/admin/contact-messages') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-md-7">
            <label class="form-label">Search</label>
            <input type="text" name="search" class="form-control" value="<?= htmlspecialchars((string) ($search ?? '')) ?>" placeholder="Name, email, subject, message">
        </div>
        <div class="col-md-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="" <?= empty($status) ? 'selected' : '' ?>>All</option>
                <option value="unread" <?= (($status ?? '') === 'unread') ? 'selected' : '' ?>>Unread</option>
                <option value="read" <?= (($status ?? '') === 'read') ? 'selected' : '' ?>>Read</option>
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-outline-primary">Filter</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 admin-table-mobile">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($messages)): ?>
                        <?php foreach ($messages as $message): ?>
                            <tr>
                                <td data-label="Name"><?= htmlspecialchars((string) ($message['name'] ?? '')) ?></td>
                                <td data-label="Email"><?= htmlspecialchars((string) ($message['email'] ?? '')) ?></td>
                                <td data-label="Phone"><?= htmlspecialchars((string) ($message['phone'] ?? '')) ?></td>
                                <td data-label="Subject"><?= htmlspecialchars((string) ($message['subject'] ?? '')) ?></td>
                                <?php
                                $messageText = (string) ($message['message'] ?? '');
                                $shortMessage = strlen($messageText) > 70 ? substr($messageText, 0, 67) . '...' : $messageText;
                                ?>
                                <td data-label="Message"><?= htmlspecialchars($shortMessage) ?></td>
                                <td data-label="Status">
                                    <?php if (empty($message['is_read'])): ?>
                                        <span class="badge bg-warning text-dark">Unread</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Read</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Date"><?= !empty($message['created_at']) ? htmlspecialchars(date('Y-m-d H:i', strtotime($message['created_at']))) : '-' ?></td>
                                <td data-label="Action" class="text-end">
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-primary js-contact-read"
                                        data-message-id="<?= (int) ($message['id'] ?? 0) ?>"
                                        data-message-name="<?= htmlspecialchars((string) ($message['name'] ?? '')) ?>"
                                        data-message-email="<?= htmlspecialchars((string) ($message['email'] ?? '')) ?>"
                                        data-message-phone="<?= htmlspecialchars((string) ($message['phone'] ?? '')) ?>"
                                        data-message-subject="<?= htmlspecialchars((string) ($message['subject'] ?? '')) ?>"
                                        data-message-date="<?= !empty($message['created_at']) ? htmlspecialchars(date('Y-m-d H:i', strtotime((string) $message['created_at']))) : '-' ?>"
                                    >Read</button>
                                    <form method="post" action="<?= url('/admin/contact-messages/delete/' . (int) $message['id']) ?>" class="d-inline">
                                        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">Delete</button>
                                    </form>
                                    <textarea id="contactMessageBody<?= (int) ($message['id'] ?? 0) ?>" class="d-none"><?= htmlspecialchars((string) ($message['message'] ?? '')) ?></textarea>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No contact messages found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="contactMessageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" data-contact-subject>Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 small text-muted">
                    <div><strong>Name:</strong> <span data-contact-name>-</span></div>
                    <div><strong>Email:</strong> <span data-contact-email>-</span></div>
                    <div><strong>Phone:</strong> <span data-contact-phone>-</span></div>
                    <div><strong>Date:</strong> <span data-contact-date>-</span></div>
                </div>
                <pre class="mb-0 p-3 rounded border bg-light" data-contact-body style="white-space: pre-wrap; font-family: inherit;"></pre>
            </div>
        </div>
    </div>
</div>
