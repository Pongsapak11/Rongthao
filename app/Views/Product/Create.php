<div class="container" style="color: aliceblue;">
    <form method="post" action="<?= base_url(); ?>product/create/submit" enctype="multipart/form-data">
        <h3 class="my-3">เพิ่มสินค้า</h3>
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อสินค้า</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">หมวดหมู่</label>
            <select id="category" name="category" required>
                <option disabled selected>กรุณาเลือกหมวดหมู่</option>
                <?php
                foreach ($categories as $category) {
                    echo "<option value='" . htmlspecialchars($category['category_id']) . "'>" . htmlspecialchars($category['category_name']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class=" mb-3">
            <label for="description" class="form-label">รายละเอียดสินค้า</label>
            <textarea class="form-control" name="description" id="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">ราคา</label>
            <input type="number" class="form-control" name="price" id="price" min="0" step="1" value="0">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">อัปโหลดรูปภาพ</label>
            <input class="form-control" type="file" name="image" id="image">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary mt-3" type="submit">เพิ่มสินค้า</button>
            <a class="btn btn-secondary mt-3" href="<?= base_url(); ?>product">กลับไปหน้ารายการ</a>
        </div>
    </form>
</div>