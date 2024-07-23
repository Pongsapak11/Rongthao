<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รถเข็น</title>
    <style>
        .container {
            width: 80%;
            margin: 50px auto;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #474747;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 30px;
            background-color: aliceblue;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: aliceblue;
        }

        .total {
            margin-top: 20px;
            margin-bottom: 50px;
            font-size: 25px;
            color: white;
        }

        .checkout-btn,
        .btn-danger,
        .back-btn {
            margin-top: 10px;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
        }

        .checkout-btn {
            background-color: #4CAF50;
        }

        .btn-danger {
            background-color: red;
            border: 0px;
        }

        .back-btn {
            background-color: blue;
            margin-right: 20px;
        }

        .button_add,
        .button_del {
            margin: 0 7px;
            border: 0px;
            color: #dddddd;
            background-color: black;
            width: 25px;
            height: 30px;
        }

        .button_add:hover,
        .button_del:hover {
            background-color: gray;
            color: white;
        }
    </style>
</head>

<body>

    <!-- contents cart -->
    <div class="container">
        <h2 style="color: #dddddd;">รถเข็นสินค้า</h2>

        <table>
            <thead>
                <tr>
                    <th>สินค้า</th>
                    <th>รูปภาพ</th>
                    <th>ราคา</th>
                    <th>จำนวน</th>
                    <th>รวม</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $item): ?>
                    <tr>
                        <td><b style="font-size: 15px;"><?= htmlspecialchars($item['product_name']) ?></b></td>
                        <td>
                            <?php if (!empty($item['image']) && file_exists($item['image'])): ?>
                                <img src="<?= htmlspecialchars(base_url($item['image'])) ?>" alt="รูปภาพ" width="150px">
                            <?php else: ?>
                                <img src="<?= htmlspecialchars(base_url('uploads/placeholder.png')) ?>" alt="รูปภาพ"
                                    width="150px">
                            <?php endif; ?>
                        </td>
                        <td><?= number_format($item['product_price']) ?> บาท</td>
                        <td>
                            <button type="button" class="button_add"
                                onclick="updateQuantity(<?= $item['product_id'] ?>, 'decrease')">-</button>
                            <?= $item['quantity'] ?>
                            <button type="button" class="button_del"
                                onclick="updateQuantity(<?= $item['product_id'] ?>, 'increase')">+</button>
                        </td>
                        <td><b><u><?= number_format($item['product_price'] * $item['quantity']) ?></u></b> บาท</td>
                        <td>
                            <button type="button" class="btn btn-danger"
                                onclick="removeItem(<?= $item['product_id'] ?>)">ลบ</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="total"><b>ยอดรวมทั้งหมด: <span style="color: red;"><?= number_format($totalPrice) ?></span> บาท</b>
        </p>
        <a href="<?= base_url('/') ?>" class="back-btn">กลับหน้าหลัก</a>
        <a href="<?= base_url('checkout') ?>" class="checkout-btn">ดำเนินการชำระเงิน</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateQuantity(itemId, action) {
            fetch('<?= base_url('cart/update_quantity') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                body: JSON.stringify({ id: itemId, action: action })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        Swal.fire({
                            title: "อัปเดตจำนวนไม่สำเร็จ",
                            text: data.message,
                            icon: "error"
                        });
                    } else {
                        location.reload();
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        text: "ไม่สามารถอัปเดตจำนวนสินค้าได้",
                        icon: "error"
                    });
                });
        }

        function removeItem(itemId) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการลบสินค้านี้ออกจากรถเข็นใช่หรือไม่!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเลย!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('<?= base_url('cart/remove') ?>/' + itemId, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                        },
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                Swal.fire({
                                    title: "ลบสินค้าไม่สำเร็จ",
                                    text: data.message,
                                    icon: "error"
                                });
                            } else {
                                Swal.fire({
                                    title: "ลบสินค้าสำเร็จ!",
                                    text: data.message,
                                    icon: "success"
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: "เกิดข้อผิดพลาด",
                                text: "ไม่สามารถลบสินค้าได้",
                                icon: "error"
                            });
                        });
                }
            });
        }
    </script>
</body>

</html>