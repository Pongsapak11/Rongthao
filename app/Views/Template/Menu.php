<?php
// ดึงข้อมูลหมวดหมู่จากฐานข้อมูล
$CategoryModel = new \App\Models\CategoryModel();
$categories = $CategoryModel->findAll();
?>

<div class="container-fluid" style="height: 60px;">
    <a class="navbar-brand" href="<?= base_url(); ?>">Rongthao</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menubar"
        aria-controls="menubar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menubar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="height: 40px;">
            <?php
            $current_page = basename($_SERVER['REQUEST_URI'], ".php"); //อันนี้คือทำให้ active อันที่กดเข้าไป
            ?>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'home') ? 'active' : ''; ?>" aria-current="page"
                    href="<?= base_url(); ?>home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page == 'shop') ? 'active' : ''; ?>"
                    href="<?= base_url(); ?>shop">All</a>
            </li>
            <li class="nav">
                <?php foreach ($categories as $category): ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'category/' . $category['category_id']) ? 'active' : ''; ?>"
                        href="<?= base_url('category/' . $category['category_id']); ?>">
                        <?= htmlspecialchars($category['category_name']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
            </li>



            <?php if (session()->get('logged_in')): ?>
                <li class="nav-item" style="margin-left: 950px;">
                    <a class="nav-link <?= ($current_page == 'user') ? 'active' : ''; ?> "
                        href="<?= base_url(); ?>user">จัดการผู้ใช้</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'product') ? 'active' : ''; ?>"
                        href="<?= base_url(); ?>product">จัดการสินค้า</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <?= $loggedUser['name']; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url(); ?>logout">ออกจากระบบ</a></li>
                    </ul>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'login') ? 'active' : ''; ?>" style="justify-content: right;"
                        href="<?= base_url(); ?>login">เข้าสู่ระบบ</a>
                </li>
            <?php endif ?>
        </ul>
    </div>
</div>