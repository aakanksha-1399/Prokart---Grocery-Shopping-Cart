<?php

session_start();

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
/*
include(connection.php);
if($_SERVER['Request METHOD']=='POST')
*/
$username=$_POST['username'];
$password=$_POST['password'];

if ($conn->connect_error)
{
  die("Connection failed: " . $conn->connect_error);
}
 else
{
  $sql= "select * from signup where username='$username' AND  password= '$password'";
  $result = mysqli_query($conn,$sql);
  $check = mysqli_fetch_array($result);
  if(isset($check))
  {
    echo 'Success';
    //echo 'You have logged in';
    //header('Location: https://prokart.000webhostapp.com/signup.php');
    echo "<script>";
    echo "window.location.replace('https://prokart.000webhostapp.com/about.html');";
    echo "</script>";

//include("about.html");
   }
   else
   {
    echo "<script>";
    echo "window.location.replace('https://prokart.000webhostapp.com/login1.html');";
    echo "</script>";
    echo"Login Failure!!";
    // header("location:login.html");
  }
}
$conn->close();
?>