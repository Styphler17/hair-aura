/**
 * Hair Aura - Admin Panel JavaScript
 */

const APP_BASE = document.documentElement.getAttribute('data-app-base') || '';

function toAppUrl(path) {
    const cleanPath = String(path || '').replace(/^\/+/, '');
    const cleanBase = APP_BASE.replace(/\/+$/, '');
    return cleanBase ? `${cleanBase}/${cleanPath}` : `/${cleanPath}`;
}

document.addEventListener('DOMContentLoaded', function() {
    initSidebar();
    initCharts();
    initDeleteConfirm();
    initImagePreview();
    initSlugGeneration();
    initNotesModal();
    initContactMessageModal();
    initMediaClipboard();
    initBackToTop();
});

function initSidebar() {
    const wrapper = document.querySelector('.admin-wrapper');
    const sidebar = document.querySelector('.admin-sidebar');
    const toggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('adminSidebarOverlay');
    if (!wrapper || !sidebar || !toggle) {
        return;
    }

    const mobileQuery = window.matchMedia('(max-width: 991.98px)');

    const syncByViewport = () => {
        if (mobileQuery.matches) {
            wrapper.classList.add('sidebar-collapsed');
            wrapper.classList.remove('sidebar-open');
        } else {
            wrapper.classList.remove('sidebar-open');
        }
    };

    const closeMobileSidebar = () => {
        if (!mobileQuery.matches) {
            return;
        }

        wrapper.classList.remove('sidebar-open');
        wrapper.classList.add('sidebar-collapsed');
    };

    toggle.addEventListener('click', function() {
        if (mobileQuery.matches) {
            const opening = !wrapper.classList.contains('sidebar-open');
            wrapper.classList.toggle('sidebar-open', opening);
            wrapper.classList.toggle('sidebar-collapsed', !opening);
            return;
        }

        wrapper.classList.toggle('sidebar-collapsed');
    });

    if (overlay) {
        overlay.addEventListener('click', closeMobileSidebar);
    }

    document.addEventListener('click', function(event) {
        if (!mobileQuery.matches || !wrapper.classList.contains('sidebar-open')) {
            return;
        }

        if (sidebar.contains(event.target) || toggle.contains(event.target)) {
            return;
        }

        closeMobileSidebar();
    });

    window.addEventListener('resize', syncByViewport);
    syncByViewport();
}

function initDeleteConfirm() {
    // Generic AJAX Form Submission (for single items)
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.id === 'deleteItemForm' || form.id === 'deleteOrderForm' || form.id === 'deactivateUserForm') {
            e.preventDefault();
            handleAjaxFormSubmit(form);
        }
    });

    // Generic AJAX Bulk Action handling
    const confirmBulk = document.getElementById('confirmBulkDelete') || document.getElementById('confirmBulkDeactivate');
    if (confirmBulk) {
        confirmBulk.addEventListener('click', function() {
            const bulkForm = document.getElementById('bulkActionForm') || document.getElementById('bulkUserForm');
            if (!bulkForm) return;

            const modalElement = document.closestModal(this);
            const bootstrapModal = modalElement ? window.bootstrap.Modal.getInstance(modalElement) : null;
            
            const formData = new FormData(bulkForm);
            const action = bulkForm.getAttribute('action');
            
            const originalHtml = this.innerHTML;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Processing...';
            this.disabled = true;

            fetch(action, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const checkedCount = bulkForm.querySelectorAll('.item-checkbox:checked, .user-checkbox:checked');
                    checkedCount.forEach(cb => {
                        const row = cb.closest('article, tr');
                        if (row) row.remove();
                    });
                    if (bootstrapModal) bootstrapModal.hide();
                    showToast(data.message || 'Action successful', 'success');
                    
                    const bulkBar = document.getElementById('bulkActionsBar');
                    if (bulkBar) bulkBar.classList.add('d-none');

                    // Special case for media library
                    const mediaGrid = document.querySelector('.media-gallery-grid');
                    if (mediaGrid && mediaGrid.children.length === 0) {
                        location.reload();
                    }
                } else {
                    showToast(data.message || 'Error occurred', 'danger');
                }
            })
            .catch(err => {
                console.error(err);
                showToast('Network error occurred', 'danger');
            })
            .finally(() => {
                this.innerHTML = originalHtml;
                this.disabled = false;
            });
        });
    }

    // Generic Status/Select Change AJAX
    document.addEventListener('change', function(e) {
        const el = e.target;
        if (el.classList.contains('status-dropdown') || el.classList.contains('order-status-select') || el.classList.contains('customer-status-select') || el.classList.contains('user-status-select')) {
            const id = el.dataset.id;
            const url = el.dataset.url || toAppUrl(`${getCurrentAdminType()}/update-status/${id}`);
            const status = el.value;
            const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
            
            el.classList.add('loading-spinner');

            const body = new FormData();
            body.append('status', status);
            body.append('csrf_token', csrf);

            fetch(url, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                body: body
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                } else {
                    showToast(data.message, 'danger');
                }
            })
            .catch(err => {
                console.error(err);
                showToast('Network error', 'danger');
            })
            .finally(() => {
                el.classList.remove('loading-spinner');
            });
        }
    });

    // Individual Action Buttons (that don't use modals)
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-approve-review, .btn-reject-review');
        if (btn) {
            e.preventDefault();
            const url = btn.dataset.url;
            const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `csrf_token=${encodeURIComponent(csrf)}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    btn.closest('tr').remove();
                    showToast(data.message, 'success');
                } else {
                    showToast(data.message, 'danger');
                }
            });
        }
    });
}

/**
 * Helper to handle single item delete/action forms
 */
function handleAjaxFormSubmit(form) {
    const action = form.getAttribute('action');
    const formData = new FormData(form);
    const modalElement = document.closestModal(form);
    const bootstrapModal = modalElement ? window.bootstrap.Modal.getInstance(modalElement) : null;
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalHtml = submitBtn ? submitBtn.innerHTML : '';
    
    // Extract ID from action if possible (legacy support)
    const itemIdMatch = action.match(/\/delete\/(\d+)/) || action.match(/\/status\/(\d+)/);
    const itemId = itemIdMatch ? itemIdMatch[1] : null;

    if (submitBtn) {
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Processing...';
        submitBtn.disabled = true;
    }

    fetch(action, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Find and remove the row/element
            if (itemId) {
                const element = document.querySelector(`[data-id="${itemId}"]`)?.closest('article, tr, .media-card');
                if (element) element.remove();
            } else if (form.id === 'deactivateUserForm') {
                // If it's a user deactivation and we don't have ID in URL, we might need reload or find it differently
                location.reload();
            }
            
            if (bootstrapModal) bootstrapModal.hide();
            showToast(data.message || 'Successful', 'success');
            
            // Special check for empty states
            const mediaGrid = document.querySelector('.media-gallery-grid');
            if (mediaGrid && mediaGrid.children.length === 0) {
                location.reload();
            }
        } else {
            showToast(data.message || 'Error occurred', 'danger');
            if (submitBtn) {
                submitBtn.innerHTML = originalHtml;
                submitBtn.disabled = false;
            }
        }
    })
    .catch(err => {
        console.error(err);
        showToast('Network error occurred', 'danger');
        if (submitBtn) {
            submitBtn.innerHTML = originalHtml;
            submitBtn.disabled = false;
        }
    });
}

/**
 * Helper to find current admin section
 */
function getCurrentAdminType() {
    const path = window.location.pathname;
    if (path.includes('/products')) return 'admin/products';
    if (path.includes('/orders')) return 'admin/orders';
    if (path.includes('/customers')) return 'admin/customers';
    if (path.includes('/users')) return 'admin/users';
    if (path.includes('/blogs')) return 'admin/blogs';
    if (path.includes('/categories')) return 'admin/categories';
    return 'admin';
}

// Add polyfill/helper for closest modal
document.closestModal = function(el) {
    return el.closest('.modal');
};

function showToast(message, type = 'success') {
    // Try to find a good place for the toast
    let container = document.querySelector('.admin-content');
    if (!container) container = document.body;

    const div = document.createElement('div');
    div.className = `alert alert-${type === 'danger' ? 'danger' : 'success'} alert-dismissible fade show shadow-sm`;
    div.style.position = 'fixed';
    div.style.top = '20px';
    div.style.right = '20px';
    div.style.zIndex = '9999';
    div.style.minWidth = '250px';
    
    div.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas ${type === 'danger' ? 'fa-exclamation-circle' : 'fa-check-circle'} me-2"></i>
            <div>${message}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    
    document.body.appendChild(div);
    
    setTimeout(() => {
        const bsAlert = new bootstrap.Alert(div);
        bsAlert.close();
    }, 4000);
}

/**
 * Initialize charts
 */
function initCharts() {
    const salesChart = document.getElementById('salesChart');
    if (!salesChart || typeof Chart === 'undefined') {
        return;
    }

    const css = getComputedStyle(document.documentElement);
    const primaryColor = (css.getPropertyValue('--primary') || '#D4A574').trim();
    const secondaryColor = (css.getPropertyValue('--secondary') || '#2C2C2C').trim();
    const primaryFill = hexToRgba(primaryColor, 0.14);
    const secondaryFill = hexToRgba(secondaryColor, 0.12);

    const source = document.getElementById('salesChartData');
    let rows = [];
    if (source) {
        try {
            rows = JSON.parse(source.textContent || '[]');
        } catch (e) {
            rows = [];
        }
    }

    const labels = rows.map((row) => {
        const date = new Date(row.date || row.created_at || Date.now());
        return date.toLocaleDateString(undefined, { month: 'short', day: 'numeric' });
    });

    const revenueValues = rows.map((row) => Number(row.revenue || 0));
    const orderValues = rows.map((row) => Number(row.orders || 0));

    new Chart(salesChart, {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Revenue (GH₵)',
                    data: revenueValues,
                    borderColor: primaryColor,
                    backgroundColor: primaryFill,
                    fill: true,
                    tension: 0.3,
                    yAxisID: 'yRevenue'
                },
                {
                    label: 'Orders',
                    data: orderValues,
                    borderColor: secondaryColor,
                    backgroundColor: secondaryFill,
                    fill: false,
                    tension: 0.2,
                    yAxisID: 'yOrders'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        usePointStyle: true,
                        boxWidth: 8
                    }
                }
            },
            scales: {
                yRevenue: {
                    type: 'linear',
                    position: 'left',
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'GH₵' + Number(value).toLocaleString();
                        }
                    }
                },
                yOrders: {
                    type: 'linear',
                    position: 'right',
                    beginAtZero: true,
                    grid: {
                        drawOnChartArea: false
                    }
                }
            }
        }
    });
}

function hexToRgba(hex, alpha) {
    const normalized = String(hex || '').trim().replace('#', '');
    if (!/^[0-9a-fA-F]{6}$/.test(normalized)) {
        return `rgba(212, 165, 116, ${alpha})`;
    }

    const r = parseInt(normalized.slice(0, 2), 16);
    const g = parseInt(normalized.slice(2, 4), 16);
    const b = parseInt(normalized.slice(4, 6), 16);
    return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}

/**
 * Image preview for uploads
 */
function initImagePreview() {
    const imageInput = document.getElementById('productImages');
    const previewContainer = document.getElementById('imagePreview');

    if (!imageInput || !previewContainer) {
        return;
    }

    imageInput.addEventListener('change', function() {
        previewContainer.innerHTML = '';

        Array.from(this.files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'preview-item';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                    <button type="button" class="btn-remove" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                previewContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    });
}

/**
 * Auto-generate slug from name
 */
function initSlugGeneration() {
    const nameInput = document.getElementById('productName');
    const slugInput = document.getElementById('productSlug');

    if (!nameInput || !slugInput) {
        return;
    }

    nameInput.addEventListener('blur', function() {
        if (!slugInput.value) {
            slugInput.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-|-$/g, '');
        }
    });
}

/**
 * Initialize back to top button
 */
function initBackToTop() {
    const backToTopBtn = document.getElementById('adminBackToTopBtn');
    if (!backToTopBtn) {
        return;
    }

    const toggleState = () => {
        if (window.scrollY > 300) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    };

    window.addEventListener('scroll', toggleState, { passive: true });

    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    toggleState();
}

function initNotesModal() {
    const modalElement = document.getElementById('notePreviewModal');
    if (!modalElement) {
        return;
    }

    const titleTarget = modalElement.querySelector('[data-note-title]');
    const updatedTarget = modalElement.querySelector('[data-note-updated]');
    const contentTarget = modalElement.querySelector('[data-note-content]');
    const pinnedBadge = modalElement.querySelector('[data-note-pinned-badge]');

    document.querySelectorAll('.js-note-open').forEach((button) => {
        button.addEventListener('click', () => {
            const noteId = button.getAttribute('data-note-id') || '';
            const noteTitle = button.getAttribute('data-note-title') || 'Note';
            const noteUpdated = button.getAttribute('data-note-updated') || '-';
            const isPinned = button.getAttribute('data-note-pinned') === '1';
            const contentSource = document.getElementById(`noteContent${noteId}`);
            const noteContent = contentSource ? contentSource.value : '';

            if (titleTarget) {
                titleTarget.textContent = noteTitle;
            }
            if (updatedTarget) {
                updatedTarget.textContent = noteUpdated;
            }
            if (contentTarget) {
                contentTarget.textContent = noteContent || '(No content)';
            }
            if (pinnedBadge) {
                pinnedBadge.classList.toggle('d-none', !isPinned);
            }

            if (window.bootstrap && window.bootstrap.Modal) {
                window.bootstrap.Modal.getOrCreateInstance(modalElement).show();
            }
        });
    });
}

function initContactMessageModal() {
    const modalElement = document.getElementById('contactMessageModal');
    if (!modalElement) {
        return;
    }

    const nameTarget = modalElement.querySelector('[data-contact-name]');
    const emailTarget = modalElement.querySelector('[data-contact-email]');
    const phoneTarget = modalElement.querySelector('[data-contact-phone]');
    const subjectTarget = modalElement.querySelector('[data-contact-subject]');
    const dateTarget = modalElement.querySelector('[data-contact-date]');
    const bodyTarget = modalElement.querySelector('[data-contact-body]');

    document.querySelectorAll('.js-contact-read').forEach((button) => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-message-id') || '';
            const source = document.getElementById(`contactMessageBody${id}`);

            if (nameTarget) {
                nameTarget.textContent = button.getAttribute('data-message-name') || '-';
            }
            if (emailTarget) {
                emailTarget.textContent = button.getAttribute('data-message-email') || '-';
            }
            if (phoneTarget) {
                phoneTarget.textContent = button.getAttribute('data-message-phone') || '-';
            }
            if (subjectTarget) {
                subjectTarget.textContent = button.getAttribute('data-message-subject') || 'Message';
            }
            if (dateTarget) {
                dateTarget.textContent = button.getAttribute('data-message-date') || '-';
            }
            if (bodyTarget) {
                bodyTarget.textContent = source ? source.value : '';
            }

            if (window.bootstrap && window.bootstrap.Modal) {
                window.bootstrap.Modal.getOrCreateInstance(modalElement).show();
            }
        });
    });
}

function initMediaClipboard() {
    document.querySelectorAll('.js-copy-media-path').forEach((button) => {
        button.addEventListener('click', async () => {
            const value = button.getAttribute('data-copy') || '';
            if (!value) {
                return;
            }

            try {
                await navigator.clipboard.writeText(value);
                const previous = button.textContent;
                button.textContent = 'Copied';
                setTimeout(() => {
                    button.textContent = previous;
                }, 1200);
            } catch (e) {
                // Clipboard may be unavailable; ignore gracefully.
            }
        });
    });
}

/**
 * Update order status
 */
function updateOrderStatus(orderId, status) {
    const formData = new FormData();
    formData.append('status', status);
    formData.append('csrf_token', document.querySelector('meta[name="csrf-token"]')?.content || '');

    fetch(toAppUrl(`admin/orders/${orderId}/status`), {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: formData
    })
    .then((res) => res.json())
    .then((data) => {
        if (data.success) {
            showToast(data.message);
        }
    });
}

