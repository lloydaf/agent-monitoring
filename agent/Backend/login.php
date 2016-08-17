<?php session_start();?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<?php
include('../Backend/connect.php');
$user=$_POST['username_form'];
$pass=$_POST['password_form'];
$pass_enter=md5($pass);
$flag=0;
$query=mysqli_query($con,"SELECT * FROM user_details WHERE username='$user'");
$no_rows=mysqli_num_rows($query);
if($no_rows==1){
while($row=mysqli_fetch_array($query)){
	if($row['level']=='admin'|| $row['level']=='user')
	{
	if($row['password']==$pass_enter){
		$user_id= $row['user_id'];
		mysqli_query($con,"INSERT INTO live_sessions(username) VALUES('$user')");
		mysqli_close($con);
		$_SESSION['username']=$user;
		$_SESSION['user_id']=$user_id;
		} 	
	else
		{
		?>
		<script type="text/javascript">
		alert("Invalid username or password. Please try again.");
		window.location.replace("../UI/login.html");
		</script>
		<?php	
		}
	}
	else{
		?>
		<script type="text/javascript">
		alert('Your account has not been activated yet. Kindly contact customer support.');
		window.location.replace("../UI/login.html");
		</script>
	<?php	

	}
}
}
else
	{
	?>
	<script type="text/javascript">
	alert("Invalid username or password. Please try again.");
	window.location.replace("../UI/login.html");
	</script>
	<?php	
		}
?>

		<script type="text/javascript">
		window.location.replace('redirect_dashboard.php');
		</script>
</body>
</html>