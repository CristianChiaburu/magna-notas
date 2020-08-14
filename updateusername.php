<?php

session_start();
include ('connection.php');

$id = $_SESSION['user_id'];
$username = $_POST['username'];

$sql = " UPDATE users SET username = '$username' where user_id = '$id' ";
$result = mysqli_query($link, $sql);

if(!$result){
    echo "<div class='alert alert-danger'>Unable to update the username. Please try again later.</div>";
    exit;
}

