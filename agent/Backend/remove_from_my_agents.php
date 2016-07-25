<!DOCTYPE html>
<html>
<head>
	<title>Removing</title>
</head>
<body>
<?php
include('../Backend/connect.php');
session_start();
$user=$_SESSION["username"];
$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
$row_no=mysqli_num_rows($query);
if($row_no==1){
	$contact_no=$_POST['remove_field'];
	mysqli_query($con,"UPDATE agent_info SET user_id='0', Available_to_add='1' WHERE Contact_No='$contact_no'");
	mysqli_query($con,"UPDATE agent_details SET available_to_add='1', user_id='0', where agent_contact_number='$contact_no'");

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