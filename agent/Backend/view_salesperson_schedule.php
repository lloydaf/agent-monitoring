<!DOCTYPE html>
<html>
<head>
	<title>Visit Statistics</title>
	<style>
table, th, td {
    border: 2px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}


</style>
</head>
<body>
<?php
include('../UI/header.html');
include('../Backend/connect.php');
$user=$_SESSION['username'];
$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
$user_details_query=mysqli_query($con,"SELECT * FROM user_details where username = '$user'");
$user_fetch_array=mysqli_fetch_array($user_details_query);
$row_no=mysqli_num_rows($query);
$row=mysqli_fetch_array($query);
if(isset($_POST['schedule_form'])){
$user_id=$_POST['schedule_form']	;
$username_salesperson_query=mysqli_query($con,"SELECT username from user_details where user_id = '$user_id'");
$username_salesperson_array=mysqli_fetch_array($username_salesperson_query);
$username_salesperson=$username_salesperson_array['username'];
if($user_fetch_array['level']=='admin'){
if($row_no==1){
?>
<table id="visit_table" style="width:100%">
<caption>Visits</caption>
<thead>
<tr class="heading">
	<th>Agent Name</th>
	<th>Scheduled on</th>
</tr>
</thead>
<tbody>
<?php 
$print_num_query=mysqli_query($con,"SELECT distinct contact_no FROM schedule WHERE username = '$username_salesperson'");
while($print_num_array=mysqli_fetch_array($print_num_query)){
	$print_name_query=mysqli_query($con," SELECT Agent_Name from agent_info where Contact_No = '".$print_num_array['contact_no']."'");
	$print_name_array=mysqli_fetch_array($print_name_query);
?>
<tr>
	<td><?php echo $print_name_array['Agent_Name'] ;?></td>
	<td><?php 
	$date_query=mysqLi_query($con,"SELECT visited_date from schedule where username = '$username_salesperson' and contact_no = '".$print_num_array['contact_no']."'");
	while($date_array=mysqli_fetch_array($date_query)){
	echo $date_array['visited_date']; ?><br><?php 
	}
?>
	</td>
</tr>	
<?php	
}
//end of while loop
?>
</tbody>
</table>
<br>
<button id="gobackbutton" class="float-left submit-button">Go Back</button>
	<script type="text/javascript">	
	document.getElementById("gobackbutton").onclick = function(){
		location.href= "../UI/sales_main.html";
	}
	</script>
<?php

}
else{
	header('Location: dashboard.php');
}
/*else redirect, row_no!=1*/
}
else{
	header('Location: dashboard.php');
}
/* else redirect, not admin*/
}
else{
	header('Location: dashboard.php');
}
/* else redirect, no post */
?>
<script>
	$(document).ready(function(){
		$('#salesperson_li').attr("class","active");
	});
</script>
</body>
</html>