<?php

session_start();
include('connection.php');



$user_id = $_SESSION['user_id'];

// query to delete empty notes

$sql = "DELETE FROM notes WHERE note='' ";
$result = mysqli_query($link, $sql);

if (!$result) {
    echo "<div class='alert alert-danger'>An error occured!</div>";
    exit;
}

$sql = "SELECT * FROM notes where user_id = '$user_id' ORDER BY time DESC";
$result = mysqli_query($link, $sql);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $note_id = $row['id'];
            $note = $row['note'];
            $time = $row['time'];
            $time = date("F d, Y h:m:s", $time);
            echo
                "
                <div class=''>
                    
                    <div class='noteheader' id='$note_id'>
                        <div class=' delete'>
                            <button class='btn-lg btn-danger'>Delete</button>
                        </div>
                        <div>
                            <div class='text'>$note</div>
                            <div class='timetext'>$time</div>
                        </div>
                    </div>
                </div>
            ";
        }
    } else {
        echo "<div class='alert alert-info'>You have not created any notes yet.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>An error occured!</div>";
    exit;
}













