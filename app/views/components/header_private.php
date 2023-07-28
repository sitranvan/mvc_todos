<nav class="navbar bg-body shadow-sm fixed-top ">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="trang-chu">
            <img width="45" src="<?= _WEB_ROOT ?>/public/assets/images/brand.png" alt="brand">
            <div class="fw-bold text-uppercase fs-3 ms-3">
                <span class="text-warning">T</span>
                <span class="text-info">V</span>
                <span class="text-primary">S</span>
            </div>
        </a>
        <ul class="m-0 list-unstyled">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="me-2" width="25" src="<?= _WEB_ROOT ?>/public/assets/images/avatar.png" alt="avatar">
                    <?= $username ?? false ?>
                </a>
                <ul class="dropdown-menu shadow-sm border-light-subtle" style="left: -50px; top:38px;">
                    <li><a class="dropdown-item" href="<?= linkRoute('doi-mat-khau') ?>">Đổi mật khẩu</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="<?= linkRoute('dang-xuat') ?>">Đăng xuất</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>