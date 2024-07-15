<div class=" mt-4 ">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 m-0">
        <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="card h-100">
                    <?php if ($product['image'] != '' && file_exists($product['image'])): ?>
                        <img src="<?= $product['image']; ?>" class="card-img-top" alt="รูปภาพ">
                    <?php endif ?>
                    <div class="card-body">
                        <h3 class="card-title"><?= $product['product_name']; ?></h3>
                        <h6 class="card-title">รายละเอียดสินค้า </h6>
                        <p class="card-text"><?= $product['product_detail']; ?></p>
                        <p class="card-text">
                        <h5>ราคา : <?= number_format($product['product_price']); ?> บาท</h5>
                        </p>

                    </div>
                    <a class="btn btn-dark" style="width: 35%; margin-bottom: 30px; margin-left: 60%; "
                        href="<?= base_url('showdetail/' . $product['product_id'] . '/' . $product['category_id']); ?>">รายละเอียดสินค้า</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>