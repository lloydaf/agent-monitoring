<?php include ('../UI/header.html');?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<title>Edit Agent Info</title>
</head>
<body>
<?php
include('../Backend/connect.php');
$ref_no=$_POST['hidden_edit_field'];
$query=mysqli_query($con,"SELECT * FROM agent_details WHERE agent_contact_number = '$ref_no'");
while($row=mysqli_fetch_array($query)){
?>
<form action='../Backend/enter_edit.php' method="post">
<p>Enter the information to be edited</p>
<p style="font-weight:bold">Agent Name:<span style="color:Red">*</span><br></p>
<input type="text" name="Agent_Name_form" value="<?php echo $row['agent_name']; ?>" pattern="[A-Za-z ]+" required="required" title="Enter the Agent Name in letters only">

<p style="font-weight:bold">Agent Address:<br></p>

<p>Address Line 1:<span style="color:Red">*</span><br></p>
<input type="text" name="Agent_Address_line1_form" value="<?php echo $row['add_line_1']; ?>" pattern="[A-Za-z0-9 -_()]+" required="required" title="Please enter valid address">

<p>Address Line 2:<br></p>
<input type="text" name="Agent_Address_line2_form" value="<?php echo $row['add_line_2']; ?>" pattern="[A-Za-z0-9 -_()]+" title="Enter the Agent Name in letters only">

<p>Street<br></p>
<input type="text" name="Agent_Address_street_form" value="<?php echo $row['add_street']; ?>" pattern="[A-Za-z0-9 -_()]+" title="Enter the Agent Name in letters only">

<p>Area:<span style="color:Red">*</span><br></p>
<input type="text" name="Agent_Address_Area_form" value="<?php echo $row['add_area']; ?>" pattern="[A-Za-z0-9 -_()]+" required="required" title="Enter the Agent Name in letters only">

<p>City:<span style="color:Red">*</span><br></p>
<input type="text" name="Agent_Address_City_form" value="<?php echo $row['add_city']; ?>" required="required" pattern="[A-Za-z]+" title="Please enter a valid city" value=0;>

<p style="font-weight:bold">Person of Contact:<span style="color:Red">*</span><br></p>
<input type="text" name="POC_form" value="<?php echo $row['agent_poc']; ?>" pattern="[A-Za-z ]+" required="required" title="Enter the Person of Contact's Name in letters only">

<p style="font-weight:bold">Contact Number:<span style="color:Red">*</span><br></p>
<p>+91  <input type="tel" maxlength="10" name="Contact_No_form" value="<?php echo $row['agent_contact_number']; ?>"pattern="\d{10}" required="required" title="Enter valid phone number"></p>


<p><input type="submit" value="Submit"></p>
</form>
<button id="MainMenuButton" class="float-left submit-button">Go Back</button>
<?php if(isset($_POST['flag_field'])){?>
<script type="text/javascript">
    document.getElementById("MainMenuButton").onclick = function () {
        location.href = "../UI/main.html";
    };
</script>	
<?php }

else{
	?>
<script type="text/javascript">
    document.getElementById("MainMenuButton").onclick = function () {
        location.href = "my_agents.php";
    };
    </script>
<?php }
 
if(isset($_POST['flag_field']))
	{?>
<script>
$(document).ready(function(){
 $("#database_li").attr("class","active"); });
</script>
<?php }
else{
 ?>
<script>
$(document).ready(function(){
 $("#my_agents_li").attr("class","active"); });
</script>

<?php } ?>
</body>
<?php }
 mysqli_close($con);
?>
</html>