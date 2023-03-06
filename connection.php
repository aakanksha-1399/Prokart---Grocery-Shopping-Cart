<?php

$dbServername="localhost";
$dbusername="id11116619_admin";
$dbpassword="1234567890";
$dbname="id11116619_login";

$conn= new mysqli($dbServername,$dbusername,$dbpassword,$dbname);
if($conn->connect_error)
{
  die("Unable to connect to database");
}
echo"Connected";

?>