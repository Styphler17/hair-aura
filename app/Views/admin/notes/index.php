<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Notes</h2>
</div>

<form method="get" action="<?= url('/admin/notes') ?>" class="card mb-3">
    <div class="card-body row g-2 align-items-end">
        <div class="col-md-8">
            <label class="form-label">Search Notes</label>
            <input type="text" name="search" class="form-control" value="<?= htmlspecialchars((string) ($search ?? '')) ?>" placeholder="Search by title or content">
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-outline-primary">Find</button>
        </div>
    </div>
</form>

<div class="row g-3">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><?= !empty($editingNote) ? 'Edit Note' : 'New Note' ?></h5>
            </div>
            <div class="card-body">
                <form method="post" action="<?= url('/admin/notes/save') ?>" class="row g-2">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <input type="hidden" name="id" value="<?= (int) ($editingNote['id'] ?? 0) ?>">
                    <div class="col-12">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars((string) ($editingNote['title'] ?? '')) ?>" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="8" required><?= htmlspecialchars((string) ($editingNote['content'] ?? '')) ?></textarea>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_pinned" id="is_pinned" value="1" <?= !empty($editingNote['is_pinned']) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_pinned">Pin this note</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><?= !empty($editingNote) ? 'Update Note' : 'Save Note' ?></button>
                        <?php if (!empty($editingNote)): ?>
                            <a href="<?= url('/admin/notes') ?>" class="btn btn-outline-secondary">Cancel</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Your Draft Notes</h5>
            </div>
            <div class="card-body p-0">
                <?php if (!empty($notes)): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($notes as $note): ?>
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start gap-2">
                                    <div>
                                        <div class="fw-semibold">
                                            <?= htmlspecialchars((string) ($note['title'] ?? 'Untitled')) ?>
                                            <?php if (!empty($note['is_pinned'])): ?>
                                                <span class="badge bg-warning text-dark ms-1">Pinned</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="small text-muted mt-1">
                                            <?= htmlspecialchars(strlen((string) ($note['content'] ?? '')) > 180 ? substr((string) ($note['content'] ?? ''), 0, 177) . '...' : (string) ($note['content'] ?? '')) ?>
                                        </div>
                                        <div class="small text-muted mt-2">
                                            Updated: <?= !empty($note['updated_at']) ? htmlspecialchars(date('Y-m-d H:i', strtotime($note['updated_at']))) : '-' ?>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-1">
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-secondary js-note-open"
                                            data-note-id="<?= (int) $note['id'] ?>"
                                            data-note-title="<?= htmlspecialchars((string) ($note['title'] ?? 'Untitled')) ?>"
                                            data-note-updated="<?= !empty($note['updated_at']) ? htmlspecialchars(date('Y-m-d H:i', strtotime((string) $note['updated_at']))) : '-' ?>"
                                            data-note-pinned="<?= !empty($note['is_pinned']) ? '1' : '0' ?>"
                                        >Open</button>
                                        <a href="<?= url('/admin/notes?edit=' . (int) $note['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form method="post" action="<?= url('/admin/notes/delete/' . (int) $note['id']) ?>" class="d-inline">
                                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">Archive</button>
                                        </form>
                                    </div>
                                </div>
                                <textarea id="noteContent<?= (int) $note['id'] ?>" class="d-none"><?= htmlspecialchars((string) ($note['content'] ?? '')) ?></textarea>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center py-4 mb-0">No notes yet. Create your first admin draft note.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="notePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" data-note-title>Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="small text-muted mb-2">
                    <span data-note-pinned-badge class="badge bg-warning text-dark d-none me-2">Pinned</span>
                    <span>Updated: </span><span data-note-updated>-</span>
                </div>
                <pre class="mb-0 p-3 rounded border bg-light" data-note-content style="white-space: pre-wrap; font-family: inherit;"></pre>
            </div>
        </div>
    </div>
</div>
