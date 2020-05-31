


<!DOCTYPE html>
<html lang="en">
<?php include 'template/header.php';?>
<?php
include 'config/connect.php';
$id = $_SESSION['id'];
$sql = 'SELECT * FROM user where id = :id';
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_OBJ);
$_SESSION['photo'] = $user->photo;
$_SESSION['username'] = $user->username;
$_SESSION['password'] = $user->password;
$_SESSION['firstname'] = $user->firstname;
$_SESSION['lastname'] = $user->lastname;
$_SESSION['email'] = $user->email;

if (isset($_POST['edit'])) {
    header('location: editprofile.php');
}
?>
<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="<?php echo $user->photo ?>" alt=""/>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                     <?php echo $user->firstname . '  ' . $user->lastname ?>
                                    </h5>
                                 <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="edit" value="Edit Profile"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $user->id ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $user->firstname . '  ' . $user->lastname ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $user->email ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Username</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $user->username ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                        </div>
                                        <div class="row">

                                        </div>
                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php include 'template/footer.php';?>
</html>