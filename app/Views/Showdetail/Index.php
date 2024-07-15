<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        .container {
            width: 80%;
            height: 500px;
            margin: 80px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
        }

        .product-name {
            margin-bottom: 10px;
        }

        .title_detail {
            margin-top: 20px;
            font-size: 23px;
        }

        .product-detail {
            margin-top: 10px;
            margin-bottom: 50px;
            font-size: 20px;
        }

        .product-image {
            float: left;
            margin-right: 100px;
            margin-left: 40px;
            margin-bottom: 10px;
        }

        .category {
            font-style: italic;
            margin-top: 13px;
            margin-bottom: 40px;
            font-size: 18px;
        }

        .price {
            font-weight: bold;
            color: red;
            font-size: 25px;
        }

        .cart {
            float: right;
            margin-right: 50px;
            font-size: 19px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $item): ?>
                <div class="product">
                    <div class="product-image">
                        <?php if (!empty($item['image']) && file_exists($item['image'])): ?>
                            <img src="<?= base_url($item['image']); ?>" alt="รูปภาพ" width="550px">
                        <?php endif ?>
                    </div>
                    <div class="product-info" style="margin-top: 60px;">
                        <h1 class="product-name"><?= $item['product_name'] ?></h1>
                        <?php if (!empty($categorys)): ?>
                            <?php foreach ($categorys as $category): ?>
                                <p class="category">หมวดหมู่ : <b><?= $category['category_name'] ?></b></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>ไม่พบหมวดหมู่</p>
                        <?php endif; ?>
                        <b class="title_detail">รายละเอียดสินค้า </b>
                        <p class="product-detail"><?= $item['product_detail'] ?></p>
                        <p class="price">ราคา: <?= number_format($item['product_price']) ?> บาท
                            <a href="" class="btn btn-success cart">เพิ่มลงรถเข็น</a>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>ไม่พบสินค้า</p>
        <?php endif; ?>
    </div>
</body>

</html>