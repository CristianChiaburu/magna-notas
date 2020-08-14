<?php
//<!--Start session-->
session_start();
include('connection.php');

//<!--Check user inputs-->
//    <!--Define error messages-->
$missingUsername = '<p><strong>Please enter a username!</strong></p>';
$missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
$missingPassword = '<p><strong>Please enter a Password!</strong></p>';
$invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
$differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
$missingPassword2 = '<p><strong>Please confirm your password</strong></p>';
//    <!--Get username, email, password, password2-->
//Get username
if (empty($_POST["username"])) {
    $errors .= $missingUsername;
} else {
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
}
//Get email
if (empty($_POST["email"])) {
    $errors .= $missingEmail;
} else {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors .= $invalidEmail;
        exit;
    }
}
//Get passwords
if (empty($_POST["password"])) {
    $errors .= $missingPassword;
} else if (!(strlen($_POST["password"]) > 6
    and preg_match('/[A-Z]/', $_POST["password"])
    and preg_match('/[0-9]/', $_POST["password"]))) {
    $errors .= $invalidPassword;
} else {
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    if (empty($_POST["password2"])) {
        $errors .= $missingPassword2;
    } else {
        $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
        if ($password !== $password2) {
            $errors .= $differentPassword;
        }
    }
}
//If there are any errors print error
if ($errors) {
    $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
    echo $resultMessage;
    exit;
}

//no errors

// Prepare variables for the queries

$username = mysqli_real_escape_string($link, $username);
$email = mysqli_real_escape_string($link, $email);
$password = mysqli_real_escape_string($link, $password);
// $password = md5($password);
$password = hash('sha256', $password);

// if username exists already
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($link, $sql);
if (!$result) {
    echo "<div class='alert alert-danger'>Error running the query!" . mysqli_error($sql) . "</div>";
    exit;
}
$results = mysqli_num_rows($result);
if ($results) {
    echo "<div class='alert alert-danger'>That username is already taken!</div>";
    // echo "<div class='alert alert-danger'>" . mysqli_error($link) ."</div>";
    exit;
}

// if email already exists
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if (!$result) {
    echo "<div class='alert alert-danger'>Error running the query!" . mysqli_error($sql) . "</div>";
    exit;
}
$results = mysqli_num_rows($result);
if ($results) {
    echo "<div class='alert alert-danger'>That email is already taken!</div>";
    exit;
}

// Create an unique activation code
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));

// Insert user details and activation code in the users table
$sql = "INSERT INTO users (`username`, `email`, `password`, `activation`) VALUES ('$username', '$email', '$password', '$activationKey')";
$result = mysqli_query($link, $sql);
if (!$result) {
    echo "<div class='alert alert-danger'>There was an error inserting the user details in the database</div>";
    exit;
}
// Send the user an email with a link to activate.php with their email and activation code
$message = "Please click on this link to activate your account: \n\n";
$message .= "http://test.cristianchiaburu-blog.com/activate.php?email=" . urlencode($email) . "&key=$activationKey";

if (mail($email, 'Confirm your registration', $message, 'From: ' . 'administrator@magnat.co.md')) {
    echo "<div class='alert alert-success'>Thank you for registring! A confirmation email has been sent to $email.</div>";
} else {
    echo "<div class='alert alert-danger'>Couldn't send the activation code. Please try again later.</div>";
}
