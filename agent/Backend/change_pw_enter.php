<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
include('../Backend/connect.php');
session_start();
$user=$_SESSION["username"];
$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
$row_no=mysqli_num_rows($query);
if($row_no==1){
$curr_pw=md5($_POST['curr_pw_form']);
$new_pw=md5($_POST['new_pw_form']);
$pw_query=mysqli_query($con,"SELECT password from user_details where username = '$user'");
$pw_array=mysqli_fetch_array($pw_query);
if($pw_array['password']==$curr_pw){
	mysqli_query($con,"UPDATE user_details SET password='$new_pw' where username='$user'");
	?>
	<script type="text/javascript">
	alert('New Password set, kindly login');
window.location.replace("logout.php");
</script>
<?php	
}
else{
	?>
<script type="text/javascript">
alert('Incorrect Password');
window.location.replace('change_password.php');
</script>
<?php	
}
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