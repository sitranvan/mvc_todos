<?php
class DetailController extends Controller
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
        $this->data['payload']['errors'] = '';
        $this->data['view'] = 'todos/detail';
        $this->data['title'] = 'Chi tiết công việc';
        $this->data['payload']['todos'] = $this->todosModel->getTodos("id='$id'");
        $this->render('layouts/layout_private', $this->data);
    }
}
