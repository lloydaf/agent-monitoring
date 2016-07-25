<html>
<head>
<title>Salesperson Details</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<style type="text/css">
table, th, td, {
    border: 2px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}

body{
		padding-left:1cm;
		font-family: sans-serif;
	}
	p1{
		font-weight: bold;
	}
	
</style>
</head>

<body>
<?php
include('../UI/header.html');
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
	<form action="view_salesperson_visits.php" method="post">
	<input type="hidden" name="user_id_form" value='<?php echo $user_id;?>'>
	<button type="submit" value="submit">View Visits of <?php echo $future; ?></button>
	</form>

	<script type="text/javascript">
	    document.getElementById("MainMenuButton").onclick = function () {
	        location.href = "../UI/sales_main.html";
	    }   
	</script>
	<form action="my_agents.php" method="post"><input type="hidden" name="agent_view_form" value="<?php echo $user_id; ?>">
	<input type="hidden" name="value_form" value="1">
	<button type="submit" value="submit">View Agents of <?php echo $future;?></button></form>
	<form action="view_salesperson_schedule.php" method="post"><input type="hidden" name="schedule_form" value="<?php echo $user_id;?>">
	<button type="submit" value="submit">View Scheduled Visits of <?php echo $future;?></button>
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
include('../UI/footer.html');
?>
</body>
</html>
