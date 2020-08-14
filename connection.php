<?php

$link = mysqli_connect('localhost', 'cristian_MagnaNotas','Cristian151928456', 'cristian_MagnaNotas');


if(mysqli_connect_error($link)){
    die('ERROR: Unable to connect to database: ' . mysqli_connect_error($link));
}

?>