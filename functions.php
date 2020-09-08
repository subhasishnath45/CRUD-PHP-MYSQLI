<?php include 'db.php'; ?>
<?php 

function CheckUserNameExistsOrNot($UserName){
    global $db;
    $sql_user_existance_check = "SELECT username FROM admins WHERE username=?";
    $stmt = $db->prepare($sql_user_existance_check);
    $stmt->bind_param("s", $UserName);
    $stmt->execute();
    // will return true if the query successfully ran.
    $result = $stmt->get_result();
    // Checking for one or more rows.
    if($result->num_rows > 0){
        return true;
    }else{
        return false;
    }
}

?>