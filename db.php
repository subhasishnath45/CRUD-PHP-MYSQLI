<?php 

$db = new mysqli;
$db->connect('localhost','root','','tasklist');

// Check if the connection is successful
if($db->connect_errno){
    printf("Connection failed: %s\n",$db->connect_error);
    exit();
}else{
    // echo "Connection Successful";
}

?>