<div class="container p-5 shadow-lg rounded-1 bg-white" style="width: 500px; margin-top: 80px;">
    <h1 class="mb-3 text-primary-emphasis">
        Quên Mật Khẩu
        <i class="fa-regular fa-share-from-square fs-2"></i>
    </h1>
    <?= isset($msg) ? showMessage($msg,  $msg_type) : showMessage(Session::flash('msg'),  Session::flash('msg_type')) ?>
    <form class="needs-validation" action="submit-quen-mat-khau" method="POST">
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
        <div class="d-grid mt-4">
            <button class="btn btn-primary py-2" type="submit">
                Gửi yêu cầu
                <i class="fa-solid fa-arrow-right-to-bracket ms-1"></i>
            </button>
        </div>
    </form>
    <p class="mt-4 text-center text-primary-emphasis">Đăng nhập bằng tài khoản khác?
        <a class="text-decoration-none" href="<?= linkRoute('dang-nhap') ?>"> Đăng nhập
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </p>
</div>