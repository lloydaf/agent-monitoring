<html>
<head>
<title>Agent Details</title>
<style type="text/css">
<style>
table, th, td, {
    border: 2px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}

body{
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
$Contact_No=$_POST["hidden_field"];
$user=$_SESSION['username'];
$query=mysqli_query($con,"SELECT * FROM agent_details WHERE agent_contact_number = '$Contact_No'");
while($row = mysqli_fetch_array($query)){
	$future=$row['agent_name'];
	echo '<p1>Agent Name:<br></p1>';
	echo '<p>'.$row['agent_name'].'<br>'.'</p>';
	echo '<p1>Agent ID:<br></p1>';
	echo '<p>'.$row['agent_id'].'</p>';
	echo '<p1>Address:<br></p1>';
	echo '<p>'.$row['add_line_1'].'</p>';
	echo '<p>'.$row['add_line_2'].'</p>';
	echo '<p>'.$row['add_street'].'</p>';
	echo '<p>'.$row['add_area'].'</p>';
	echo '<p>'.$row['add_city'].'</p>';
	echo '<p1>Person of Contact:<br></p1>';
	echo '<p>'.$row['agent_poc'].'<br>'.'</p>';
	echo '<p1>Agent Contact Number:<br></p1>';
	echo '<p>'.$Contact_No.'<br>'.'</p>';
	echo '<p1>Available to Add?<br></p1>';
	if($row['available_to_add']=='1'){
		echo '<p>Yes<br></p>';
	}
	else echo '<p>No<br></p>';
}
?>
<?php if(isset($_POST['flags_field'])){?>
<script>
$(document).ready(function(){
 $("#database_li").attr("class","active"); });
</script>
<?php }
else {if(!isset($_POST['flag_field'])){
?>
<script>
$(document).ready(function(){
 $("#my_agents_li").attr("class","active"); });
</script>
<?php }
else{?>
<script>
$(document).ready(function(){
 $("#database_li").attr("class","active"); });
</script>
<?php
}}
?>
<button id="MainMenuButton" class="float-left submit-button">Go Back</button>
<br>
<?php
if(isset($_POST['flag_field'])){ ?>
	<script type="text/javascript">
	    document.getElementById("MainMenuButton").onclick = function () {
	        window.location.replace("../UI/sales_main.html");
	    }   
	</script>
<?php 
}
else
 if(isset($_POST['flag'])){ ?>
	<script type="text/javascript">
	    document.getElementById("MainMenuButton").onclick = function () {
	        window.location.replace("my_agents.php");
	    }   
	</script>
<?php }
else{ ?>
	<script type="text/javascript">
    document.getElementById("MainMenuButton").onclick = function () {
        window.location.replace("../UI/main.html");
    }   
</script>
<?php
}
?>
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
