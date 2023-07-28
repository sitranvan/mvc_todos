<div class="container p-5 shadow-lg rounded-1 bg-white" style="width: 500px; margin-top: 80px;">
    <h1 class="mb-3 text-primary-emphasis">
        Đăng Nhập
        <i class="fa-solid fa-location-arrow fs-2"></i>
    </h1>
    <?= isset($msg) ? showMessage($msg,  $msg_type) : showMessage(Session::flash('msg'),  Session::flash('msg_type')) ?>
    <form class="needs-validation" action="submit-dang-nhap" method="POST">
        <label for="email" class="form-label mt-2 fw-semibold text-primary-emphasis">
            <i class="fa-solid fa-envelope"></i>
            Email
        </label>
        <div class="input-group has-validation ">
            <input value="<?= $pre_data['email'] ?? false ?>" name="email" type="text" class="form-control <?= invalid($errors, 'email') ?>" id="email">
            <div class="invalid-feedback">
                <?= $errors['email'] ?? false ?>
            </div>
        </div>
        <label for="password" class="form-label mt-2 fw-semibold text-primary-emphasis">
            <i class="fa-solid fa-lock"></i>
            Mật Khẩu
        </label>
        <div class="input-group has-validation ">
            <input name="password" type="password" class="form-control <?= invalid($errors, 'password') ?>" id="password">
            <div class="invalid-feedback">
                <?= $errors['password'] ?? false ?>
            </div>
        </div>
        <div class="text-end mt-4">
            <a class="text-decoration-none" href="<?= linkRoute('quen-mat-khau') ?>">
                <i class="fa-solid fa-key"></i>
                Quên mật khẩu
            </a>
        </div>
        <div class="d-grid mt-4">
            <button class="btn btn-primary py-2" type="submit">
                Đăng Nhập
                <i class="fa-solid fa-arrow-right-to-bracket ms-1"></i>
            </button>
        </div>
    </form>
    <p class="mt-4 text-center text-primary-emphasis">Bạn chưa có tài khoản?
        <a class="text-decoration-none" href="<?= linkRoute('dang-ky') ?>"> Đăng ký ngay
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </p>
</div>