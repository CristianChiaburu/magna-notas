<?php
session_start();
include('connection.php');

//logout
include('logout.php');

//remember me
include('remember.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Magna Notas</title>

    <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">

    <link rel='stylesheet' href='style.css' />



</head>

<body>

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style='z-index:100;'>
        <a class="navbar-brand" href="#">Magna Notas</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                
            </ul>
            <ul class='navbar-nav'>
                <li class='nav-item'><a href="#loginModal" class='nav-link' data-toggle='modal'>Login</a></li>
            </ul>



        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="jumbotron-container">
        <div class="jumbotron" id='myContainer'>
            <h1>Magna Notas</h1>
            <p>Keep your thoughts in place wherever you go</p>
            <p>Easy to use and store all your notes</p>
            <button type='button' class='btn btn-lg green signup text-light' data-toggle="modal" data-target="#signupModal">Sign up</button>
            <button type='button' class='btn btn-lg green signup text-light' data-toggle="modal" data-target="#loginModal">Log in</button>
        </div>
    </div>
    <!-- Login form -->
    <form method='post' id='loginform'>
        <div class="modal" tabindex="-1" role="dialog" id='loginModal'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Login message from PHP file (alert) -->
                        <div id="loginmessage"></div>
                        <!--  -->

                        <div class="form-group">
                            <label for="loginemail" class='sr-only'>Email:</label>
                            <input type="text" class='form-control' name='loginemail' id='loginemail' placeholder='Email' maxlength='50'>
                        </div>
                        <div class="form-group">
                            <label for="loginpassword" class='sr-only'>Password:</label>
                            <input type="password" class='form-control' name='loginpassword' id='loginpassword' placeholder='Password' maxlength='30'>
                        </div>
                        <div class="checkbox">
                            <label for="rememberme">
                                <input type="checkbox" name='rememberme' id='rememberme'>
                                Remember me
                            </label>
                            <a class='float-right' data-dismiss='modal' data-target='#forgotPasswordModal' data-toggle='modal' id='forgotPassword'>Forgot Password?</a>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-between">
                        <div class="left">
                            <button type="button" class="btn btn-primary text-light" data-dismiss="modal" data-target='signupModal' data-toggle='modal'>Signup</button>
                        </div>
                        <div class="right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input type="submit" class='btn btn-primary text-light' name='login' value='Login'>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>






    <!-- Signup form -->
    <form method='post' id='signupForm'>
        <div class="modal" tabindex="-1" role="dialog" id='signupModal'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Sign up today and start using Magna Notas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Sign up message from PHP file (alert) -->
                        <div id="signupmessage"></div>
                        <!--  -->
                        <div class="form-group">
                            <label for="username" class='sr-only'>Username:</label>
                            <input type="text" class='form-control' name='username' id='username' placeholder='Choose a username' maxlength='30'>
                        </div>
                        <div class="form-group">
                            <label for="email" class='sr-only'>Email:</label>
                            <input type="text" class='form-control' name='email' id='email' placeholder='Email Address' maxlength='50'>
                        </div>
                        <div class="form-group">
                            <label for="password" class='sr-only'>Password:</label>
                            <input type="password" class='form-control' name='password' id='password' placeholder='Choose a password' maxlength='30'>
                        </div>
                        <div class="form-group">
                            <label for="password2" class='sr-only'>Password:</label>
                            <input type="password" class='form-control' name='password2' id='password2' placeholder='Confirm password' maxlength='30'>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input type="submit" class='btn btn-primary text-light' name='signup' value='Sign up'>

                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Forgot password form -->
    <form method='post' id='forgotpasswordform'>
        <div class="modal" tabindex="-1" role="dialog" id='forgotPasswordModal'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Forgot Password? Enter your email address:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Forgot password message from PHP file (alert) -->
                        <div id="forgotpasswordmessage"></div>
                        <!--  -->

                        <div class="form-group">
                            <label for="forgotemail" class='sr-only'>Email:</label>
                            <input type="text" class='form-control' name='forgotemail' id='forgotemail' placeholder='Email' maxlength='50'>
                        </div>


                    </div>
                    <div class="modal-footer modal-footer-between">
                        <div class="left">
                            <button type="button" class="btn btn-primary text-light" data-dismiss="modal" data-target='signupModal' data-toggle='modal'>Signup</button>
                        </div>
                        <div class="right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input class='btn btn-primary text-white' name='forgotPassword' type='submit' value='Submit'>
                        </div>

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
    <script src='index.js'></script>

    <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script> -->
</body>

</html>