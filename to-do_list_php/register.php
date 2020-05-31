<?php
 // connect to datebase
include 'config/connect.php';
include_once 'classes/user.php';
// array to stock the exepting error
$errors = ['email' => '', 'first_name' => '', 'photo'=> '' , 'username'=> '' , 'last_name' => '', 'password' => ''];
// varaibles
$email = "";
$last_name = "";
$first_name = "";
$username = "";
$photo = ""; 

if (isset($_POST['submit'])) {
    // validation form
    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'email is required <br/>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'email not VALID';
        }
    }
    // check first_name
    if (empty($_POST['first_name'])) {
        $errors['first_name'] = 'title is required <br/>';
    } else {
        $first_name = $_POST['first_name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $first_name)) {
            $errors['first_name'] = 'first name must be letters and spaces only';
        }
    }
     // check last_name
     if (empty($_POST['last_name'])) {
        $errors['last_name'] = 'last name is required <br/>';
    } else {
        $last_name = $_POST['last_name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $last_name)) {
            $errors['last_name'] = 'last name must be letters and spaces only';
        }
    }
    // check username
    if (empty($_POST['username'])) {
        $errors['username'] = 'username is required <br/>';
    } else {
        $username = $_POST['username'];
        }
    
    // check picture link 
    if (empty($_POST['photo'])) {
        $errors['photo'] = 'picture link is required <br/>';
    } else {
        $photo = $_POST['photo'];  
    }
    // check password
    if (empty($_POST['password'])) {
        $errors['password'] = 'password is required <br/>';
    } else {
        $title = $_POST['password'];
        if (!preg_match('/^(?=.*\d).{8,20}$/', $title)) {
            $errors['password'] = 'Password must be between 8 and 20 digits long and include at least one numeric digi';
        }
    }
    // check if the email is already used
     $email = $_POST['email'];
     $sql = " SELECT * FROM user WHERE login = ? ";
     $stmt = $conn->prepare($sql);
     $stmt->execute([$email]);
     $usercount = $stmt->rowCount();
    //  echo mysqli_num_rows($result);
     if ($usercount==1){
        $errors['email'] = 'email is already used <br/>';
     }
    if (array_filter($errors)) {

    } 
    else { 
        $username = $_POST['username'];
        $photo = $_POST['photo'];
        $firstname =$_POST['first_name'];
        $lastname = $_POST['last_name'];
        $email = $_POST['email'];
        $password= $_POST['password'];
   
        $user1 = new user($username, $password, $email, $firstname, $lastname, $photo);
        $user1 -> register();
         echo $user1 -> getUsername();
        header('location: login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'template/header.php';?>
<!-- Default form login -->
<div class="container">
<form class="text-center border border-light p-5 z-depth-2 mx-auto formsm" action="register.php" method="POST">
    <h2 class="h1 mb-4">Sign up</h2>
    <div class="form-row mb-4">
        <div class="col">
            <!-- First name -->
            <input type="text" id="defaultRegisterFormFirstName" value="<?php echo $first_name ?>" name="first_name" class="form-control" placeholder="First name">
            <p class="error"> <?php echo $errors['first_name'] ?> </p>
        </div>
        <div class="col">
            <!-- Last name -->
            <input type="text" id="defaultRegisterFormLastName" name="last_name" value="<?php echo $last_name ?>" class="form-control" placeholder="Last name">
            <p class="error"> <?php echo $errors['last_name'] ?> </p>
        </div>
        <div class="col">
            <!-- username -->
            <input type="text" id="defaultRegisterFormLastName" name="username" value="<?php echo $username ?>" class="form-control" placeholder="user name">
            <p class="error"> <?php echo $errors['username'] ?> </p>
        </div>
        
    </div>
    <div >
            <!-- photo -->
            <input type="text" id="defaultRegisterFormLastName" name="photo" value="<?php echo $photo?>" class="form-control" placeholder="picture link">
            <p class="error"> <?php echo $errors['last_name'] ?> </p>
        </div>
    <!-- E-mail -->
    <input type="email" id="defaultRegisterFormEmail" name="email" value="<?php echo $email ?> " class="form-control mb-4" placeholder="E-mail">
    <p class="error"> <?php echo $errors['email'] ?> </p>
    <!-- Password -->
    <input type="password" id="defaultRegisterFormPassword" name="password" class="form-control" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
    <h5 class="error"> <?php echo $errors['password'] ?> </h5>
    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
        At least 8 characters and 1 digit
    </small>
    <!-- Sign up button -->
    <button class="btn btn-info my-4 btn-block" name="submit" type="submit">Sign in</button>
    <hr>
    <!-- Terms of service -->
    <p>By clicking
        <em>Sign up</em> you agree to our terms of service
</form>
<!-- Default form register -->
</div>
<!-- Default form login -->
<?php include 'template/footer.php';?>