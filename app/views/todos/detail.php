<section class="d-flex flex-column align-items-center w-100 justify-content-center" style="margin-top: 100px;">
    <h2 class="text-uppercase fw-bold d-flex align-items-center justify-content-center gap-2">
        <span class="text-info">Chi Tiết Công Việc</span>
        <img width="50" src="<?= _WEB_ROOT ?>/public/assets/images/detail.png" alt="detail">
    </h2>
    <div class="text-start w-50 mt-5">
        <div class="">
            <h5 class="text-primary-emphasis fst-italic d-flex align-items-center gap-2">
                Tiêu đề
                <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/title.png" alt="title">
            </h5>
            <p><?= $todos['title'] ?? false ?></p>
        </div>
        <hr>
        <div class="">
            <h5 class="text-primary-emphasis fst-italic d-flex align-items-center gap-2">
                Mô tả công việc
                <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/description.png" alt="desc">
            </h5>
            <p><?= $todos['description'] ?? false ?></p>
        </div>
        <hr>
        <div class="">
            <h5 class="text-primary-emphasis fst-italic d-flex align-items-center gap-2">
                Thời gian
                <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/date.png" alt="date">
            </h5>
            <div class="d-flex align-items-center gap-2">
                <span class="text-body"><?= $todos['create_at'] ?? false ?></span>
                <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/arrow-next.png" alt="arrow-next">
                <span class="text-success"><?= $todos['due_date'] ?? false ?></span>
            </div>
        </div>
        <hr>

        <div class="">
            <h5 class="text-primary-emphasis fst-italic d-flex align-items-center gap-2">
                Trạng thái
                <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/status.png" alt="status">

            </h5>
            <?= $todos['is_completed'] ? ' 
            <span class="btn btn-success btn-sm">Đã hoàn thành</span>' :
                ' <span class="btn btn-warning btn-sm">Chưa hoàn thành</span>'
            ?>
        </div>
        <hr>
        <a class="btn btn-primary px-4 mt-2" href="<?= linkRoute('danh-sach') ?>">Quay lại danh sách
            <i class="fa-solid fa-rotate-left ms-2"></i>
        </a>
    </div>
</section>