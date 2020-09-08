<?php 
include 'db.php';
global $db;
$query_result = $db->query("SELECT * FROM `tasks`");
$result = array();

while($fetchData = $query_result->fetch_assoc()){
    $result[] = $fetchData;
}

echo json_encode($result);

?>