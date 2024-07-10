<div class="container mt-5 ">
    <a href="<?= base_url() . 'product/create'; ?>" class="btn btn-primary my-3">เพิ่มสินค้า</a>
    <table class="table table-hover table-bordered mt-3">
        <thead>
            <tr>
                <th scope="col" class="text-center">ลำดับ</th>
                <th scope="col" width="150">รูปภาพ</th>
                <th scope="col">ชื่อสินค้า</th>
                <th scope="col">หมวดหมู่สินค้า</th>
                <th scope="col" width="80">ราคา</th>
                <th scope="col">รายละเอียด</th>
                <th scope="col" class="text-center" width="60">แก้ไข</th>
                <th scope="col" class="text-center" width="60">ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $index => $row): ?>
                <tr>
                    <th class="text-center" scope="row"><?= ($index + 1); ?></th>
                    <td>
                        <img src="<?= base_url() . $row['image']; ?>" width="100" alt="<?= $row['product_name']; ?>">
                    </td>
                    <td><?= $row['product_name']; ?></td>
                    <td><?= $row['category_id']; ?></td>
                    <td><?= $row['product_price']; ?></td>
                    <td><?= $row['product_detail']; ?></td>
                    <td class="text-center">
                        <a href="<?= base_url() . 'product/update/' . $row['product_id']; ?>"
                            class="btn btn-warning">แก้ไข</a>
                    </td>
                    <td class="text-center">
                        <button action="delete" data-id="<?= $row['product_id']; ?>" class="btn btn-danger">ลบ</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    document.addEventListener('click', function (event) {
        var target = event.target;
        if (target.matches('button[action="delete"]')) {
            event.preventDefault();
            Swal.fire({
                title: "ยืนยันการลบ?",
                text: "ต้องการที่จะลบข้อมูลหรือไม่",
                icon: "question",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = '<?= base_url() . 'product/delete/' ?>' + target.dataset.id;
                }
            });
        }
    });
</script>
</div>