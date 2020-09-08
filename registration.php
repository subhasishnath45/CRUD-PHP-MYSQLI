<?php 
include 'db.php'; 
session_start();
include 'functions.php'; 
if(isset($_POST['register'])){
    $UserName = strtolower(trim($_POST['username'], " "));
    $Password = $_POST['Password'];
    $ConfirmPassword = $_POST['ConfirmPassword'];

    date_default_timezone_set("Asia/Kolkata");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    if(empty($UserName) || empty($Password) || empty($ConfirmPassword)){
        $_SESSION["ErrorMsg"] = "All Fields must be Filled Out.";
        header('Location: registration.php');
    }elseif(strlen($Password) < 4){
        $_SESSION["ErrorMsg"] = "Password must be of at least 4 characters.";
        header('Location: registration.php');
    }elseif($Password !== $ConfirmPassword){
        $_SESSION["ErrorMsg"] = "Password and Confirm password didn't match.";
        header('Location: registration.php');
    }elseif(CheckUserNameExistsOrNot($UserName)){
        $_SESSION["ErrorMsg"] = "UserName Already Exists! Try Another One.";
        header('Location: registration.php');
    }else{
        // secure form data send to database.
        // SQL injection.
        global $db;
        $stmt = $db->prepare("INSERT INTO `admins` (datatime,username,password) VALUES (?,?,?)");
        $stmt->bind_param("sss",$DateTime,$UserName,$Password);
        if($stmt->execute()){
            $_SESSION["SuccessMsg"] = "New Task Creator: " . $UserName . " is Added Successfully";
            header('Location: index.php');
            die();
        }else{
            $_SESSION["ErrorMsg"] = "Something went Wrong";
            header('Location: registration.php');
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
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="d-flex justify-content-center align-items-center" style="height:100vh">
                    <div class="w-100">

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
                           }
                        ?>
                        <h1 class="text-center">Task Creator Registration</h1>
                        <form class="" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group">
                                <label for="username">UserName</label>
                                <input type="text" class="form-control" name="username" id="username">
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label><br/>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="Password" id="Password" value="">
                                    <div class="input-group-append">
                                        <input type="button" id="switch" class="btn btn-info" onclick="revealPassword()" value="Reveal password">
                                    </div>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="ConfirmPassword">Confirm Password</label><br/>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword">
                                    <div class="input-group-append">
                                        <input type="button" id="switch2" class="btn btn-info" onclick="revealConfirmPassword()" value="Reveal password">
                                    </div>
                                </div> 
                            </div>
                            <input type="submit" name="register" value="Register" class="btn btn-block btn-success">
                            <p class="text-muted text-center my-0">
                                OR
                            </p>
                            <a href="login.php" class="btn btn-primary btn-block">Go to Login Page</a>
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
        function revealConfirmPassword(){
            // console.log('password revealed');
            if($("#ConfirmPassword").attr("type") == "password"){
                $("#ConfirmPassword").attr("type","text");
                $('#switch2').val("Hide password");
            }else{
                $("#ConfirmPassword").attr("type","password");
                $('#switch2').val("Reveal password");
            }
        }
    </script>

</body>
</html>