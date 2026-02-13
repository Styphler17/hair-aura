<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1><?= $currentCategory ? htmlspecialchars($currentCategory['name']) : 'Shop All Products' ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url('/') ?>">Home</a></li>
                <li class="breadcrumb-item active">Shop</li>
                <?php if ($currentCategory): ?>
                <li class="breadcrumb-item active"><?= htmlspecialchars($currentCategory['name']) ?></li>
                <?php endif; ?>
            </ol>
        </nav>
    </div>
</section>

<!-- Shop Section -->
<section class="shop-section py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3">
                <?php $filterAction = $currentCategory ? '/shop/' . $currentCategory['slug'] : '/shop'; ?>
                <div class="shop-sidebar">
                    <!-- Search -->
                    <div class="sidebar-widget">
                        <h4>Search</h4>
                        <form action="<?= url('/shop') ?>" method="get" class="search-form" data-live-search="products">
                            <input type="text" name="q" class="form-control" placeholder="Search products..." 
                                   value="<?= htmlspecialchars($query) ?>">
                            <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    
                    <!-- Categories -->
                    <div class="sidebar-widget">
                        <h4>Categories</h4>
                        <ul class="category-list">
                            <li>
                                <a href="<?= url('/shop') ?>" class="<?= !$currentCategory ? 'active' : '' ?>">
                                    All Products
                                    <span class="count">(<?= array_sum(array_column($categories, 'product_count')) ?>)</span>
                                </a>
                            </li>
                            <?php foreach ($categories as $cat): ?>
                            <li>
                                <a href="<?= url('/shop/' . (string) $cat['slug']) ?>" 
                                   class="<?= $currentCategory && $currentCategory['id'] == $cat['id'] ? 'active' : '' ?>">
                                    <?= htmlspecialchars($cat['name']) ?>
                                    <span class="count">(<?= $cat['product_count'] ?>)</span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <form action="<?= url($filterAction) ?>" method="get" class="shop-filter-form">
                        <input type="hidden" name="q" value="<?= htmlspecialchars((string) $query) ?>">
                        <input type="hidden" name="sort" value="<?= htmlspecialchars((string) ($filters['sort'] ?? 'newest')) ?>">

                        <!-- Price Filter -->
                        <div class="sidebar-widget">
                            <h4>Price Range</h4>
                            <div class="input-group">
                                <input type="number" name="min_price" class="form-control" placeholder="Min" value="<?= htmlspecialchars((string) ($filters['min_price'] ?? '')) ?>">
                                <span class="input-group-text">-</span>
                                <input type="number" name="max_price" class="form-control" placeholder="Max" value="<?= htmlspecialchars((string) ($filters['max_price'] ?? '')) ?>">
                            </div>
                        </div>

                        <!-- Hair Type -->
                        <div class="sidebar-widget">
                            <h4>Hair Type</h4>
                            <div class="filter-options">
                                <?php foreach (['human_hair' => 'Human Hair', 'synthetic' => 'Synthetic', 'blend' => 'Blend'] as $hairTypeValue => $hairTypeLabel): ?>
                                <label class="filter-checkbox">
                                    <input type="radio" name="hair_type" value="<?= $hairTypeValue ?>" <?= ($filters['hair_type'] ?? '') === $hairTypeValue ? 'checked' : '' ?>>
                                    <span><?= $hairTypeLabel ?></span>
                                </label>
                                <?php endforeach; ?>
                                <label class="filter-checkbox">
                                    <input type="radio" name="hair_type" value="" <?= empty($filters['hair_type']) ? 'checked' : '' ?>>
                                    <span>Any</span>
                                </label>
                            </div>
                        </div>

                        <?php if (!empty($availableFilters['colors'])): ?>
                        <div class="sidebar-widget">
                            <h4>Color</h4>
                            <div class="filter-options">
                                <?php foreach ($availableFilters['colors'] as $color): ?>
                                <label class="filter-checkbox">
                                    <input type="radio" name="color" value="<?= htmlspecialchars($color) ?>" <?= ($filters['color'] ?? '') == $color ? 'checked' : '' ?>>
                                    <span><?= htmlspecialchars($color) ?></span>
                                </label>
                                <?php endforeach; ?>
                                <label class="filter-checkbox">
                                    <input type="radio" name="color" value="" <?= empty($filters['color']) ? 'checked' : '' ?>>
                                    <span>Any</span>
                                </label>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($availableFilters['lengths'])): ?>
                        <div class="sidebar-widget">
                            <h4>Length</h4>
                            <div class="filter-options">
                                <?php foreach ($availableFilters['lengths'] as $length): ?>
                                <label class="filter-checkbox">
                                    <input type="radio" name="length" value="<?= (int) $length ?>" <?= (string) ($filters['length'] ?? '') === (string) $length ? 'checked' : '' ?>>
                                    <span><?= (int) $length ?>"</span>
                                </label>
                                <?php endforeach; ?>
                                <label class="filter-checkbox">
                                    <input type="radio" name="length" value="" <?= empty($filters['length']) ? 'checked' : '' ?>>
                                    <span>Any</span>
                                </label>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="sidebar-widget d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                            <a href="<?= url($filterAction) ?>" class="btn btn-outline-primary btn-sm">Clear</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Product Grid -->
            <div class="col-lg-9">
                <!-- Toolbar -->
                <div class="shop-toolbar">
                    <div class="toolbar-left">
                        <span class="results-info">Showing <?= count($products) ?> of <?= $pagination['total'] ?> products</span>
                    </div>
                    <div class="toolbar-right">
                        <select name="sort" class="form-select" id="sortSelect" onchange="window.location.href=this.value">
                            <?php 
                            $baseRoute = $currentCategory ? '/shop/' . $currentCategory['slug'] : '/shop';
                            $baseUrl = url($baseRoute);
                            $queryStr = $query ? '&q=' . urlencode($query) : '';
                            ?>
                            <option value="<?= $baseUrl ?>?sort=newest<?= $queryStr ?>">Sort by: Newest</option>
                            <option value="<?= $baseUrl ?>?sort=price_low<?= $queryStr ?>" <?= $filters['sort'] == 'price_low' ? 'selected' : '' ?>>Price: Low to High</option>
                            <option value="<?= $baseUrl ?>?sort=price_high<?= $queryStr ?>" <?= $filters['sort'] == 'price_high' ? 'selected' : '' ?>>Price: High to Low</option>
                            <option value="<?= $baseUrl ?>?sort=rating<?= $queryStr ?>" <?= $filters['sort'] == 'rating' ? 'selected' : '' ?>>Highest Rated</option>
                            <option value="<?= $baseUrl ?>?sort=name<?= $queryStr ?>" <?= $filters['sort'] == 'name' ? 'selected' : '' ?>>Name: A-Z</option>
                        </select>
                        
                        <div class="view-modes">
                            <button class="btn active" data-view="grid"><i class="fas fa-th"></i></button>
                            <button class="btn" data-view="list"><i class="fas fa-list"></i></button>
                        </div>
                    </div>
                </div>
                
                <!-- Products Grid -->
                <div class="row product-grid">
                    <?php if (empty($products)): ?>
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4>No products found</h4>
                        <p>Try adjusting your filters or search query</p>
                        <a href="<?= url('/shop') ?>" class="btn btn-primary">View All Products</a>
                    </div>
                    <?php else: ?>
                    <?php foreach ($products as $product): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="product-card">
                            <div class="product-image">
                                <a href="<?= url('/product/' . (string) $product['slug']) ?>">
                                    <img src="<?= $product['primary_image'] ? asset('/uploads/products/' . $product['primary_image']) : asset('/img/product-placeholder.png') ?>" 
                                         alt="<?= htmlspecialchars($product['name']) ?>" 
                                         loading="lazy">
                                </a>
                                
                                <?php if ($product['sale_price'] && $product['sale_price'] < $product['price']): ?>
                                <span class="product-badge sale">-<?= round((($product['price'] - $product['sale_price']) / $product['price']) * 100) ?>%</span>
                                <?php elseif ($product['new_arrival']): ?>
                                <span class="product-badge new">New</span>
                                <?php endif; ?>
                                
                                <div class="product-actions">
                                    <button class="btn btn-wishlist" data-product-id="<?= $product['id'] ?>">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button class="btn btn-quickview" data-product-id="<?= $product['id'] ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="product-info">
                                <span class="product-category"><?= htmlspecialchars($product['category_name'] ?? 'Wigs') ?></span>
                                <h3 class="product-title">
                                    <a href="<?= url('/product/' . (string) $product['slug']) ?>">
                                        <?= htmlspecialchars($product['name']) ?>
                                    </a>
                                </h3>
                                <div class="product-rating">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star<?= $i > ($product['rating_avg'] ?? 0) ? '-empty' : '' ?>"></i>
                                    <?php endfor; ?>
                                    <span>(<?= $product['review_count'] ?? 0 ?>)</span>
                                </div>
                                <div class="product-price">
                                    <?php if ($product['sale_price'] && $product['sale_price'] < $product['price']): ?>
                                        <span class="old-price"><?= money($product['price']) ?></span>
                                        <span class="current-price"><?= money($product['sale_price']) ?></span>
                                    <?php else: ?>
                                        <span class="current-price"><?= money($product['price']) ?></span>
                                    <?php endif; ?>
                                </div>
                                <button class="btn btn-primary btn-add-cart" data-product-id="<?= $product['id'] ?>">
                                    <i class="fas fa-shopping-bag"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <!-- Pagination -->
                <?php if ($pagination['last_page'] > 1): ?>
                <nav class="pagination-nav">
                    <ul class="pagination justify-content-center">
                        <?php if ($pagination['current_page'] > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $pagination['current_page'] - 1 ?>">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $pagination['last_page']; $i++): ?>
                        <li class="page-item <?= $i == $pagination['current_page'] ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                        <?php endfor; ?>
                        
                        <?php if ($pagination['current_page'] < $pagination['last_page']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $pagination['current_page'] + 1 ?>">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
