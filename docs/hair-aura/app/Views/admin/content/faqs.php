<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Manage FAQs</h2>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Add New FAQ</h5>
    </div>
    <div class="card-body">
        <form method="post" action="<?= url('/admin/faqs/save') ?>" class="row g-3">
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
            <div class="col-12">
                <label class="form-label text-primary fw-bold"><i class="fas fa-question-circle me-1"></i> Question</label>
                <input type="text" name="question" class="form-control hover-shadow transition" required placeholder="e.g. Do you ship across Ghana?">
            </div>
            <div class="col-12">
                <label class="form-label text-info fw-bold"><i class="fas fa-comment-dots me-1"></i> Answer</label>
                <textarea name="answer" class="form-control hover-shadow transition" rows="3" required placeholder="Provide a detailed answer..."></textarea>
            </div>
            <div class="col-md-3">
                <label class="form-label text-success fw-bold"><i class="fas fa-sort-numeric-down me-1"></i> Sort Order</label>
                <input type="number" name="sort_order" class="form-control hover-shadow transition" value="0">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="is_active" id="newFaqActive" value="1" checked>
                    <label class="form-check-label" for="newFaqActive">Active</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Add FAQ</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <form id="bulkActionForm" method="post" action="<?= url('/admin/faqs/bulk-delete') ?>">
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
            <div class="table-responsive">
                <table class="table table-hover mb-0 admin-table-mobile">
                    <thead>
                        <tr>
                            <th style="width: 40px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAllFaqs">
                                </div>
                            </th>
                            <th style="width: 30%;">Question</th>
                            <th style="width: 40%;">Answer</th>
                            <th>Sort</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($faqs)): ?>
                            <?php foreach ($faqs as $faq): ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input faq-checkbox" type="checkbox" name="ids[]" value="<?= (int) $faq['id'] ?>">
                                        </div>
                                    </td>
                                    <td data-label="Question"><strong><?= htmlspecialchars($faq['question']) ?></strong></td>
                                    <td data-label="Answer">
                                        <div class="small text-muted" style="max-height: 50px; overflow: hidden;"><?= htmlspecialchars($faq['answer']) ?></div>
                                    </td>
                                    <td data-label="Sort"><?= (int) $faq['sort_order'] ?></td>
                                    <td data-label="Status">
                                        <?php if (!empty($faq['is_active'])): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="Actions" class="text-end">
                                        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#editFaq<?= (int) $faq['id'] ?>">Edit</button>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteFaqModal" 
                                                data-id="<?= (int) $faq['id'] ?>"
                                                data-question="<?= htmlspecialchars($faq['question']) ?>">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <tr class="collapse" id="editFaq<?= (int) $faq['id'] ?>">
                                    <td colspan="6" class="bg-light">
                                        <div class="row g-3 p-3">
                                            <form method="post" action="<?= url('/admin/faqs/save') ?>" class="row g-3">
                                                <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                                <input type="hidden" name="id" value="<?= (int) $faq['id'] ?>">
                                                <div class="col-12">
                                                    <label class="form-label text-primary fw-bold"><i class="fas fa-question-circle me-1"></i> Question</label>
                                                    <input type="text" name="question" class="form-control hover-shadow transition" value="<?= htmlspecialchars($faq['question']) ?>" required>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label text-info fw-bold"><i class="fas fa-comment-dots me-1"></i> Answer</label>
                                                    <textarea name="answer" class="form-control hover-shadow transition" rows="3" required><?= htmlspecialchars($faq['answer']) ?></textarea>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label text-success fw-bold"><i class="fas fa-sort-numeric-down me-1"></i> Sort Order</label>
                                                    <input type="number" name="sort_order" class="form-control hover-shadow transition" value="<?= (int) $faq['sort_order'] ?>">
                                                </div>
                                                <div class="col-md-3 d-flex align-items-end">
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" name="is_active" id="editActive<?= (int) $faq['id'] ?>" value="1" <?= !empty($faq['is_active']) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="editActive<?= (int) $faq['id'] ?>">Active</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-end">
                                                    <button type="submit" class="btn btn-primary">Update FAQ</button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No FAQs found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<!-- Bulk Actions Bar -->
<div id="bulkActionsBar" class="position-fixed bottom-0 start-50 translate-middle-x mb-4 d-none" style="z-index: 1050;">
    <div class="card shadow-lg border-0 bg-dark text-white px-4 py-3">
        <div class="d-flex align-items-center gap-4">
            <div><span id="selectedCount">0</span> items selected</div>
            <div class="vr"></div>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#bulkDeleteModal">
                <i class="fas fa-trash-alt me-2"></i>Delete Selected
            </button>
        </div>
    </div>
</div>

<!-- Bulk Delete Modal -->
<div class="modal fade" id="bulkDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Bulk Delete FAQs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <i class="fas fa-exclamation-triangle text-danger fa-4x mb-3"></i>
                <h4 class="fw-bold">Delete <span id="bulkDeleteCount">0</span> FAQs?</h4>
                <p class="text-muted">This action will permanently remove all selected items. This cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger px-4" id="confirmBulkDelete">Yes, Delete All</button>
            </div>
        </div>
    </div>
</div>

<!-- Single Delete Confirmation Modal -->
<div class="modal fade" id="deleteFaqModal" tabindex="-1" aria-labelledby="deleteFaqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger" id="deleteFaqModalLabel">Delete FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 border-0">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-circle text-danger fa-4x mb-3"></i>
                    <h4 class="fw-bold">Are you sure?</h4>
                    <p class="text-muted">You are about to delete the following FAQ:</p>
                    <div class="p-3 bg-light rounded text-start italic border-start border-danger border-4">
                        <span id="faqToDeleteQuestion" class="fw-semibold"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">No, Cancel</button>
                <form id="deleteFaqForm" method="post" action="">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                    <button type="submit" class="btn btn-danger px-4">Yes, Delete It</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Single Delete Modal
    const deleteModal = document.getElementById('deleteFaqModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const faqId = button.getAttribute('data-id');
            const question = button.getAttribute('data-question');
            const form = document.getElementById('deleteFaqForm');
            const questionSpan = document.getElementById('faqToDeleteQuestion');
            form.action = '<?= url('/admin/faqs/delete/') ?>' + faqId;
            questionSpan.textContent = question;
        });
    }

    // Multi-select Logic
    const selectAll = document.getElementById('selectAllFaqs');
    const checkboxes = document.querySelectorAll('.faq-checkbox');
    const bulkBar = document.getElementById('bulkActionsBar');
    const selectedCount = document.getElementById('selectedCount');
    const bulkDeleteCount = document.getElementById('bulkDeleteCount');
    const bulkForm = document.getElementById('bulkActionForm');
    const confirmBulk = document.getElementById('confirmBulkDelete');

    function updateBulkBar() {
        const checked = document.querySelectorAll('.faq-checkbox:checked').length;
        if (checked > 0) {
            bulkBar.classList.remove('d-none');
            selectedCount.textContent = checked;
            bulkDeleteCount.textContent = checked;
        } else {
            bulkBar.classList.add('d-none');
        }
    }

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateBulkBar();
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            const allChecked = Array.from(checkboxes).every(c => c.checked);
            selectAll.checked = allChecked;
            updateBulkBar();
        });
    });

    if (confirmBulk) {
        confirmBulk.addEventListener('click', function() {
            bulkForm.submit();
        });
    }
});
</script>
