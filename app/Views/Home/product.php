<div class="mt-4">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 m-0">
        <?php
        $count = 0;
        foreach ($products as $product):
            if ($count >= 8) {
                break;
            }
            $count++;
            ?>
            <div class="col">
                <div class="card h-100">
                    <?php if ($product['image'] != '' && file_exists($product['image'])): ?>
                        <img src="<?= $product['image']; ?>" class="card-img-top" alt="รูปภาพ">
                    <?php endif ?>
                    <div class="card-body">
                        <h3 class="card-title"><?= $product['product_name']; ?></h3>
                        <h6 class="card-title">รายละเอียดสินค้า </h6>
                        <p class="card-text"><?= $product['product_detail']; ?></p>
                        <p class="card-text">ราคา : <?= number_format($product['product_price']); ?> บาท</p>
                    </div>
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