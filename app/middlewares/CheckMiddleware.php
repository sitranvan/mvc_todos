<?php
class CheckMiddleware
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }
    public function checkCompleted()
    {
        $userLogin = new UserLogin();
        $userId = '';
        if (isset($userLogin->get()['id'])) {
            $userId = $userLogin->get()['id'];
        }
        $listTodos = $this->db->getAll("SELECT * FROM todos WHERE user_id='$userId'");
        if (!empty($listTodos)) {
            $dateObj = new DateTime();
            foreach ($listTodos as $todos) {
                $dueDateTimestamp = strtotime($todos['due_date']);
                if ($dueDateTimestamp < $dateObj->getTimestamp()) {
                    $dataUpdate = ['is_completed' => 1];
                    $id = $todos['id'];
                    $this->db->update('todos', $dataUpdate, "id='$id'");
                }
            }
        }
    }
}
