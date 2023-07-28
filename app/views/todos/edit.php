<section class="d-flex flex-column align-items-center w-100 justify-content-center" style="margin-top: 100px;">
    <h2 class="text-uppercase fw-bold d-flex align-items-center justify-content-center gap-3">
        <span class="text-warning">Sửa Công Việc</span>
        <img width="40" src="<?= _WEB_ROOT ?>/public/assets/images/edit-todos.png" alt="edit">
    </h2>
    <form action="<?= linkRoute('submit-sua-cong-viec') ?>" style="width: 500px" method="post">
        <div class="">
            <label for="" class="form-label mt-2 d-flex align-items-center gap-2 fw-semibold text-primary-emphasis">Tiêu đề
                <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/title.png" alt="title">
            </label>
            <div class="input-group">
                <input value="<?= getValueEdit($pre_data, $dataEdit)['title'] ?>" name="title" type="text" class="form-control <?= invalid($errors, 'title') ?>" placeholder="Tiêu đề...">
                <div class="invalid-feedback">
                    <?= $errors['title'] ?? false ?>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <label for="" class="form-label mt-2 d-flex align-items-center gap-2 fw-semibold text-primary-emphasis">Ngày hết hạn
                <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/date.png" alt="date">
            </label>
            <input value="<?= getDueDate(getValueEdit($pre_data, $dataEdit)['due_date']) ?>" name="due_date" class="form-control <?= invalid($errors, 'due_date') ?>" type="date">
            <div class="invalid-feedback">
                <?= $errors['due_date'] ?? false ?>
            </div>
        </div>
        <div class="mt-2">
            <label for="" class="form-label mt-2 d-flex align-items-center gap-2 fw-semibold text-primary-emphasis ">Mô tả
                <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/description.png" alt="description">
            </label>
            <div class="input-group">
                <textarea class="form-control <?= invalid($errors, 'description') ?>" name="description" id="" cols="30" rows="5" placeholder="Mô tả chi tiết..."><?= getValueEdit($pre_data, $dataEdit)['description'] ?>"</textarea>
                <div class="invalid-feedback">
                    <?= $errors['description'] ?? false ?>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <label for="" class="form-label mt-2 d-flex align-items-center gap-2 fw-semibold text-primary-emphasis">Trạng thái
                <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/status.png" alt="status">
            </label>
            <select name="is_completed" class="form-select" aria-label="Default select example">
                <option <?= isSelected(getValueEdit($pre_data, $dataEdit)) ?> value="0">Chưa hoàn thành</option>
                <option <?= isSelected(getValueEdit($pre_data, $dataEdit)) ?> value="1">Đã hoàn thành</option>
            </select>
        </div>
        <div class="d-flex align-items-center  mt-4 justify-content-between gap-4">
            <button class="btn btn-primary py-2 w-50">Sửa Công Việc</button>
            <a class="btn btn-success py-2 w-50" href="<?= linkRoute('danh-sach') ?>">Quay lại</a>
        </div>
    </form>
</section>