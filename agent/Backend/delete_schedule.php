<!DOCTYPE html>
<html>
<head>
	<title>Deleting schedule</title>
</head>
<body>
<?php
include('../Backend/connect.php');
session_start();
$user=$_SESSION["username"];
$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
$row_no=mysqli_num_rows($query);
if($row_no==1)
{
	$userr=$_POST['username_form'];
	$contact=$_POST['contact_form'];
	$visited=$_POST['visited_date_form'];
	mysqli_query($con,"DELETE from schedule where contact_no='$contact' AND username='$userr' AND visited_date='$visited'");
?>
<script type="text/javascript">
	window.location.replace("my_agents.php");
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert("kindly login again");
window.location.replace("../UI/login.html");
</script>
<?php
}
?>
</body>
</html>