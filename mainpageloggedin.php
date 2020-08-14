<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("location: index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Magna Notas - My notes</title>

  <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
  <link rel='stylesheet' href='style.css' />
  <style>
    .noteheader {
      border: 1px solid #7fb174;
      background: rgba(255, 255, 255, .8);
      /* background: linear-gradient(to right top, rgba(255,255,255,.7), rgba(127,177,116, 0.7)); */
      padding: 2px 10px;
      margin-bottom: 10px;
      cursor: pointer;
      display: flex;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }

    .text {
      font-size: 20px;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }

    .timetext {
      font-size: 13px;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      font-style: italic;

    }
    .delete{
      display:none;
      margin: 0 8px 0 0;
    }
  </style>



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
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        
        <li class="nav-item active">
          <a class="nav-link" href="#">My Notes</a>
        </li>
      </ul>
      <ul class='navbar-nav'>
        <li class='nav-item'><a href="#" class='nav-link'>Logged in as <b><?php echo $_SESSION['username']?></b></a></li>
        <li class='nav-item'><a href="index.php?logout=1" class='nav-link'>Logout</a></li>
      </ul>



    </div>
  </nav>

  <!-- Container -->
  <div class="container" id='container'>
    <!-- Alert message -->
    <div class="alert alert-danger collapse" id='alert'>
      <a class='close' data-dismiss='alert'>
        &times;
      </a>
      <p id='alertContent'></p>
    </div>
    <div class="row">
      <div class="offset-lg-3 col-lg-6">
        <div class='mb-4'>
          <button id="addNote" type='button' class='btn btn-primary text-white'>Add Note</button>
          <button id="allNotes" type='button' class='btn btn-primary text-white'>All Notes</button>

          <button id="done" type='button' class='btn btn-info text-white float-right'>Done</button>
          <button id="edit" type='button' class='btn btn-info text-white float-right'>Edit</button>
        </div>
        <div id="notePad">
          <textarea rows='10' class='form-control'></textarea>
        </div>
        <div id="notes" class='notes'>
          <!-- Ajax call to a php file -->
        </div>
      </div>
    </div>
  </div>


  <!-- Footer -->

  <div class="footer">
    <div class="container">
      <p class='text-light'>Cristian Chiaburu Copyright &copy; <?php $today = date('Y');
                                                                echo $today; ?></p>
    </div>
  </div>







  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="mynotes.js"></script>


</body>

</html>