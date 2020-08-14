<!--This file receives the user_id and key generated to create the new password-->
<!--This file displays a form to input new password-->

<?php
session_start();
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Reset</title>
    <link href="style.css" rel="stylesheet">
    <style>
        .resetpassword {
            background: rgba(255, 255, 255, 0.8);
            transform: translateY(50%);
            padding: 30px 10px;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row text-primary text-center">
            <div class=" offset-md-3 col-md-6 offset-lg-4  col-lg-4 resetpassword">
                <h1>Reset Password:</h1>
                <div id="resultmessage"></div>
                <?php
                //If user_id or key is missing
                if (!isset($_GET['user_id']) || !isset($_GET['key'])) {
                    echo '<div class="alert alert-danger">There was an error. Please click on the link you received by email.</div>';
                    exit;
                }
                //else
                //Store them in two variables
                $user_id = $_GET['user_id'];
                $key = $_GET['key'];
                $time = time() - 86400;
                //Prepare variables for the query
                $user_id = mysqli_real_escape_string($link, $user_id);
                $key = mysqli_real_escape_string($link, $key);
                //Run Query: Check combination of user_id & key exists and less than 24h old
                $sql = "SELECT user_id FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND time > '$time' AND status='pending'";
                $result = mysqli_query($link, $sql);
                if (!$result) {
                    echo '<div class="alert alert-danger">Error running the query!</div>';
                    exit;
                }
                //If combination does not exist
                //show an error message
                $count = mysqli_num_rows($result);
                if ($count !== 1) {
                    echo '<div class="alert alert-danger">Please try again.</div>';
                    exit;
                }
                //print reset password form with hidden user_id and key fields
                echo "
<form method=post id='passwordreset'>
<input type=hidden name=key value=$key>
<input type=hidden name=user_id value=$user_id>
<div class='form-group'>
    <label for='password' class='sr-only'>Enter your new Password:</label>
    <input type='password' name='password' id='password' placeholder='Enter Password' class='form-control'>
</div>
<div class='form-group'>
    <label for='password2 'class='sr-only'>Re-enter Password::</label>
    <input type='password' name='password2' id='password2' placeholder='Re-enter Password' class='form-control'>
</div>
<input type='submit' name='resetpassword' class='btn btn-primary text-white btn-lg' value='Reset Password'>


</form>
";


                ?>

            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <p class='text-light'>Cristian Chiaburu Copyright &copy; <?php $today = date('Y');
                                                                        echo $today; ?></p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src='index.js'></script>
    <!--Script for Ajax Call to storeresetpassword.php which processes form data-->
    <script>
        //Once the form is submitted
        $("#passwordreset").submit(function(event) {
            //prevent default php processing
            event.preventDefault();
            //collect user inputs
            var datatopost = $(this).serializeArray();
            //    console.log(datatopost);
            //send them to signup.php using AJAX
            $.ajax({
                url: "storeresetpassword.php",
                type: "POST",
                data: datatopost,
                success: function(data) {

                    $('#resultmessage').html(data);
                },
                error: function() {
                    $("#resultmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");

                }

            });

        });
    </script>
</body>

</html>