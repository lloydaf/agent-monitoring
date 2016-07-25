<?php
include('../Backend/connect.php');
session_start();
$user_id=$_SESSION['user_id'];
$contact_no=$_POST['hidden_my_agents_field'];
$flag_query=mysqli_query($con,"SELECT user_id from agent_info where Contact_No = '$contact_no'");
$flag_array=mysqli_fetch_array($flag_query);
if($flag_array['user_id']==0){
mysqli_query($con,"UPDATE agent_info SET user_id='$user_id', Available_to_add='0' WHERE Contact_No = '$contact_no'");
mysqli_query($con,"UPDATE agent_details SET user_id='$user_id', available_to_add='0' WHERE agent_contact_number = '$contact_no'");
?>
<script type="text/javascript">
window.location.replace("../UI/main.html");
</script>
<?php
}
else{
	?>
	<script type="text/javascript">
	alert("Sorry, agent was already added");
	window.location.replace("../UI/main.html");
	</script>
	<?php
}
mysqli_close($con);
?>