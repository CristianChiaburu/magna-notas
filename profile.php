<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

include('connection.php');
$user_id = $_SESSION['user_id'];

$sql =  "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
if ($count == 1) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $username = $row['username'];
    $email = $row['email'];
} else {
    echo "There was an error";
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Magna Notas - Profile</title>

    <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">

    <link rel='stylesheet' href='style.css' />



</head>

<body>

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Magna Notas</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="profile.php">Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="mainpageloggedin.php">My Notes</a>
                </li>
            </ul>
            <ul class='navbar-nav'>
                <li class='nav-item'><a href="#" class='nav-link'>Logged in as <b><?php echo $username ?></b></a></li>
                <li class='nav-item'><a href="index.php?logout=1" class='nav-link'>Logout</a></li>
            </ul>



        </div>
    </nav>

    <!-- Container -->
    <div class="container" id='container'>
        <div class="row">
            <div class="offset-lg-3 col-lg-6 acc-settings">
                <h2 class='text-center text-light'>General Account Settings:</h2>
                <div class="table-responsive">
                    <table class='table table-hover table-condensed table-bordered text-light'>
                        <tr data-target='#updateUsername' data-toggle='modal'>
                            <td>Username</td>
                            <td><?php echo $username ?></td>
                        </tr>
                        <tr data-target='#updateEmail' data-toggle='modal'>
                            <td>Email:</td>
                            <td><?php echo $email; ?></td>
                        </tr>
                        <tr data-target='#updatePassword' data-toggle='modal'>
                            <td>Password</td>
                            <td>hidden</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Username -->
    <form action="" method='post' id='updateusernameform'>
        <div class="modal fade" tabindex="-1" role="dialog" id='updateUsername'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Username</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- update username message from PHP file -->
                        <div id="updateusernamemessage"></div>


                        <div class="form-group">
                            <label for="username"><b>Username:</b></label>
                            <input type="text" class='form-control' name='username' id='username' maxlength='30' value='<?php echo $username ?>'>
                        </div>

                    </div>
                    <div class="modal-footer">


                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input class='btn btn-primary text-white' name='updateUsername' type='submit' value='Submit'>


                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Update Email -->
    <form action="" method='post' id='updateEmailForm'>
        <div class="modal fade" tabindex="-1" role="dialog" id='updateEmail'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div id="updateemailmessage"></div>

                        <div class="form-group">
                            <label for="email"><b>Email:</b></label>
                            <input type="text" class='form-control' name='email' id='email' maxlength='50' value='<?php echo $email; ?>'>
                        </div>

                    </div>
                    <div class="modal-footer">


                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input class='btn btn-primary text-white' name='updateEmail' type='submit' value='Submit'>


                    </div>
                </div>
            </div>
        </div>
    </form>


    
    <!-- Update Password -->
    <form action="" method='post' id='updatePasswordForm'>
        <div class="modal fade" tabindex="-1" role="dialog" id='updatePassword'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div id="updatepasswordmessage"></div>

                        <div class="form-group">
                            <label for="currentPassword" class='sr-only'><b>Your current password:</b></label>
                            <input type="password" class='form-control' name='currentPassword' id='currentPassword' maxlength='30' placeholder='Your Current Password'>
                        </div>
                        <div class="form-group">
                            <label for="password" class='sr-only'><b>Choose a Password:</b></label>
                            <input type="password" class='form-control' name='password' id='password' maxlength='30' placeholder='Choose a Password'>
                        </div>
                        <div class="form-group">
                            <label for="password2" class='sr-only'><b>Confirm Password:</b></label>
                            <input type="password" class='form-control' name='password2' id='password2' maxlength='30' placeholder='Confirm Password'>
                        </div>

                    </div>
                    <div class="modal-footer">


                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input class='btn btn-primary text-white' name='updateusername' type='submit' value='Submit'>


                    </div>
                </div>
            </div>
        </div>
    </form>













    <!-- Footer -->

    <div class="footer">
        <div class="container">
            <p class='text-light'>Cristian Chiaburu Copyright &copy; <?php $today = date('Y');
                                                                        echo $today; ?></p>
        </div>
    </div>








    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="profile.js"></script>


</body>

</html>