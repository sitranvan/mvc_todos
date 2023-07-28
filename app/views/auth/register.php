<div class="container p-5 shadow-lg rounded-1 bg-white" style="width: 500px; margin-top: 50px;">
    <h1 class="mb-3 text-primary-emphasis">
        Đăng Ký
        <i class="fa-regular fa-plus fs-2"></i>
    </h1>
    <?= showMessage($msg, $msg_type) ?>
    <form class="needs-validation" action="submit-dang-ky" method="POST">
        <label for="username" class="form-label fw-semibold mt-2 text-primary-emphasis">
            <i class="fa-solid fa-user"></i>
            Tên Đăng Nhập
        </label>
        <div class="input-group has-validation">
            <input value="<?= $pre_data['username'] ?? false ?>" name="username" type="text" class="form-control <?= invalid($errors, 'username') ?> " id="username">
            <div class="invalid-feedback">
                <?= $errors['username'] ?? false ?>
            </div>
        </div>
        <label for="email" class="form-label fw-semibold mt-2 text-primary-emphasis">
            <i class="fa-solid fa-envelope"></i>
            Email
        </label>
        <div class="input-group has-validation ">
            <input value="<?= $pre_data['email'] ?? false ?>" name="email" type="text" class="form-control <?= invalid($errors, 'email') ?>" id="email">
            <div class="invalid-feedback">
                <?= $errors['email'] ?? false ?>
            </div>
        </div>
        <label for="password" class="form-label fw-semibold mt-2 text-primary-emphasis">
            <i class="fa-solid fa-lock"></i>
            Mật Khẩu
        </label>
        <div class="input-group has-validation ">
            <input name="password" type="password" class="form-control <?= invalid($errors, 'password') ?>" id="password">
            <div class="invalid-feedback">
                <?= $errors['password'] ?? false ?>
            </div>
        </div>
        <label for="confirm_password" class="form-label fw-semibold mt-2 text-primary-emphasis">
            <i class="fa-solid fa-lock"></i>
            Xác Nhận Mật Khẩu
        </label>
        <div class="input-group has-validation ">
            <input name="confirm_password" type="password" class="form-control <?= invalid($errors, 'confirm_password') ?>" id="confirm_password">
            <div class="invalid-feedback">
                <?= $errors['confirm_password'] ?? false ?>
            </div>
        </div>
        <div class="d-grid mt-4">
            <button class="btn btn-primary py-2" type="submit">
                Đăng Ký
                <i class="fa-solid fa-arrow-right ms-1"></i>
            </button>
        </div>
    </form>
    <p class="mt-4 text-center text-primary-emphasis">Bạn đã có tài khoản?
        <a class="text-decoration-none" href="<?= linkRoute('dang-nhap') ?>"> Đăng nhập ngay
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </p>
</div>