<?php
session_start();
session_destroy();
    echo "<script>";
    echo "window.location.replace('https://prokart.000webhostapp.com/login.html');";
    echo "</script>";

//header("location: index.php");
?>