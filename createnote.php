<?php

session_start();
include('connection.php');

$user_id = $_SESSION['user_id'];

$time = time();
$sql = "INSERT INTO notes (`user_id`, `note`, `time` ) VALUES ('$user_id', '', '$time')";
$result = mysqli_query($link, $sql);
if(!$result){
    echo "error";
} else {
    // this function returns auto generated id used in the last query
    echo mysqli_insert_id($link);
}