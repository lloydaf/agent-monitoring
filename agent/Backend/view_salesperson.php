<?php include('../UI/header.html');?>
<html>
<head>
<title>Salesperson Details</title>
</head>
<body>
<?php
$future="";
include('../Backend/connect.php');
if(isset($_POST['hidden_field']))
{
	$user_id=$_POST["hidden_field"];
	$user=$_SESSION['username'];
	$query=mysqli_query($con,"SELECT * FROM user_details WHERE user_id = '$user_id'");
	while($row = mysqli_fetch_array($query)){
		$future=$row['first_name'].' '.$row['last_name'];
		echo '<p1>Salesperson Name:<br></p1>';
		echo '<p>'.$row['first_name'].' '.$row['last_name'].'<br>'.'</p>';
		echo '<p1>Region of Work</p1>';
		echo '<p>'.$row['region_of_work'].'<br></p1>';
		}

	?>
	<button id="MainMenuButton" class="float-left submit-button">Go Back</button>
	<br>
	<?php /*
	<form action="view_salesperson_visits.php" method="post">
	<input type="hidden" name="user_id_form" value='<?php echo $user_id;?>'>
	<button type="submit" value="submit">View Visits of <?php echo $future; ?></button>
	</form> */ ?>

	<script type="text/javascript">
	    document.getElementById("MainMenuButton").onclick = function () {
	        location.href = "../UI/sales_main.html";
	    }   
	</script>
	<form action="my_agents.php" method="post"><input type="hidden" name="agent_view_form" value="<?php echo $user_id; ?>">
	<input type="hidden" name="value_form" value="1">
	<button type="submit" value="submit">View Agents of <?php echo $future;?></button></form>
		<?php /*

	<form action="view_salesperson_schedule.php" method="post"><input type="hidden" name="schedule_form" value="<?php echo $user_id;?>">
	<button type="submit" value="submit">View Scheduled Visits of <?php echo $future;?></button></form> */?>
	<?php 
if(isset($_POST['flag_field']))
	{
			?>
			<script>
		$(document).ready(function(){
		 $("#salesperson_li").attr("class","active"); });
		</script>
		<?php
	}?>

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
</body>
</html>
