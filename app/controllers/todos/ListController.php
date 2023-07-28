<?php
class ListController extends Controller
{
    private $todosModel;
    private $data = [];
    public function __construct()
    {
        $this->todosModel = $this->loadModel('todos/TodosModel');
        if (App::getApp()->getUrl() == '/') {
            App::getApp()->handleRoutes('isAuthenticated');
        }
    }
    public function index()
    {
        $request = new Request();
        $this->data['view'] = 'todos/index';
        $this->data['title'] = 'Danh sách công việc';


        if ($request->isGet()) {
            $keyword = $request->getBody()['search'] ?? '';
            $completed = $request->getBody()['completed'] ?? '';
            $currentPage = $request->getBody()['page'] ?? 1;
        }

        // Xử lí khi tìm kiếm hoặc lọc sau đó bấm phân trang thì sẽ mất đi lọc và phân trang
        $urlParams = [
            'search' => $keyword,
            'completed' => $completed,
        ];
        $queryString = http_build_query($urlParams);

        $listTodos = $this->todosModel->getAllTodos($keyword, $completed, $currentPage);
        $this->data['payload']['listTodos'] = $listTodos;
        $totalPages =  $this->todosModel->getTotalPages();

        $this->data['payload']['totalPages'] = $totalPages;
        $this->data['payload']['queryString'] = $queryString;
        $this->data['payload']['currentPage'] = $currentPage;
        $startPage = max(1, $currentPage - 2);
        $endPage = min($totalPages, $currentPage + 2);
        $this->data['payload']['startPage'] = $startPage;
        $this->data['payload']['endPage'] = $endPage;
        $this->data['payload']['pre_data'] = $request->getBody();
        $this->render('layouts/layout_private', $this->data);
    }
}
