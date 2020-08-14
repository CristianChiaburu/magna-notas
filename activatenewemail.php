<?php

session_start();
include('connection.php');



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magna Notas - Reset Email</title>
    <link rel='stylesheet' href='style.css' />
</head>

<body>
    <div class="container text-primary text-center">
        <div class="row">
            <div class="offset-lg-1 col-lg-10">
                <h1>Reset Email</h1>
                <?php
                // if email or activation key is missing
                if (!isset($_GET['email']) || !isset($_GET['key']) || !isset($_GET['newemail'])) {
                    echo "<div class='alert alert-danger'>There was an error. Please click on the link you received by email.</div>";
                    exit;
                }
                $newEmail = $_GET['newemail'];
                $email = $_GET['email'];
                $key = $_GET['key'];

                $email = mysqli_real_escape_string($link, $email);
                $key = mysqli_real_escape_string($link, $key);
                $newEmail = mysqli_real_escape_string($link, $newEmail);


                $sql = "UPDATE users SET email = '$newEmail', activation2 = '0'  WHERE(email = '$email' AND activation2 = '$key') LIMIT 1";
                $result = mysqli_query($link, $sql);

                if (mysqli_affected_rows($link) == 1) {
                    session_destroy();
                    setcookie("rememberme", "", time() - 3600);
                    echo "<div class='alert alert-info'>Your email has been updated.</div>";
                    echo "<a href='index.php' type= 'button' class='btn-lg btn-primary'>Log in</a>";
                } else {
                    echo "<div class='alert alert-danger'>Your email could not be updated. Please try again later.</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>