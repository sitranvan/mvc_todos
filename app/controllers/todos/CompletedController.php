<?php
class CompletedController extends Controller
{
    private $todosModel;

    public function __construct()
    {
        $this->todosModel = $this->loadModel('todos/TodosModel');
    }
    public function index($id)
    {
        $dataUpdate = [
            'is_completed' => 1
        ];
        $status = $this->todosModel->updateTodos($dataUpdate, "id='$id'");
        if ($status) {
            Session::flash('msg', 'Đã đánh dấu hoàn thành công việc');
            Session::flash('msg_type', 'success');
        } else {
            Session::flash('msg', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
            Session::flash('msg_type', 'danger');
        }
        Response::redirect('danh-sach');
    }
}
