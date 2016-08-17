<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>
<?php
include('../Backend/connect.php');
$user=$_SESSION['username'];
if(isset($_POST['contact_no_form'])){

$contact_no=$_POST['contact_no_form'];
$date=$_POST['date_form'];
$feedback=$_POST['feedback_form'];
if($date!=null){
mysqli_query($con,"INSERT INTO schedule(contact_no,username,visited_date) VALUES('$contact_no','$user','$date')");
header('Location: my_agents.php');}
else{
	?>
	<script type="text/javascript">
	window.location.replace('error_show.php');
	</script>
	<?php

}
}

else{
	die("Invalid page");
	?>
	<button id="gobackbutton" class="float-left submit-button">Go Back</button>
	<script type="text/javascript">	
	document.getElementById("gobackbutton").onclick = function(){
		location.href= "dashboard.php";
	}
	</script>
	<?php
}
?>
</body>
</html>