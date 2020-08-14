<?php

session_start();
include('connection.php');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magna Notas - Activation</title>
    <link rel='stylesheet' href='style.css'/>
</head>
<body>
    <div class="container text-primary text-center">
        <div class="row">
            <div class="offset-lg-1 col-lg-10">
                <h1>Account Activation</h1>
<?php
// if email or activation key is missing
if(!isset($_GET['email']) || !isset($_GET['key'])){
    echo "<div class='alert alert-danger'>There was an error. Please click on the activation link you received by email.</div>";
    exit;
}

$email = $_GET['email'];
$key = $_GET['key'];

$email = mysqli_real_escape_string($link, $email);
$key = mysqli_real_escape_string($link, $key);

// Set activation field to activated for the provided email
$sql = "UPDATE users SET activation = 'activated' WHERE(email = '$email' AND activation = '$key') LIMIT 1";
$result = mysqli_query($link, $sql);

if(mysqli_affected_rows($link) == 1){
    echo "<div class='alert alert-success'>Your account has been activated.</div>";
    echo "<a href='index.php' type= 'button' class='btn-lg btn-primary'>Log in</a>";
} else {
    echo "<div class='alert alert-danger'>Your account could not be activated. Please try again later.</div>";
}
?>
            </div>
        </div>
    </div>
</body>
</html>