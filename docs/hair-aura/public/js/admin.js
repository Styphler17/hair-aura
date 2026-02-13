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
    document.querySelectorAll('.btn-delete').forEach((btn) => {
        btn.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });
    });
}

/**
 * Initialize charts
 */
function initCharts() {
    const salesChart = document.getElementById('salesChart');
    if (!salesChart || typeof Chart === 'undefined') {
        return;
    }

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
                    borderColor: '#D4A574',
                    backgroundColor: 'rgba(212, 165, 116, 0.14)',
                    fill: true,
                    tension: 0.3,
                    yAxisID: 'yRevenue'
                },
                {
                    label: 'Orders',
                    data: orderValues,
                    borderColor: '#2C2C2C',
                    backgroundColor: 'rgba(44,44,44,0.12)',
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
    formData.append('csrf_token', document.querySelector('[name="csrf_token"]')?.value || '');

    fetch(toAppUrl(`admin/orders/${orderId}/status`), {
        method: 'POST',
        body: formData
    })
    .then((res) => res.json())
    .then((data) => {
        if (data.success) {
            location.reload();
        }
    });
}
