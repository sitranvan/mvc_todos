<section class="w-100 d-flex flex-column justify-content-center align-items-center" style="margin-top: 100px;">
    <div class="text-center w-50">
        <h1 class="text-uppercase fw-bold d-flex align-items-center justify-content-center gap-2">
            <span class="text-warning">Todo</span>
            <span class="text-info">List</span>
            <img width="60" src="<?= _WEB_ROOT ?>/public/assets/images/todo.png" alt="brand">
        </h1>
        <?= isset($msg) ? showMessage($msg,  $msg_type) : showMessage(Session::flash('msg'),  Session::flash('msg_type')) ?>
        <div class="text-start">
            <a class="btn btn-outline-primary text-start fw-medium" href="<?= linkRoute('them-cong-viec') ?>">Thêm công việc
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
        <form action="<?= linkRoute('danh-sach') ?>" method="get" class="mt-4">
            <div class="row">
                <div class="col-6">
                    <input value="<?= $pre_data['search'] ?? false ?>" name="search" class="form-control w-100" type="text" placeholder="Tìm kiếm công việc...">
                </div>
                <div class="col-4">
                    <select name="completed" class="form-select" aria-label="Default select example">
                        <option <?= getSelected($pre_data['completed'], 'all') ?> value="all">Tất cả</option>
                        <option <?= getSelected($pre_data['completed'], '0') ?> value="0">Chưa hoàn thành</option>
                        <option <?= getSelected($pre_data['completed'], '1') ?> value="1">Đã hoàn thành</option>
                    </select>
                </div>
                <div class="col-2">
                    <button class="btn btn-primary w-100">Tìm kiếm</button>
                </div>
            </div>
        </form>
        <ul class="list-group text-start mt-4 gap-2">
            <?php if (!empty($listTodos)) :
                foreach ($listTodos as $todos) : ?>
                    <li class="list-group-item list-group-item-light">
                        <div class="row">
                            <div class="col-9">
                                <a class="text-decoration-none text-secondary d-flex align-items-center gap-2 title-todos" href="<?= linkRoute('chi-tiet/' . $todos['id']) ?>">
                                    <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/bookmark.png" alt="delete">
                                    <span class="<?= $todos['is_completed'] ? 'text-decoration-line-through' : false ?>"> <?= $todos['title'] ?></span>
                                </a>
                            </div>
                            <div class="col-3 d-flex gap-3 justify-content-end">
                                <?php if (!$todos['is_completed']) : ?>
                                    <a class="border border-success rounded action action-completed" href="<?= linkRoute('danh-dau-hoan-thanh/' . $todos['id']) ?>">
                                        <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/completed-check.png" alt="completed">
                                    </a>
                                <?php endif ?>
                                <a class="border border-primary rounded action action-edit" href="<?= linkRoute('sua-cong-viec/' . $todos['id']) ?>">
                                    <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/edit.png" alt="edit">
                                </a>
                                <a onclick="return confirm('Bạn có muốn xóa công việc này?')" class="border border-danger rounded action action-delete" href="<?= linkRoute('xoa-cong-viec/' . $todos['id']) ?>">
                                    <img width="20" src="<?= _WEB_ROOT ?>/public/assets/images/delete.png" alt="delete">
                                </a>
                            </div>
                        </div>
                    </li>
                <?php endforeach;
            else : ?>
                <li class="list-group-item list-group-item-light">Không có công việc</li>
            <?php endif ?>
        </ul>
        <nav class="mt-5 d-flex justify-content-end">
            <ul class="pagination pagination-sm">
                <?php if ($currentPage > 1) : ?>
                    <li class="page-item">
                        <a class="page-link link-item" href="<?= linkRoute('danh-sach?' . $queryString . '&page=' . ($currentPage - 1)) ?>">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                    </li>
                <?php endif ?>
                <?php for ($index = $startPage; $index <= $endPage; $index++) : ?>
                    <li class="page-item" aria-current="page">
                        <a class="page-link link-item  <?= $index == $currentPage ? 'active' : false ?>" href="<?= linkRoute('danh-sach?' . $queryString . '&page=' . $index) ?>"><?= $index ?></a>
                    </li>
                <?php endfor ?>
                <?php if ($currentPage < $totalPages) : ?>
                    <li class="page-item">
                        <a class="page-link link-item" href="<?= linkRoute('danh-sach?' . $queryString . '&page=' . ($currentPage + 1)) ?>">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </nav>

    </div>
</section>