<?php include 'db.php'; 
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
if(isset($_POST['send'])){
    $taskname = htmlentities($_POST['task']);
    // if(!empty($taskname)){
    //     $sql_insert = "INSERT INTO tasks(name) VALUES('$taskname')";
    //     $val = $db->query($sql_insert);
    // }
    $stmt = $db->prepare("INSERT INTO `tasks`(name, admin_id) VALUES(?,?)");
    $stmt->bind_param("si",$taskname, $loggedInUserID);
    if($stmt->execute()){
        $_SESSION["SuccessMsg"] = "New Task is Added";
        header("Location: index.php");
        die();
    }else{
        $_SESSION["ErrorMsg"] = "Something Went Wrong!";
        header("Location: index.php");
        die();
    }
}

?>
