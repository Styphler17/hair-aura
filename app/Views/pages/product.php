<!-- Product Detail -->
<section class="product-detail-section py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/shop">Shop</a></li>
                <?php if ($category): ?>
                <li class="breadcrumb-item"><a href="/shop/<?= htmlspecialchars($category['slug']) ?>"><?= htmlspecialchars($category['name']) ?></a></li>
                <?php endif; ?>
                <li class="breadcrumb-item active"><?= htmlspecialchars($product->name) ?></li>
            </ol>
        </nav>
        
        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-6">
                <div class="product-images">
                    <div class="main-image">
                        <img src="<?= $product->getPrimaryImage() ?>" alt="<?= htmlspecialchars($product->name) ?>" id="mainImage">
                        <?php if ($product->isOnSale()): ?>
                        <span class="product-badge sale">-<?= $product->getDiscountPercent() ?>%</span>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (count($images) > 1): ?>
                    <div class="thumbnail-images">
                        <?php foreach ($images as $image): ?>
                        <div class="thumbnail <?= $image['is_primary'] ? 'active' : '' ?>" 
                             data-image="/uploads/products/<?= htmlspecialchars($image['image_path']) ?>">
                            <img src="/uploads/products/<?= htmlspecialchars($image['image_path']) ?>" 
                                 alt="<?= htmlspecialchars($image['alt_text'] ?? $product->name) ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="product-info">
                    <span class="product-category"><?= htmlspecialchars($category['name'] ?? 'Wigs') ?></span>
                    <h1 class="product-title"><?= htmlspecialchars($product->name) ?></h1>
                    
                    <div class="product-rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star<?= $i > $product->rating_avg ? '-empty' : '' ?>"></i>
                        <?php endfor; ?>
                        <span class="rating-count"><?= $product->review_count ?> reviews</span>
                    </div>
                    
                    <div class="product-price">
                        <?php if ($product->isOnSale()): ?>
                            <span class="old-price"><?= money($product->price) ?></span>
                            <span class="current-price"><?= money($product->getCurrentPrice()) ?></span>
                            <span class="save-badge">Save <?= money($product->price - $product->sale_price) ?></span>
                        <?php else: ?>
                            <span class="current-price"><?= money($product->price) ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="product-short-desc">
                        <?= $product->short_description ?>
                    </div>
                    
                    <!-- Stock Status -->
                    <div class="stock-status <?= $product->isInStock() ? 'in-stock' : 'out-of-stock' ?>">
                        <i class="fas fa-check-circle"></i>
                        <?= $product->getStockLabel() ?>
                    </div>
                    
                    <!-- Add to Cart Form -->
                    <form class="add-to-cart-form" id="addToCartForm">
                        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                        <input type="hidden" name="product_id" value="<?= $product->id ?>">
                        
                        <?php if (!empty($variants)): ?>
                        <div class="variant-select">
                            <label>Select Variant:</label>
                            <select name="variant_id" class="form-select">
                                <?php foreach ($variants as $variant): ?>
                                <option value="<?= $variant['id'] ?>">
                                    <?= htmlspecialchars($variant['variant_name']) ?>: <?= htmlspecialchars($variant['variant_value']) ?>
                                    <?php if ($variant['price_adjustment'] > 0): ?> (+<?= money($variant['price_adjustment']) ?>)<?php endif; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php endif; ?>
                        
                        <div class="quantity-add">
                            <div class="quantity-selector">
                                <button type="button" class="btn btn-minus">-</button>
                                <input type="number" name="quantity" value="1" min="1" max="<?= $product->stock_quantity ?>" class="form-control">
                                <button type="button" class="btn btn-plus">+</button>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg btn-add-cart" 
                                    <?= !$product->isInStock() ? 'disabled' : '' ?>>
                                <i class="fas fa-shopping-bag"></i>
                                <?= $product->isInStock() ? 'Add to Cart' : 'Out of Stock' ?>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Wishlist & Compare -->
                    <div class="product-actions">
                        <button class="btn btn-wishlist <?= $inWishlist ? 'active' : '' ?>" data-product-id="<?= $product->id ?>">
                            <i class="<?= $inWishlist ? 'fas' : 'far' ?> fa-heart"></i>
                            <?= $inWishlist ? 'In Wishlist' : 'Add to Wishlist' ?>
                        </button>
                        <a href="#" class="btn btn-share" data-bs-toggle="modal" data-bs-target="#shareModal">
                            <i class="fas fa-share-alt"></i> Share
                        </a>
                    </div>
                    
                    <!-- Product Meta -->
                    <div class="product-meta">
                        <div class="meta-item">
                            <span class="meta-label">SKU:</span>
                            <span class="meta-value"><?= htmlspecialchars($product->sku) ?></span>
                        </div>
                        <?php if ($product->hair_type): ?>
                        <div class="meta-item">
                            <span class="meta-label">Hair Type:</span>
                            <span class="meta-value"><?= ucwords(str_replace('_', ' ', $product->hair_type)) ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if ($product->texture): ?>
                        <div class="meta-item">
                            <span class="meta-label">Texture:</span>
                            <span class="meta-value"><?= ucwords(str_replace('_', ' ', $product->texture)) ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if ($product->length_inches): ?>
                        <div class="meta-item">
                            <span class="meta-label">Length:</span>
                            <span class="meta-value"><?= $product->length_inches ?>"</span>
                        </div>
                        <?php endif; ?>
                        <?php if ($product->color): ?>
                        <div class="meta-item">
                            <span class="meta-label">Color:</span>
                            <span class="meta-value"><?= htmlspecialchars($product->color) ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Product Tabs -->
        <div class="product-tabs mt-5">
            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#description">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#details">Additional Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#reviews">
                        Reviews (<?= $product->review_count ?>)
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#shipping">Shipping & Returns</a>
                </li>
            </ul>
            
            <div class="tab-content">
                <!-- Description -->
                <div class="tab-pane fade show active" id="description">
                    <div class="product-description">
                        <?= $product->description ?>
                    </div>
                </div>
                
                <!-- Additional Details -->
                <div class="tab-pane fade" id="details">
                    <table class="table product-details-table">
                        <tbody>
                            <?php if ($product->brand): ?>
                            <tr><th>Brand</th><td><?= htmlspecialchars($product->brand) ?></td></tr>
                            <?php endif; ?>
                            <?php if ($product->hair_type): ?>
                            <tr><th>Hair Type</th><td><?= ucwords(str_replace('_', ' ', $product->hair_type)) ?></td></tr>
                            <?php endif; ?>
                            <?php if ($product->texture): ?>
                            <tr><th>Texture</th><td><?= ucwords(str_replace('_', ' ', $product->texture)) ?></td></tr>
                            <?php endif; ?>
                            <?php if ($product->length_inches): ?>
                            <tr><th>Length</th><td><?= $product->length_inches ?> inches</td></tr>
                            <?php endif; ?>
                            <?php if ($product->weight_grams): ?>
                            <tr><th>Weight</th><td><?= $product->weight_grams ?>g</td></tr>
                            <?php endif; ?>
                            <?php if ($product->cap_size): ?>
                            <tr><th>Cap Size</th><td><?= htmlspecialchars($product->cap_size) ?></td></tr>
                            <?php endif; ?>
                            <?php if ($product->lace_type): ?>
                            <tr><th>Lace Type</th><td><?= htmlspecialchars($product->lace_type) ?></td></tr>
                            <?php endif; ?>
                            <?php if ($product->density): ?>
                            <tr><th>Density</th><td><?= htmlspecialchars($product->density) ?></td></tr>
                            <?php endif; ?>
                            <?php if ($product->color): ?>
                            <tr><th>Color</th><td><?= htmlspecialchars($product->color) ?></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Reviews -->
                <div class="tab-pane fade" id="reviews">
                    <div class="reviews-section">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="rating-summary">
                                    <div class="average-rating">
                                        <span class="rating-number"><?= number_format($product->rating_avg, 1) ?></span>
                                        <div class="rating-stars">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star<?= $i > $product->rating_avg ? '-empty' : '' ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="total-reviews">Based on <?= $product->review_count ?> reviews</span>
                                    </div>
                                    
                                    <div class="rating-bars">
                                        <?php foreach (array_reverse($ratingDistribution, true) as $star => $data): ?>
                                        <div class="rating-bar">
                                            <span class="star-label"><?= $star ?> star</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: <?= $data['percentage'] ?>"></div>
                                            </div>
                                            <span class="count"><?= $data['count'] ?></span>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-8">
                                <?php if ($canReview): ?>
                                <div class="write-review">
                                    <h4>Write a Review</h4>
                                    <form action="/product/<?= $product->id ?>/review" method="post">
                                        <input type="hidden" name="csrf_token" value="<?= \App\Core\Auth::csrfToken() ?>">
                                        <input type="hidden" name="slug" value="<?= $product->slug ?>">
                                        
                                        <div class="mb-3">
                                            <label>Your Rating</label>
                                            <div class="star-rating-input">
                                                <?php for ($i = 5; $i >= 1; $i--): ?>
                                                <input type="radio" name="rating" value="<?= $i ?>" id="star<?= $i ?>" required>
                                                <label for="star<?= $i ?>"><i class="fas fa-star"></i></label>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="reviewTitle">Review Title</label>
                                            <input type="text" name="title" id="reviewTitle" class="form-control" placeholder="Summarize your experience">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="reviewComment">Your Review</label>
                                            <textarea name="comment" id="reviewComment" class="form-control" rows="4" required 
                                                      placeholder="Tell us what you liked or didn't like"></textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Submit Review</button>
                                    </form>
                                </div>
                                <?php endif; ?>
                                
                                <div class="reviews-list">
                                    <?php if (empty($reviews)): ?>
                                    <p class="text-muted">No reviews yet. Be the first to review!</p>
                                    <?php else: ?>
                                    <?php foreach ($reviews as $review): ?>
                                    <div class="review-item">
                                        <div class="review-header">
                                            <div class="reviewer-info">
                                                <div class="reviewer-avatar">
                                                    <?= strtoupper(substr($review['first_name'] ?? 'A', 0, 1)) ?>
                                                </div>
                                                <div>
                                                    <h5><?= htmlspecialchars(($review['first_name'] ?? 'Anonymous') . ' ' . substr($review['last_name'] ?? '', 0, 1) . '.') ?></h5>
                                                    <?php if ($review['is_verified_purchase']): ?>
                                                    <span class="verified-badge"><i class="fas fa-check-circle"></i> Verified Purchase</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <span class="review-date"><?= date('M d, Y', strtotime($review['created_at'])) ?></span>
                                        </div>
                                        <div class="review-rating">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star<?= $i > $review['rating'] ? '-empty' : '' ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <?php if ($review['title']): ?>
                                        <h4 class="review-title"><?= htmlspecialchars($review['title']) ?></h4>
                                        <?php endif; ?>
                                        <p class="review-text"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Shipping -->
                <div class="tab-pane fade" id="shipping">
                    <div class="shipping-info">
                        <h4>Shipping Information</h4>
                        <ul>
                            <li><i class="fas fa-check"></i> Free shipping on orders over GH₵100</li>
                            <li><i class="fas fa-check"></i> Same-day delivery in Accra</li>
                            <li><i class="fas fa-check"></i> 1-3 day delivery to other regions in Ghana</li>
                        </ul>
                        
                        <h4 class="mt-4">Order Support Policy</h4>
                        <ul>
                            <li><i class="fas fa-check"></i> Returns and exchanges are not accepted</li>
                            <li><i class="fas fa-check"></i> Contact support for wrong, damaged, or missing items</li>
                            <li><i class="fas fa-check"></i> Share your order number for faster support</li>
                            <li><i class="fas fa-check"></i> Support responds within business hours in Ghana</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Related Products -->
        <?php if (!empty($relatedProducts)): ?>
        <div class="related-products mt-5">
            <h3 class="section-title">You May Also Like</h3>
            <div class="row">
                <?php foreach ($relatedProducts as $related): ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="product-card">
                        <div class="product-image">
                            <a href="/product/<?= htmlspecialchars($related['slug']) ?>">
                                <img src="<?= $related['primary_image'] ? '/uploads/products/' . htmlspecialchars($related['primary_image']) : '/img/product-placeholder.png' ?>" 
                                     alt="<?= htmlspecialchars($related['name']) ?>" loading="lazy">
                            </a>
                        </div>
                        <div class="product-info">
                            <h4 class="product-title">
                                <a href="/product/<?= htmlspecialchars($related['slug']) ?>">
                                    <?= htmlspecialchars($related['name']) ?>
                                </a>
                            </h4>
                            <div class="product-price">
                                <span class="current-price"><?= money($related['sale_price'] ?: $related['price']) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Share Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="share-buttons">
                    <a href="https://facebook.com/sharer/sharer.php?u=<?= urlencode('https://hair-aura.debesties.com/product/' . $product->slug) ?>" 
                       target="_blank" class="btn btn-facebook">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?= urlencode('https://hair-aura.debesties.com/product/' . $product->slug) ?>&text=<?= urlencode($product->name) ?>" 
                       target="_blank" class="btn btn-twitter">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                    <a href="https://wa.me/233508007873?text=<?= urlencode($product->name . ' - https://hair-aura.debesties.com/product/' . $product->slug) ?>" 
                       target="_blank" class="btn btn-whatsapp">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
                <div class="share-link mt-3">
                    <label>Or copy link:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" value="https://hair-aura.debesties.com/product/<?= $product->slug ?>" readonly>
                        <button class="btn btn-outline-secondary" type="button" onclick="navigator.clipboard.writeText(this.previousElementSibling.value)">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
