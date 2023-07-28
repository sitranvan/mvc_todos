<section class="d-flex flex-column align-items-center w-100 justify-content-center" style="margin-top: 100px;">
    <h2 class="text-uppercase fw-bold d-flex align-items-center justify-content-center gap-2">
        <span class="text-info">Thêm Công Việc</span>
        <img width="55" src="<?= _WEB_ROOT ?>/public/assets/images/todo.png" alt="add">
    </h2>

    <form action="<?= linkRoute('submit-them-cong-viec') ?>" style="width: 500px" method="post">
        <div class="">
            <label for="" class="form-label mt-2 d-flex align-items-center gap-2 fw-semibold text-primary-emphasis">Tiêu đề
                <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/title.png" alt="title">
            </label>
            <div class="input-group">
                <input value="<?= $pre_data['title'] ?? false ?>" name=" title" type="text" class="form-control <?= invalid($errors, 'title') ?>" placeholder="Tiêu đề...">
                <div class="invalid-feedback">
                    <?= $errors['title'] ?? false ?>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <label for="" class="form-label mt-2 d-flex align-items-center gap-2 fw-semibold text-primary-emphasis">Ngày hết hạn
                <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/date.png" alt="date">
            </label>
            <input value="<?= $pre_data['due_date'] ?? false ?>" name="due_date" class="form-control <?= invalid($errors, 'due_date') ?>" type="date">
            <div class="invalid-feedback">
                <?= $errors['due_date'] ?? false ?>
            </div>
        </div>
        <div class="mt-2">
            <label for="" class="form-label mt-2 d-flex align-items-center gap-2 fw-semibold text-primary-emphasis">Mô tả
                <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/description.png" alt="desc">
            </label>
            <div class="input-group">
                <textarea name="description" class="form-control <?= invalid($errors, 'description') ?> " id="" cols="30" rows="5" placeholder="Mô tả chi tiết..."><?= $pre_data['description'] ?? false ?></textarea>
                <div class="invalid-feedback">
                    <?= $errors['description'] ?? false ?>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center  mt-4 justify-content-between gap-4">
            <button class="btn btn-primary py-2 w-50">Thêm Công Việc</button>
            <a class="btn  btn-success py-2 w-50" href="<?= linkRoute('danh-sach') ?>">Quay lại</a>
        </div>
    </form>
</section>