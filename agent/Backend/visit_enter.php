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
if($contact_no==0)
{
	?><script>
		alert('Invalid option. Please select again!');
		window.location.replace('../Backend/add_visit.php');
	</script><?php
}
$date=$_POST['date_form'];
$feedback=$_POST['feedback_form'];
if($date!=null){
mysqli_query($con,"INSERT INTO visit(contact_no,username,visited_date,feedback) VALUES('$contact_no','$user','$date','$feedback')");
header('Location: ../Backend/add_visit.php');}
else{
	?>
	<script type="text/javascript">
	alert("Invalid Date! Please re-enter");
	window.location.replace('my_agents.php');
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