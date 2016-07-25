<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>

</head>
<body>
<?php
include('../UI/header.html');
include('../Backend/connect.php');
$user=$_SESSION["username"];
$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
$row_no=mysqli_num_rows($query);
if($row_no==1){
?>
<form action="change_pw_enter.php" method="post">
<p>Enter Current Password</p>
<input type="password" name="curr_pw_form">
<p>Enter New Password</p>
<input type="password" name="new_pw_form">
<p><button type="submit" value="submit">Submit</button></p>
</form>
<?php
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#dashboard_li').attr("class","active");
	});
</script>
</body>
</html>
