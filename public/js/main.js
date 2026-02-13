/**
 * Hair Aura - Main JavaScript
 * Premium Wigs & Hair Extensions E-Commerce
 * 
 * @author Hair Aura Team
 * @version 1.0.0
 */

const APP_BASE = document.documentElement.getAttribute('data-app-base') || '';

function toAppUrl(path) {
    const cleanPath = String(path || '').replace(/^\/+/, '');
    const cleanBase = APP_BASE.replace(/\/+$/, '');
    return cleanBase ? `${cleanBase}/${cleanPath}` : `/${cleanPath}`;
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Swiper sliders
    initSwipers();
    
    // Initialize cart functionality
    initCart();
    
    // Initialize wishlist
    initWishlist();
    initWishlistListRemoval();
    
    // Initialize quick view
    initQuickView();
    
    // Initialize newsletter
    initNewsletter();
    
    // Initialize product image gallery
    initProductGallery();
    
    // Initialize quantity selectors
    initQuantitySelectors();
    
    // Initialize mobile menu
    initMobileMenu();

    // Initialize live search on all search forms
    initLiveSearch();

    // Initialize back to top button
    initBackToTop();
});

/**
 * Initialize Swiper sliders
 */
function initSwipers() {
    // Hero slider
    if (document.querySelector('.hero-swiper')) {
        new Swiper('.hero-swiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            pagination: {
                el: '.hero-pagination',
                clickable: true
            },
            navigation: {
                prevEl: '.hero-prev',
                nextEl: '.hero-next'
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            }
        });
    }
    
    // Bestseller slider
    if (document.querySelector('.bestseller-swiper')) {
        new Swiper('.bestseller-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            breakpoints: {
                576: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                992: { slidesPerView: 4 }
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            }
        });
    }
    
    // Testimonial slider
    if (document.querySelector('.testimonial-swiper')) {
        new Swiper('.testimonial-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            breakpoints: {
                768: { slidesPerView: 2 },
                992: { slidesPerView: 3 }
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            autoplay: {
                delay: 4000
            }
        });
    }
}

/**
 * Initialize cart functionality
 */
function initCart() {
    // Add to cart buttons
    document.querySelectorAll('.btn-add-cart').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.dataset.productId;
            const form = this.closest('form');
            
            let formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', form?.querySelector('[name="quantity"]')?.value || 1);
            
            const variantSelect = form?.querySelector('[name="variant_id"]');
            if (variantSelect) {
                formData.append('variant_id', variantSelect.value);
            }
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || 
                             document.querySelector('[name="csrf_token"]')?.value;
            if (csrfToken) {
                formData.append('csrf_token', csrfToken);
            }
            
            fetch(toAppUrl('cart/add'), {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    updateCartCount(data.cart_count);
                    showNotification(data.message, 'success');
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(err => {
                console.error('Error:', err);
                showNotification('Something went wrong', 'error');
            });
        });
    });
}

/**
 * Update cart count in header
 */
function updateCartCount(count) {
    const cartCountEl = document.getElementById('cartCount');
    if (cartCountEl) {
        cartCountEl.textContent = count;
        cartCountEl.classList.add('bounce');
        setTimeout(() => cartCountEl.classList.remove('bounce'), 500);
    }
}

/**
 * Initialize wishlist functionality
 */
function initWishlist() {
    document.querySelectorAll('.btn-wishlist').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.dataset.productId;
            const isActive = this.classList.contains('active');
            
            const formData = new FormData();
            formData.append('product_id', productId);
            
            const csrfToken = document.querySelector('[name="csrf_token"]')?.value;
            if (csrfToken) {
                formData.append('csrf_token', csrfToken);
            }
            
            const url = isActive ? toAppUrl('account/wishlist/remove') : toAppUrl('account/wishlist/add');
            
            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.classList.toggle('active');
                    const icon = this.querySelector('i');
                    icon.classList.toggle('far');
                    icon.classList.toggle('fas');
                    showNotification(data.message, 'success');
                }
            });
        });
    });
}

/**
 * Remove items from wishlist page cards.
 */
function initWishlistListRemoval() {
    const removeButtons = document.querySelectorAll('.btn-remove-wishlist');
    if (!removeButtons.length) {
        return;
    }

    removeButtons.forEach((btn) => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            const productId = this.dataset.productId;
            if (!productId) {
                return;
            }

            const formData = new FormData();
            formData.append('product_id', productId);

            const csrfToken = document.getElementById('wishlistCsrfToken')?.value ||
                document.querySelector('[name="csrf_token"]')?.value;
            if (csrfToken) {
                formData.append('csrf_token', csrfToken);
            }

            fetch(toAppUrl('account/wishlist/remove'), {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then((res) => res.json())
                .then((data) => {
                    if (!data.success) {
                        showNotification(data.message || 'Could not remove from wishlist', 'error');
                        return;
                    }

                    const card = this.closest('.wishlist-item');
                    if (card) {
                        card.remove();
                    }

                    const remaining = document.querySelectorAll('.wishlist-item').length;
                    if (remaining === 0) {
                        document.getElementById('wishlistGrid')?.classList.add('d-none');
                        document.getElementById('wishlistEmptyMessage')?.classList.remove('d-none');
                    }

                    showNotification('Removed from wishlist', 'success');
                })
                .catch(() => showNotification('Could not remove from wishlist', 'error'));
        });
    });
}

/**
 * Initialize quick view modal
 */
function initQuickView() {
    document.querySelectorAll('.btn-quickview').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.dataset.productId;
            
            fetch(toAppUrl(`product/quick-view/${productId}`))
            .then(res => res.json())
            .then(data => {
                const modalContent = document.getElementById('quickViewContent');
                if (modalContent) {
                    modalContent.innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <img src="${data.image}" alt="${data.name}" class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                <h4>${data.name}</h4>
                                <div class="price">
                                    ${data.on_sale ? `<del>GH₵${Number(data.original_price).toFixed(2)}</del>` : ''}
                                    <span class="current">GH₵${Number(data.price).toFixed(2)}</span>
                                </div>
                                <p>${data.description}</p>
                                <a href="${toAppUrl(`product/${data.slug}`)}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    `;
                    
                    const modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
                    modal.show();
                }
            });
        });
    });
}

/**
 * Initialize newsletter form
 */
function initNewsletter() {
    const form = document.getElementById('newsletterForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch(toAppUrl('newsletter'), {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                const msgDiv = document.getElementById('newsletterMessage');
                msgDiv.innerHTML = `<div class="alert alert-${data.success ? 'success' : 'danger'} mt-2">${data.message}</div>`;
                
                if (data.success) {
                    form.reset();
                }
            });
        });
    }
}

/**
 * Initialize product image gallery
 */
function initProductGallery() {
    const thumbnails = document.querySelectorAll('.thumbnail-images .thumbnail');
    const mainImage = document.getElementById('mainImage');
    
    if (mainImage && thumbnails.length > 0) {
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const newImage = this.dataset.image;
                mainImage.src = newImage;
                
                thumbnails.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }
}

/**
 * Initialize quantity selectors
 */
function initQuantitySelectors() {
    document.querySelectorAll('.quantity-selector').forEach(selector => {
        const input = selector.querySelector('input');
        const btnMinus = selector.querySelector('.btn-minus');
        const btnPlus = selector.querySelector('.btn-plus');
        
        if (btnMinus) {
            btnMinus.addEventListener('click', () => {
                const currentVal = parseInt(input.value) || 1;
                if (currentVal > 1) {
                    input.value = currentVal - 1;
                }
            });
        }
        
        if (btnPlus) {
            btnPlus.addEventListener('click', () => {
                const currentVal = parseInt(input.value) || 1;
                const maxVal = parseInt(input.max) || 99;
                if (currentVal < maxVal) {
                    input.value = currentVal + 1;
                }
            });
        }
    });
}

/**
 * Initialize mobile menu
 */
function initMobileMenu() {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!navbarToggler.contains(e.target) && !navbarCollapse.contains(e.target)) {
                navbarCollapse.classList.remove('show');
            }
        });
    }
}

/**
 * Initialize live search for all .search-form elements
 */
function initLiveSearch() {
    const searchForms = document.querySelectorAll('form.search-form');
    if (!searchForms.length) {
        return;
    }

    const joinPath = (basePath, path) => {
        if (!basePath) return path;
        return `${basePath.replace(/\/+$/, '')}${path}`;
    };

    const escapeHtml = (value) => String(value ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');

    const getBasePathFromAction = (action) => {
        try {
            const actionPath = new URL(action || '/shop', window.location.origin).pathname.replace(/\/+$/, '');
            const routeAnchors = ['/shop', '/blog'];

            for (const anchor of routeAnchors) {
                const anchorIndex = actionPath.lastIndexOf(anchor);
                if (anchorIndex >= 0) {
                    return actionPath.substring(0, anchorIndex);
                }
            }

            return '';
        } catch (e) {
            return '';
        }
    };

    searchForms.forEach((form) => {
        const input = form.querySelector('input[name="q"]');
        if (!input) {
            return;
        }

        const liveSearchType = form.dataset.liveSearch || 'products';
        const basePath = getBasePathFromAction(form.getAttribute('action') || '/shop');
        const searchEndpoint = liveSearchType === 'blog'
            ? joinPath(basePath, '/blog/search')
            : joinPath(basePath, '/search');
        const shopEndpoint = joinPath(basePath, '/shop');
        const blogEndpoint = joinPath(basePath, '/blog');
        const productEndpoint = joinPath(basePath, '/product');

        const dropdown = document.createElement('div');
        dropdown.className = 'live-search-dropdown';
        form.appendChild(dropdown);

        let debounceTimer;

        const hideDropdown = () => dropdown.classList.remove('show');
        const showDropdown = () => dropdown.classList.add('show');

        const renderSuggestions = (data, query) => {
            const products = Array.isArray(data.products) ? data.products : [];
            const posts = Array.isArray(data.posts) ? data.posts : [];
            const suggestions = Array.isArray(data.suggestions) ? data.suggestions : [];
            let html = '';

            if (liveSearchType === 'products' && suggestions.length > 0) {
                html += '<div class="live-search-section-title">Suggestions</div>';
                suggestions.forEach((suggestion) => {
                    const href = `${shopEndpoint}?q=${encodeURIComponent(suggestion)}`;
                    html += `
                        <a class="live-search-item" href="${href}">
                            <div class="live-search-item-name">${escapeHtml(suggestion)}</div>
                        </a>
                    `;
                });
            }

            if (liveSearchType === 'products' && products.length > 0) {
                html += '<div class="live-search-section-title">Products</div>';
                products.forEach((product) => {
                    const href = `${productEndpoint}/${product.slug}`;
                    const price = Number(product.price || 0).toFixed(2);
                    html += `
                        <a class="live-search-item" href="${href}">
                            <div class="live-search-item-name">${escapeHtml(product.name)}</div>
                            <div class="live-search-item-meta">${escapeHtml(product.category || 'Wigs')} • GH₵${price}</div>
                        </a>
                    `;
                });
            }

            if (liveSearchType === 'blog' && posts.length > 0) {
                html += '<div class="live-search-section-title">Blog Posts</div>';
                posts.forEach((post) => {
                    const href = `${blogEndpoint}/${post.slug}`;
                    html += `
                        <a class="live-search-item" href="${href}">
                            <div class="live-search-item-name">${escapeHtml(post.title)}</div>
                            <div class="live-search-item-meta">${escapeHtml(post.category || 'General')}</div>
                        </a>
                    `;
                });
            }

            if (!html) {
                html = `<div class="live-search-empty">No results for "${escapeHtml(query)}"</div>`;
            }

            dropdown.innerHTML = html;
            showDropdown();
        };

        input.addEventListener('input', () => {
            const query = input.value.trim();

            clearTimeout(debounceTimer);

            if (query.length < 2) {
                hideDropdown();
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`${searchEndpoint}?q=${encodeURIComponent(query)}&limit=6`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                    .then((res) => res.json())
                    .then((data) => renderSuggestions(data, query))
                    .catch(() => hideDropdown());
            }, 250);
        });

        input.addEventListener('focus', () => {
            if (dropdown.innerHTML.trim() !== '') {
                showDropdown();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                hideDropdown();
            }
        });

        document.addEventListener('click', (e) => {
            if (!form.contains(e.target)) {
                hideDropdown();
            }
        });
    });
}

/**
 * Initialize back to top button
 */
function initBackToTop() {
    const backToTopBtn = document.getElementById('backToTopBtn');
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

/**
 * Show notification
 */
function showNotification(message, type = 'info') {
    // Remove existing notifications
    document.querySelectorAll('.notification-toast').forEach(el => el.remove());
    
    const notification = document.createElement('div');
    notification.className = `notification-toast alert alert-${type}`;
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
    `;
    
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        animation: slideIn 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Add animation styles
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    @keyframes bounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }
    .bounce {
        animation: bounce 0.3s ease;
    }
`;
document.head.appendChild(style);

// Lazy load images
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                img.classList.remove('lazy');
                observer.unobserve(img);
            }
        });
    });
    
    document.querySelectorAll('img.lazy').forEach(img => {
        imageObserver.observe(img);
    });
}
