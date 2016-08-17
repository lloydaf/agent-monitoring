<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Removing</title>
</head>
<body>
<?php
include('../Backend/connect.php');
$user=$_SESSION["username"];
$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
$row_no=mysqli_num_rows($query);
if($row_no==1){
	$contact_no=$_POST['remove_field'];
	mysqli_query($con,"DELETE from agent_info WHERE Contact_No='$contact_no'");
	mysqli_query($con,"DELETE from agent_details where agent_contact_number='$contact_no'");

if(isset($_POST['flag_field'])){?>
<script type="text/javascript">
window.location.replace('../UI/sales_main.html');
</script>
<?php }
else{?>
<script type="text/javascript">
window.location.replace('my_agents.php');
</script>
<?php
}	
}
else
{
die("Invalid page");
?>
	<button id="gobackbutton" class="float-left submit-button">Go Back</button>
	<script type="text/javascript">	
	document.getElementById("gobackbutton").onclick = function(){
		location.href= "dashboard.php";
	}
	</script>
	<?php
	mysqli_close($con);
}
?>
</body>
</html>