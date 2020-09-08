<?php include 'db.php'; ?>
<?php      
session_start();
global $db;
// Preventing Direct Access to this page
if(!isset($_SESSION["User_Name"])){
    $_SESSION["ErrorMsg"] = "Registration or login Required";
    header("Location: registration.php");
    die();
}else{
    $loggedInUserID = $_SESSION["User_ID"];
    $loggedInUser = $_SESSION["User_Name"];
}

$page = (isset($_GET['page']) ? $_GET['page'] : 1);

$per_page = (isset($_GET['per-page']) && ($_GET['per-page'] <= 50) ? $_GET['per-page'] : 5);
// Suppose $page = 2 and $per_page = 5
// so start = (2*5) - 5 = 5th post
// Suppose $page = 3 and $per_page = 5
// so start = (3*5) - 5 = 10th post
$start = ($page > 1) ? ($page * $per_page) - $per_page : 0;

// $sql_select = "SELECT * FROM tasks";
$sql_select = "SELECT * FROM tasks WHERE admin_id=$loggedInUserID LIMIT " . $start. ", ". $per_page;


$sql_select_all = "SELECT * FROM tasks WHERE admin_id=$loggedInUserID";
$result_all = mysqli_query($db, $sql_select_all);
$total = mysqli_num_rows($result_all);
// echo $total;
$no_of_pages = ceil($total / $per_page);

// echo $no_of_pages;
$rows = $db->query($sql_select);
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
            <div class="col-md-10 offset-md-1">
                <h1 class="text-center text-uppercase">Task List</h1>
                <div class="btn-group w-100 mb-2">
                    <button type="button" class="btn btn-success" id="addtask-btn">Add Task</button>
                    <?php 
                        if(isset($loggedInUserID)){
                    ?>
                    <a href="web-service.php" class="btn btn-dark">GET JSON DATA</a>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-md-12 text-center mb-5">
                    <form action="search.php" method="post" class="form-inline">
                        <input type="text" placeholder="Search For Tasks" name="search" class="form-control col-12"> 
                    </form>
                </div>
                <?php 
                    if(isset($_SESSION["updatemsg"])){
                ?>
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">
                            &times;
                        </a>
                        <strong>
                            <?php echo $_SESSION["updatemsg"]; ?>
                        </strong>
                    </div>
                <?php
                    unset($_SESSION["updatemsg"]);
                    }elseif(isset($_SESSION["SuccessMsg"])){
                ?>

                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">
                            &times;
                        </a>
                        <strong>
                            <?php echo $_SESSION["SuccessMsg"]; ?>
                        </strong>
                    </div>

                <?php
                    unset($_SESSION["SuccessMsg"]);
                    }
                ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tasks</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                        if($total > 0){
                            $counter = 0;
                            while($row = $rows->fetch_assoc()){
                                $counter++;
                        ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td class="col-md-8"><?php echo $row['name']; ?></td>
                            <td><a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-block">Edit</a></td>
                            <td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-block">Delete</a></td>
                        </tr>
                        <?php 

                        }
                            }else{
                        ?>
                        <tr>
                            <td colspan="3">No Task Found</td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>

                <div class="text-center w-100">
                    <ul class="pagination justify-content-center">
                        <?php 
                        for($i=1;$i<=$no_of_pages; $i++){
                        ?>
                        <li class="page-item">
                            <a href="?page=<?php echo $i; ?>&per-page=<?php echo $per_page; ?>" class="page-link">
                                <?php echo $i; ?>
                            </a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!--Modal starts-->

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Task</h4>
                    <button type="button" class="close" data-dismiss="modal">X</button>
                </div>
                <div class="modal-body">
                    <form class="" method="post" action="add.php">
                        <div class="form-group">
                            <label for="task">Task Name</label>
                            <input type="text" class="form-control" name="task" id="task" required>
                        </div>
                        <input type="submit" name="send" value="Add Task" class="btn btn-block btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal ends-->

    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#addtask-btn").click(function(){
                $('#myModal').modal();
            });
        });
    </script>
</body>
</html>