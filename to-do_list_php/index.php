
<!DOCTYPE html>
<html lang="en">
    <!-- <div class="col-4">.col-4</div>
    <div class="col-4">.col-4</div>
  </div> -->

<?php include 'template/header.php';
include_once 'classes/TodoList.php';
?>
<?php
if (isset($_GET["color"])) {
    $color = $_GET["color"];
    $todoid = $_GET["todoId"];
    $sql = 'UPDATE todolist SET color = :color WHERE id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['color' => $color, 'id' => $todoid]);

}
?>

<?php if (isset($_POST['add'])) {
 
    $name = $_POST['name'];
    $color = $_POST['color'];
    $user_id = $_SESSION['id'];
    // var_dump();
    // var_dump();
    $TodoList1 = new TodoList($name, $color, $user_id);
    $TodoList1->register();
    header('location: index.php');
}
?>


<?php if (isset($_SESSION['id'])) {
    // initialize errors variable
    $errors = "";
    // connect to database
    include 'config/connect.php';
    // insert a quote if submit button is clicked
    if (isset($_POST['submit'])) {
        if (empty($_POST['task'])) {
            $errors = "You must fill in the task";
        } else {
            $task = $_POST['task'];
            $userid = $_POST['todoId'];
            $sql = "INSERT INTO task (taskText, todolist_id) VALUES ('$task', '$userid')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            header('location: index.php');
        }?>

<?php
}
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
        $sql = "DELETE FROM task WHERE id=$id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // header('location: index.php');
    }
    if (isset($_GET['del_todo'])) {
        $id = $_GET['del_todo'];
        $sql = "DELETE FROM todolist WHERE id=$id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // header('location: index.php');
    }

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM todolist where user_id = :id ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $todolists = $stmt->fetchAll(PDO::FETCH_OBJ);?>
	<!-- add todo list -->
	<div class="text-center">
<form id="indexform" method="post" action="index.php" class="input_form" >
  <h2 style="font-style: 'Hervetica';"> Add TODO-LIST</h2>
    <input type="text" name="name" class="input" placeholder="Name">
	<select name="color"  class="mdb-select md-form">
			<option  value="" disabled selected>Choose your color</option>
			<option value="red">red</option>
			<option value="blue">blue</option>
			<option value="green">green</option>
		</select>
	<button type="submit" name="add" id="add_btn" class="add_btn">Add TODO-LIST</button>
</form>
</div>
<?php	foreach ($todolists as $todolist) {?>
<!-- todo list -->
<div class="heading"  style="background-color:<?php echo $todolist->color; ?>">
<div class="float-right">
<td class="delete">
<a href="index.php?del_todo=<?php echo $todolist->id; ?>" style="font-size:200%;color:white"> x</a>
 </div>
	</td>
		<h2 style="font-style: 'Hervetica';"><?php echo $todolist->name; ?></h2>
		<form  method="get">
		<select name="color" onchange="this.form.submit()" class="mdb-select md-form">
			<option value="" disabled selected>Choose your color</option>
			<option value="red">red</option>
			<option value="blue">blue</option>
			<option value="green">green</option>
		</select>
		<input type="hidden"  name="todoId" value="<?php echo $todolist->id; ?>">
		</form>
	</div>
	<!-- add task -->
	<form id="indexform" method="post" action="index.php" class="input_form" style="background-color:<?php echo $todolist->color; ?>;">
		<input type="text" name="task" class="task_input">
		<input type="hidden"  name="todoId" value="<?php echo $todolist->id; ?>">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>
    <table >
	<thead>
		<tr>
			<th>N</th>
			<th>Tasks</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
// select all tasks if page is visited or refreshed
        $id = $todolist->id;
        $sql = "SELECT * FROM task where todolist_id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($tasks as $task) {?>
			<tr>
				<td> <?php echo $task->id; ?> </td>
				<td class="task"> <?php echo $task->taskText; ?> </td>
				<td class="delete">
				<a href="index.php?del_task=<?php echo $task->id; ?>">x</a>
				</td>
			</tr>
		<?php }?>
	</tbody>
</table>
<hr>
</div>
</div>
<?php }?>
    <?php if (isset($errors)) {?>
	<p><?php echo $errors; ?></p>
    <?php }?>
<!-- Section: Blog v.1 -->
<?php include 'template/footer.php';?>
</html>
	<?php } else {
		 header( "refresh:5;url=login.php" );?>
        <h2> login to see this page you will be redericted to login page in 2 seconds </h2>
        <?php }?>
