<!DOCTYPE html>
<html>
<head>
<title>Visits</title>
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
	<th>Feedback</th>
</tr>
</thead>
<tbody>

<?php 
$query_visit=mysqli_query($con,"SELECT * FROM visit WHERE username = '$user' AND contact_no = '$Contact_No' ORDER BY visited_date DESC");
while($row = mysqli_fetch_array($query_visit)){
?>
<tr>
	<td><?php echo $row['visited_date']; ?></td>
	<td><?php echo $row['feedback']; ?></td>
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
        location.href = "my_agents.php";
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
}	
	mysqli_close($con);
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#my_agents_li').attr("class","active");
	});
</script>
</body>
</html>