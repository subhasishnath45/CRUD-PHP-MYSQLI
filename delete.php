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
$id = $_GET['id'];
// echo $id;

$sql_delete = "DELETE FROM tasks WHERE id='$id'";

$val = $db->query($sql_delete);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Page</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center" style="height:100vh;">
                    <div>
                        <?php if($val){ ?>
                            <div class="alert alert-success">
                                Your task is Deleted :)
                            </div>
                            <a href="index.php" class="btn btn-success btn-block">Back to Home</a>
                        <?php }else{ ?>
                            <div class="alert alert-danger">
                                Something went wrong :(
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>