<?php 
include 'db.php';
session_start();
include 'functions.php'; 
if(isset($_POST['login'])){

    $UserName = strtolower(trim($_POST['username'], " "));
    $Password = $_POST['Password'];

    $time = date("H");
    $timezone = date("e");

    if($time < "12"){
        $greeting = "Good Morning";
    } elseif($time >= "12" && $time < "17"){
        $greeting = "Good Afternoon";
    }elseif($time >= "17" && $time < "19"){
        $greeting = "Good Evening"; 
    }else if($time >= "19"){
        $greeting = "Good Night"; 
    }

    // Validation.
    if(empty($UserName) || empty($Password)){
        $_SESSION["ErrorMsg"] = "All Fields Must be Filled Out.";
        header('Location: login.php');
        die();
    }else{
        global $db;
        $sql_login = "SELECT * FROM `admins` WHERE username=? AND password=? LIMIT 1";
        $stmt = $db->prepare($sql_login);
        $stmt->bind_param("ss", $UserName, $Password);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result.
        // var_dump($result);
        if($result->num_rows != 0){
            $UserRow = $result->fetch_assoc();

            // remembering the logged in user.
            $_SESSION["User_ID"] = $UserRow["id"];
            $_SESSION["User_Name"] = $UserRow["username"];

            $_SESSION["SuccessMsg"] = "Welcome Back: " . $_SESSION["User_Name"] . ". " . $greeting;
            header("Location: index.php");
            die();
        }else{
            $_SESSION["ErrorMsg"] = "Incorrect Credentials or User doesn't Exists";
            header("Location: login.php");
            die();
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="d-flex justify-content-center align-items-center" style="height:100vh;">
                    <div class="w-100">
                        <!-- success and error messages-->
                        <?php 
                            if(isset($_SESSION["ErrorMsg"])){
                        ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">
                                &times;
                            </a>
                            <strong><?php echo $_SESSION["ErrorMsg"]; ?></strong>
                        </div>
                        <?php
                            // unset($_SESSION["ErrorMsg"]);
                            } 
                        ?>
                        <h1 class="text-center text-uppercase">Task Creator Login</h1>
                        <form class="" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group">
                                <label for="">UserName</label>
                                <input type="text" class="form-control" name="username" id="username"/>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label><br/>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="Password" id="Password">
                                    <div class="input-group-append">
                                        <input id="switch" class="btn btn-info" type="button" onclick="revealPassword()" value="Reveal Password"/>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="login" value="Login" class="btn btn-block btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="bootstrap.min.js"></script>
    <script type="text/javascript">
        function revealPassword(){
            // console.log('password revealed');
            if($("#Password").attr("type") == "password"){
                $("#Password").attr("type","text");
                $('#switch').val("Hide password");
            }else{
                $("#Password").attr("type","password");
                $('#switch').val("Reveal password");
            }
        }
    </script>
</body>
</html>