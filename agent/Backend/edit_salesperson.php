<?php include('../UI/header.html');?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
</head>
<body>
<p>Enter details to be changed</p>
<form action="../Backend/edit_sales_enter.php" method="post">
<p>Enter Your details:</p>
<?php 
include('../Backend/connect.php');
$user=$_SESSION["username"];
$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
$row_no=mysqli_num_rows($query);
if(isset($_POST['hidden_edit_field'])){
if($row_no==1)
{	$user_id=$_POST['hidden_edit_field'];
	$user_query=mysqli_query($con,"SELECT * from user_details where user_id = '$user_id'");
	$user_array=mysqli_fetch_array($user_query);
?>
<p>First name<span style="color:red">*</span></p>
<input type="text" name="first_name_form" value="<?php echo $user_array['first_name']; ?> "pattern="[A-Za-z]+" required="required" title="Enter the first name in letters only">
<p>Last name<span style="color:red">*</span></p>
<input type="text" name="last_name_form" value="<?php echo $user_array['last_name']; ?> "pattern="[A-Za-z]+" required="required" title="Enter the last name in letters only">
<p>Region of Work<span style="color:red">*</span></p>
<input type="text" name="work_area_form" value="<?php echo $user_array['region_of_work']; ?> "pattern="[A-Za-z]+" required="required" title="Enter the area of work in letters only">
<input type="hidden" name="user_id_form" value="<?php echo $user_id; ?>">
<p><button type="submit" value="submit">Register</button></p>
<?php 
}
else{
	header('Location: dashboard.php');
}
}
else {
	header('Location: dashboard.php');
}
?>
</form>
<button id="gobackbutton" class="float-left submit-button">Go Back</button>
	<script type="text/javascript">	
	document.getElementById("gobackbutton").onclick = function(){
		location.href= "../UI/sales_main.html";
	}
	</script>
	<script>
	$(document).ready(function(){
		$('#salesperson_li').attr("class","active");
	});
</script>
</body>
</html>