<div class="container" style="color: aliceblue;">
    <form method="post" action="<?= base_url(); ?>user/update/submit">
        <input type="hidden" name="id" value="<?= $rowUser['user_id']; ?>">
        <h3 class="my-3">แก้ไขผู้ใช้งาน</h3>
        <div class="mb-3">
            <label for="username" class="form-label">ชื่อผู้ใช้งาน</label>
            <input type="text" class="form-control" name="username" id="username" value="<?= $rowUser['username']; ?>">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อ นามสกุล</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $rowUser['name']; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">อีเมล</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= $rowUser['email']; ?>">
        </div>
        <div class="mb-3">
            <label for="phoneNumber" class="form-label">เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" name="phoneNumber" id="phoneNumber"
                value="<?= $rowUser['phone_number']; ?>">
        </div>

        <div class="mb-3">
            <label for="role">สถานะ :</label>
            <select id="role" name="role" class=" form-control">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-primary mt-3" type="submit">แก้ไขผู้ใช้งาน</button>
            <a class="btn btn-secondary mt-3" href="<?= base_url(); ?>user">กลับไปหน้ารายการ</a>
        </div>
    </form>
</div>