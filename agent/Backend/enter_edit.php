<?php include('../UI/header.html');?>
<DOCTYPE html>
<html>
<head>
<title>Entering Edited Information</title>
</head>
<body>
<?php
include('../Backend/connect.php');
$agent_name=$_POST['Agent_Name_form'];
$add_line_1=$_POST['Agent_Address_line1_form'];
$add_line_2=$_POST['Agent_Address_line2_form'];
$add_street=$_POST['Agent_Address_street_form'];
$add_area=$_POST['Agent_Address_Area_form'];
$add_city=$_POST['Agent_Address_City_form'];
$agent_poc=$_POST['POC_form'];
$agent_contact_number=$_POST['Contact_No_form'];
mysqli_query($con,"UPDATE `agent_details` SET `agent_name`='$agent_name',`add_line_1`='$add_line_1',`add_line_2`='$add_line_2',`add_street`='$add_street',`add_area`='$add_area',`add_city`='$add_city',`agent_poc`='$agent_poc',`agent_contact_number`='$agent_contact_number' WHERE `agent_contact_number`='$agent_contact_number'");
mysqli_query($con,"UPDATE `agent_info` SET `Agent_Name`='$agent_name',`POC`='$agent_poc',`Contact_No`='$agent_contact_number',`City`='$add_city' WHERE Contact_No='$agent_contact_number'");

mysqli_close($con);
?>
<p>Values updated successfully!<br></p>
<button id="MainMenuButton" class="float-left submit-button">Main Menu</button>
<script type="text/javascript">
    document.getElementById("MainMenuButton").onclick = function () {
        location.href = "../Backend/dashboard.php";
    };
</script>
</body>
</html>