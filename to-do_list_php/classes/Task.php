<?php 
class Task
{
 private $id;
 private $taskText;
 private $done;
 private $todolist_id;
    //constructure
    public function __construct( )
    {
        $this-> = $;
        
    }
    // methodes
    public function ChangeTaskStatus(){
        
       }
    public function DeleteTask(){
        
    }
    public function ChangeTaskText($tastText){
        
    }
 
    //getters and setters
    public function getId(){
        return $this->id;
       }
      
       public function setId($id){
        $this->id = $id;
       }
      
       public function getTaskText(){
        return $this->taskText;
       }
      
       public function setTaskText($taskText){
        $this->taskText = $taskText;
       }
      
       public function getDone(){
        return $this->done;
       }
      
       public function setDone($done){
        $this->done = $done;
       }
      
       public function getTodolist_id(){
        return $this->todolist_id;
       }
      
       public function setTodolist_id($todolist_id){
        $this->todolist_id = $todolist_id;
       }
}
