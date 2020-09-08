<?php include 'db.php'; 
session_start();

$_SESSION['User_ID'] = null;
$_SESSION['User_Name'] = null;

session_destroy();

header('Location: registration.php');

?>