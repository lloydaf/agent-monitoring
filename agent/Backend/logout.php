<?php
session_start();
include('../Backend/connect.php');
$var=$_SESSION['username'];
echo $var;
mysqli_query($con,"DELETE FROM live_sessions WHERE username = '$var'");
session_destroy();
header('Location: ../UI/index.html');
?>