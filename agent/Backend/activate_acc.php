<!DOCTYPE html>
<html>
<head>
	<title>Activation</title>
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
	if(isset($_POST['username_form'])){
		$user_field=$_POST['username_form'];
		mysqli_query($con,"UPDATE user_details set level='user' where username='$user_field'");
		mysqli_query($con,"DELETE from pending_requests where username='$user_field'");
		?>
		<script>
		window.location.replace("../Backend/dashboard.php");
		</script>
		<?php
	}
	else
		{
 ?>
<script type="text/javascript">
  alert("kindly login again.");
  window.location.replace("../index.html");
</script>
 <?php
 } 
	
}
else{
 ?>
<script type="text/javascript">
  alert("kindly login again.");
  window.location.replace("../index.html");
</script>
 <?php
 } 
?>
</body>
</html>
