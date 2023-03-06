<?php
/*
$dbServername="localhost";
$dbusername="id11116619_admin";
$dbpassword="1234567890";
$dbname="id11116619_login";
$conn= new mysqli($dbServername,$dbusername,$dbpassword,$dbname);
if($conn->connect_error)

{
  die("Unable to connect to database");
}
 echo "Connected Successfully!!";
*/

$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$query    = "INSERT INTO signup VALUES ('$username','$password', '$email', '$phone')";

$result   = $conn->query($query);
if ($result)
{
    //echo 'Insertion success';
    echo "<script>";
    echo "window.location.replace('https://prokart.000webhostapp.com/about.html');";
    echo "</script>";
    
}
else
{
    echo "<script>";
    echo "window.location.replace('https://prokart.000webhostapp.com/login1.html');";
    echo "</script>";   
 // die ("Insertion Failed");
}
$result->close();
$conn->close();
?>
