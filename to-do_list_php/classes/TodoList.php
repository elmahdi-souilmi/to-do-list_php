<?php 
class TodoList 
{
    private $id;
    private $name;
    private $color;
    private $user_id;
   //constructure 
   public function __construct($name, $color, $user_id)
    {
        $this->name = $name;
        $this->color = $color;
        $this->user_id = $user_id; 
    }

   //methodes
   public function register()
   {    
       include 'config/connect.php';
       $sql = "INSERT INTO todolist(name, color, user_id) VALUES( '$this->name', '$this->color', '$this->user_id' )";
       $stmt = $conn->prepare($sql);
       $stmt->execute();

   }
   public function UpdateName($name){

    }
    public function ChangeColor($color){

    }

   //getters and setters
   public function getId(){
    return $this->id;
   }
  
   public function setId($id){
    $this->id = $id;
   }
  
   public function getName(){
    return $this->name;
   }
  
   public function setName($name){
    $this->name = $name;
   }
  
   public function getColor(){
    return $this->color;
   }
  
   public function setColor($color){
    $this->color = $color;
   }
  
   public function getUser_id(){
    return $this->user_id;
   }
  
   public function setUser_id($user_id){
    $this->user_id = $user_id;
   }
    
}
?>