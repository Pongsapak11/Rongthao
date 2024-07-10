<div class="container" style="color: aliceblue;">
    <form method="post" action="<?= base_url(); ?>user/create/submit">
        <h3 class="my-3">เพิ่มผู้ใช้งาน</h3>
        <div class="mb-3">
            <label for="username" class="form-label">ชื่อผู้ใช้งาน</label>
            <input type="text" class="form-control" name="username" id="username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่าน</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อ นามสกุล</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">อีเมล</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="mb-3">
            <label for="phoneNumber" class="form-label">เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" name="phoneNumber" id="phoneNumber">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary mt-3" type="submit">เพิ่มผู้ใช้งาน</button>
            <a class="btn btn-secondary mt-3" href="<?= base_url(); ?>user">กลับไปหน้ารายการ</a>
        </div>
    </form>
</div>