<?php
class user
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $firstname;
    private $lastname;
    private $photo;
    public function __construct($username, $password, $email, $firstname, $lastname, $photo)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->photo = $photo;

    }
    // methodes
    public function register()
    { include 'config/connect.php';
        $sql = " INSERT INTO user(username, password, email, firstname, lastname, photo) VALUES( '$this->username', '$this->password', '$this->email', '$this->firstname', '$this->lastname', '$this->photo' ) ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

    }
    public function UpdateInformation($username, $email, $firstname, $lastname, $photo, $passwordd, $id)
    {   
        include 'config/connect.php';
        $sql = 'UPDATE user SET username = :username, password = :password, email=:email, firstname= :firstname, lastname= :lastname, photo=:photo WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['username' => $username, 'password'=> $passwordd, 'email'=> $email, 'firstname'=>$firstname, 'lastname' => $lastname, 'photo'=>$photo, 'id' => $id]);
        echo 'Post Updated';

    }

    // getters and setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

}
