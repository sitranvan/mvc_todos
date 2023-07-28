<?php
class EditController extends Controller
{
    private $todosModel;
    private $data;
    public function __construct()
    {
        $this->todosModel = $this->loadModel('todos/TodosModel');
        $this->data = [];
    }
    public function index($id)
    {
        Session::flash('id_edit', $id);
        $this->data['payload']['errors'] = Session::flash('errors');
        $this->data['payload']['pre_data'] = Session::flash('pre_data');
        $this->data['payload']['msg_type'] = Session::flash('msg_type');
        $this->data['view'] = 'todos/edit';
        $this->data['title'] = 'Sửa công việc';
        $this->data['payload']['dataEdit'] = $this->todosModel->getTodos("id='$id'");
        $this->render('layouts/layout_private', $this->data);
    }
    public function edit()
    {
        $idEdit = Session::flash('id_edit');
        $request = new Request();
        $validate = new Validate();
        $title = $request->getBody()['title'];
        $dueDate = $request->getBody()['due_date'];
        $description = $request->getBody()['description'];
        $completed = $request->getBody()['is_completed'];
        if ($request->isPost()) {
            $validate->requiredTodos($title, 'title', 'Tiêu đề không được bỏ trống');
            $validate->requiredTodos($dueDate, 'due_date', 'Vui lòng chọn ngày hết hạn');
            $validate->requiredTodos($description, 'description', 'Mô tả không được bỏ trống');
        }
        if (empty($validate->getErrors())) {
            $dataUpdate = [
                'title' => $title,
                'description' => $description,
                'due_date' => $dueDate,
                'is_completed' => $completed
            ];
            $status = $this->todosModel->updateTodos($dataUpdate, "id='$idEdit'");
            if ($status) {
                Session::flash('msg', 'Cập nhật thành công');
                Session::flash('msg_type', 'success');
                Response::redirect('danh-sach');
            } else {
                Session::flash('msg', 'Cập nhật thất bại');
                Session::flash('msg_type', 'danger');
            }
        } else {
            Session::flash('msg_type', 'danger');
            Session::flash('errors', $validate->getErrors());
            Session::flash('pre_data', $validate->getDataField());
        }
        Response::redirect('sua-cong-viec/' . $idEdit);
    }
}
