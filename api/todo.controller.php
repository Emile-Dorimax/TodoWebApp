<?php
require_once("todo.class.php");

class TodoController {
    private const PATH = __DIR__."/todo.json";
    private array $todos = [];

    public function __construct() {
        $content = file_get_contents(self::PATH);
        if ($content === false) {
            throw new Exception(self::PATH . " does not exist");
        }  
        $dataArray = json_decode($content);
        if (!json_last_error()) {
            foreach($dataArray as $data) {
                if (isset($data->id) && isset($data->title))
                $this->todos[] = new Todo($data->id, $data->title, $data->description, $data->done, $data->date);
            }
            usort($this->todos, function($a, $b)
            {
                return strtotime($b->date) - strtotime($a->date);
            });
        }
    }

    public function loadAll() : array {
        return $this->todos;
    }

    public function load(string $id) : Todo | bool {
        foreach($this->todos as $todo) {
            if ($todo->id == $id) {
                return $todo;
            }
        }
        return false;
    }

    public function create(Todo $todo) : bool {
        // implement your code here
        array_push($this->todos, $todo);
        file_put_contents(self::PATH, json_encode($this->todos));
        return true;
    }

    public function update(Todo $edittedTodo) : bool {
        // implement your code here
        $this->todos = array_filter(
            $this->todos,
            function($todo) use ($edittedTodo) {   
                if ($todo->id == $edittedTodo->id) {
                    $todo->title = $edittedTodo->title;
                    $todo->description = $edittedTodo->description;
                    $todo->done = $edittedTodo->done;
                    $todo->date = $edittedTodo->date;
                }
               return true;
            });
        
        file_put_contents(self::PATH, json_encode($this->todos));
        return true;
    }

    public function delete(string $id) : bool {        
        $this->todos = array_filter(
            $this->todos,
            function($todo) use ($id) {   
               return $todo->id != $id;
            });
        
        file_put_contents(self::PATH, json_encode($this->todos));
        return true;
    }

    // add any additional functions you need below
}