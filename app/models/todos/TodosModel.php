<?php
class TodosModel extends Model
{
    private $userLogin;
    private $queryString;
    private $totalPages;
    public function __construct()
    {
        parent::__construct();
        $this->userLogin = new UserLogin();
        $this->queryString = '';
        $this->totalPages = 0;
    }
    public function getTodos($condition = '')
    {
        return $this->fetch('todos', '*', $condition);
    }
    public function getAllTodos($keyword = '', $completed = '', $currentPage = '')
    {
        $userId = $this->userLogin->get()['id'];
        $condition = "WHERE user_id=$userId";

        if (isset($keyword) && !empty($keyword)) {
            $condition .= " AND title LIKE '%$keyword%'";
        }
        if (isset($completed) && $completed == 0) {
            $condition .= " AND is_completed = 0";
        } elseif (isset($completed) && $completed == 'all') {
            $condition .= "";
        } elseif (isset($completed) && !empty($completed)) {
            $condition .= " AND is_completed = $completed";
        }
        // Tính toán trước khi phân trang vì khi phân trang sẽ có LIMIT và OFFSET khi đó lấy số lượng bản ghi không chính xác
        $countArr = $this->countAllCondition('todos', $condition);
        $countNumber = $countArr[0]['COUNT(*)'];
        $this->totalPages = ceil($countNumber / _PER_PAGE);

        $perPage = _PER_PAGE;
        $offset = ($currentPage - 1) * $perPage;
        $condition .= " LIMIT $perPage OFFSET $offset";

        return  $this->fetchAllCondition('todos', $condition);
    }
    public function getTotalPages()
    {
        return $this->totalPages;
    }
    public function getQueryString()
    {
        return $this->queryString;
    }
    public function insertTodos($data = [])
    {
        return $this->insertRecord('todos', $data);
    }
    public function updateTodos($data = [], $condition = '')
    {
        return $this->updateRecord('todos', $data, $condition);
    }
    public function deleteTodos($condition = '')
    {
        return $this->deleteRecord('todos', $condition);
    }
}
