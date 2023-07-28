<?php
class DeleteController extends Controller
{
    private $todosModel;

    public function __construct()
    {
        $this->todosModel = $this->loadModel('todos/TodosModel');
    }

    public function index($id)
    {
        $status = $this->todosModel->deleteTodos("id='$id'");
        if ($status) {
            Session::flash('msg', 'Xóa thành công');
            Session::flash('msg_type', 'success');
        } else {
            Session::flash('msg', 'Xóa thất bại, vui lòng thử lại sau');
            Session::flash('msg_type', 'danger');
        }
        Response::redirect('danh-sach');
    }
}
