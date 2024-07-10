<div
    style="width: 750px; height: 400px; background-color: rgba(240, 248, 255, 0.8); margin: auto; border-radius: 70px;">
    <div style="color: black; margin-top: 150px;">
        <form class="row my-5" method="post" action="<?= base_url() ?>login/check">
            <div class="col col-12 col-md-10 col-lg-4 m-auto">
                <h3 class="mb-3" style="text-align: center; margin-top: 50px;"><b>เข้าสู่ระบบ</b></h3>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">เข้าสู่ระบบ</button>
                </div>
            </div>
        </form>
    </div>
</div>