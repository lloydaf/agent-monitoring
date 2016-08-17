<?php include('../UI/header.html');?>
<!DOCTYPE html>
<html>
<head>
<title>Visits</title>
</head>
<body>
<?php
include('../Backend/connect.php');
$user=$_SESSION["username"];
$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
$row_no=mysqli_num_rows($query);
if($row_no==1)
{

$Contact_No=$_POST['contact_no_form'];
$future=$_POST['client_name_form'];

?>
<br><br>
<table id="visitstable" style="width:100%">
<caption><?php echo $future; ?>
<thead>
<tr class="heading">
	<th>Date of Visit</th>
	<?php 
	$query_level=mysqli_query($con,"SELECT * from user_details where username = '$user'");
	$array_level=mysqli_fetch_array($query_level);
	if($array_level['level']=='user'){?><th>Actions</th><?php } ?>

</tr>
</thead>
<tbody>

<?php 
$query_visit=mysqli_query($con,"SELECT * FROM schedule WHERE username = '$user' AND contact_no = '$Contact_No' ORDER BY visited_date DESC");
while($row = mysqli_fetch_array($query_visit)){
?>
<tr>
	<td><?php echo $row['visited_date']; ?></td>
	<?php if($array_level['level']=='user'){?><td>
	<form action="delete_schedule.php" method="post"><input type="hidden" name="username_form" value="<?php echo $user;?>"><input type="hidden" name="contact_form" value="<?php echo $Contact_No;?>"><input type="hidden" name="visited_date_form" value="<?php echo $row['visited_date'];?>"><button class="float-left submit-button">Delete Schedule</button>
	</form></td><?php } ?>
</tr>
<?php
}
?>
</tbody>
</table>
<p>
<button id="MainMenuButton" class="float-left submit-button">Go Back</button></p>
<script type="text/javascript">
    document.getElementById("MainMenuButton").onclick = function () {
        location.href = "../Backend/my_agents.php";
    }   
</script>
<?php
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
<script type="text/javascript">
	$(document).ready(function(){
		$('#my_agents_li').attr("class","active");
	});
</script>
</body>
</html>