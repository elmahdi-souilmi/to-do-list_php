<?php 
 // connect to datebase
 session_start(); 
 $error = '';
 include 'config/connect.php';
 if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    //make sql
    $sql = "SELECT * FROM user WHERE email = ? AND password = ? ";
    //get result
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email,$password]);
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    $usercount = $stmt->rowCount();
    if ($usercount==1){
          $_SESSION['id']=$user->id;
          header('location: index.php');
    } else {
       $error = 'verefie l3ibaat ';
    }
 }

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'template/header.php';?>
<!-- Default form login -->
<div class="container">
<form class="text-center border border-light p-5 mx-auto z-depth-2 formsm"  action="login.php" method="POST">
    <p class="h1 mb-4">Sign in  </p>
    <!-- Email -->
    <input type="email" id="defaultLoginFormEmail" name="email" class="form-control mb-4" placeholder="E-mail">
    <!-- Password -->
    <input type="password" id="defaultLoginFormPassword" name="password" class="form-control mb-4" placeholder="Password">
    <div class="d-flex justify-content-around">
        <div>
           <h3> <?php  echo $error ?>  </h3>
        </div>
        
    </div>
    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" name="submit" type="submit">Sign in</button>
    <!-- Register -->
    <p>Not a member?
        <a href="register.php">Register</a>
    </p>
</form>
</div>
<!-- Default form login -->
<?php include 'template/footer.php';?>