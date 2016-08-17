<?php include ('../UI/header.html');?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Salesperson Details</title>
</head>
<body>

<?php
include('../Backend/connect.php');
$user=$_SESSION["username"];
$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
$row_no=mysqli_num_rows($query);
if($row_no==1){
	$first_name=$_POST['first_name_form'];
	$last_name=$_POST['last_name_form'];
	$region_of_work=$_POST['work_area_form'];
	$user_id=$_POST['user_id_form'];
	mysqli_query($con,"UPDATE user_details SET first_name='$first_name', last_name='$last_name', region_of_work='$region_of_work' WHERE user_id = '$user_id'");
?>
<p>Successful! Click to go back!</p>
<script>
	$(document).ready(function(){
		$('#database_li').attr("class","active");
	});
</script>
<?php  }else {
	header('Location: dashboard.php');
	} ?>
<button id="gobackbutton" class="float-left submit-button">Go Back</button>
	<script type="text/javascript">	
	document.getElementById("gobackbutton").onclick = function(){
		location.href= "dashboard.php";
	}
	</script>
<?php mysqli_close($con);
?>	
	</body>
</html>