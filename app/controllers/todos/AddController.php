<?php
class AddController extends Controller
{
    private $todosModel;
    private $data;
    public function __construct()
    {
        $this->todosModel = $this->loadModel('todos/TodosModel');
        $this->data = [];
    }
    public function index()
    {
        $this->data['payload']['errors'] = Session::flash('errors');
        $this->data['payload']['pre_data'] = Session::flash('pre_data');
        $this->data['payload']['msg_type'] = Session::flash('msg_type');
        $this->data['view'] = 'todos/add';
        $this->data['title'] = 'Thêm công việc';
        $this->render('layouts/layout_private', $this->data);
    }
    public function add()
    {
        $request = new Request();
        $validate = new Validate();
        $userLogin = new UserLogin();
        if ($request->isPost()) {
            $validate->requiredTodos($request->getBody()['title'], 'title', 'Tiêu đề không được bỏ trống');
            $validate->requiredTodos($request->getBody()['due_date'], 'due_date', 'Vui lòng chọn ngày hết hạn');
            $validate->requiredTodos($request->getBody()['description'], 'description', 'Mô tả không được bỏ trống');
        }
        if (empty($validate->getErrors())) {
            $userId = $userLogin->get()['id'];
            $title = $validate->getDataField()['title'];
            $dueDate = $validate->getDataField()['due_date'];
            $description = $validate->getDataField()['description'];
            $dataInsert = [
                'title' => trim($title),
                'due_date' => $dueDate,
                'description' => $description,
                'user_id' => $userId
            ];
            $status = $this->todosModel->insertTodos($dataInsert);
            if ($status) {
                Session::flash('msg', 'Thêm công việc thành công');
                Session::flash('msg_type', 'success');
                Response::redirect('danh-sach');
            } else {
                Session::flash('msg', 'Thêm thất bại, thử lại sau');
                Session::flash('msg_type', 'danger');
            }
        } else {
            Session::flash('msg_type', 'danger');
            Session::flash('errors', $validate->getErrors());
            Session::flash('pre_data', $validate->getDataField());
        }
        Response::redirect('them-cong-viec');
    }
}
