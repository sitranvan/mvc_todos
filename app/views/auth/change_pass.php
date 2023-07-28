<div class="container p-5 shadow-lg rounded-1 bg-white" style="width: 500px; margin-top: 120px;">
    <h1 class="mb-3 text-primary-emphasis">
        Đổi Mật Khẩu
    </h1>
    <?= showMessage($msg, $msg_type) ?>
    <form class="needs-validation" action="submit-doi-mat-khau" method="POST">
        <label for="password" class="form-label fw-semibold mt-2 text-primary-emphasis">
            <i class="fa-solid fa-lock"></i>
            Mật Khẩu Mới
        </label>
        <div class="input-group has-validation ">
            <input name="password" type="password" class="form-control <?= invalid($errors, 'password') ?>" id="password">
            <div class="invalid-feedback">
                <?= $errors['password'] ?? false ?>
            </div>
        </div>
        <label for="confirm_password" class="form-label fw-semibold mt-2 text-primary-emphasis">
            <i class="fa-solid fa-lock"></i>
            Xác Nhận Mật Khẩu Mới
        </label>
        <div class="input-group has-validation ">
            <input name="confirm_password" type="password" class="form-control <?= invalid($errors, 'confirm_password') ?>" id="confirm_password">
            <div class="invalid-feedback">
                <?= $errors['confirm_password'] ?? false ?>
            </div>
        </div>
        <div class="d-grid mt-4">
            <button class="btn btn-primary py-2" type="submit">
                Xác nhận
                <i class="fa-solid fa-arrow-right ms-1"></i>
            </button>
        </div>
    </form>
</div>