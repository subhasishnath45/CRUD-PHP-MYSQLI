<?php 
include 'db.php'; 
session_start();
if(!isset($_SESSION["User_Name"])){
    $_SESSION["ErrorMsg"] = "Registration or login Required";
    header("Location: registration.php");
    die();
}else{
    $loggedInUserID = $_SESSION["User_ID"];
    $loggedInUser = $_SESSION["User_Name"];
}
global $db;
$id = $_GET['id'];

$sql_existing_data = "SELECT * FROM tasks WHERE id='$id'";

$rows = $db->query($sql_existing_data);
$row = $rows->fetch_assoc();

if(isset($_POST['send'])){
    $task = $_POST['task'];
    $sql_update = "UPDATE tasks SET name='$task' WHERE id='$id'";
    $db->query($sql_update);
    session_start();
    $_SESSION["updatemsg"] = 'Your Task is Updated.';
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD APP using MySQLi and PHP</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="d-flex justify-content-center align-items-center" style="height:100vh;">
                    <div class="w-100">
                        <h1 class="text-center text-uppercase">Update Task</h1>
                        <form class="" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group">
                                <label for="task">Task Name</label>
                                <input type="text" class="form-control" name="task" id="task" required value="<?php echo $row['name']; ?>">
                            </div>
                            <input type="submit" name="send" value="Update Task" class="btn btn-block btn-success">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>
</body>
</html>