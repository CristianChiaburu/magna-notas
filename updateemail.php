<?php

session_start();
include('connection.php');

$user_id = $_SESSION['user_id'];
$newEmail = $_POST['email'];

$sql = "SELECT * FROM users WHERE email = '$newEmail'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
if ($count > 0) {
    echo "<div class='alert alert-danger'>That email is already taken.</div>";
    exit;
}

$sql =  "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
if ($count == 1) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $email = $row['email'];
} else {
    echo "There was an error retrieving the email from database.";
    exit;
}


$activationKey = bin2hex(openssl_random_pseudo_bytes(16));

$sql = "UPDATE users SET activation2 = '$activationKey' WHERE user_id = '$user_id'";
$result = mysqli_query($link, $sql);
if (!$result) {
    echo "<div class='alert alert-danger'>There was an error insterting the user details in the database</div>";
} else {
    $message = "Please click on this link to prove that you own this email: \n\n";
    $message .= "http://test.cristianchiaburu-blog.com/activatenewemail.php?email=" . urlencode($email) . "&newemail=". urlencode($newEmail) ."&key=$activationKey";

    if (mail($newEmail, 'Email update for Magna Notas', $message, 'From: ' . 'administrator@magnat.co.md')) {
        echo "<div class='alert alert-success'>An email has been sent to $newEmail. Please click on the link to reset your email.</div>";
    } else {
        echo "<div class='alert alert-danger'>Couldn't send the activation code. Please try again later.</div>";
    }
}
