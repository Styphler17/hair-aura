<section class="py-5">
    <div class="container">
        <h1 class="mb-4">My Account</h1>
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card"><div class="card-body"><strong>Orders</strong><div><?= (int) ($orderCount ?? 0) ?></div></div></div>
            </div>
            <div class="col-md-4">
                <div class="card"><div class="card-body"><strong>Total Spent</strong><div><?= money((float) ($totalSpent ?? 0)) ?></div></div></div>
            </div>
            <div class="col-md-4">
                <div class="card"><div class="card-body"><strong>Wishlist Items</strong><div><?= count($wishlist ?? []) ?></div></div></div>
            </div>
        </div>
        <a class="btn btn-outline-primary me-2" href="<?= url('/account/orders') ?>">View Orders</a>
        <a class="btn btn-outline-primary me-2" href="<?= url('/account/wishlist') ?>">Wishlist</a>
        <a class="btn btn-outline-primary" href="<?= url('/account/profile') ?>">Profile</a>
    </div>
</section>
