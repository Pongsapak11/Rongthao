<div class="mt-4">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 m-0">
        <?php
        $count = 0;
        foreach ($products as $product_cards):
            if ($count >= 8) {
                break;
            }
            $count++;
            ?>
            <div class="col">
                <div class="card h-100">
                    <?php if ($product_cards['image'] != '' && file_exists($product_cards['image'])): ?>
                        <img src="<?= $product_cards['image']; ?>" class="card-img-top" alt="รูปภาพ">
                    <?php endif ?>
                    <div class="card-body">
                        <h3 class="card-title"><?= $product_cards['product_name']; ?></h3>
                        <h6 class="card-title">รายละเอียดสินค้า </h6>
                        <p class="card-text"><?= $product_cards['product_detail']; ?></p>
                        <p class="card-text">
                        <h5>ราคา : <?= number_format($product_cards['product_price']); ?> บาท</h5>
                        </p>
                    </div>
                    <a class="btn btn-dark" style="width: 35%; margin-bottom: 30px; margin-left: 60%; "
                        href="<?= base_url('showdetail/' . $product_cards['product_id'] . '/' . $product_cards['category_id']); ?>">รายละเอียดสินค้า</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <?php if (count($products) > 8): ?>
        <div class="text-center mt-5">
            <a href="<?= base_url(); ?>shop" class="btn"
                style="background-color: rgba(0, 0, 0, 0.2) ; color: white; font-size: x-large;">แสดงสินค้าทั้งหมด</a>
        </div>
    <?php endif; ?>
</div>