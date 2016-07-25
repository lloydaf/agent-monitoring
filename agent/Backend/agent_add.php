<?php
include('../Backend/connect.php');
$Agent_Name=$_POST["Agent_Name_form"];
$Agent_Address_line1=$_POST["Agent_Address_line1_form"];
$Agent_Address_line2=$_POST["Agent_Address_line2_form"];
$Agent_Address_street=$_POST["Agent_Address_street_form"];
$Agent_Address_Area=$_POST["Agent_Address_Area_form"];
$Agent_Address_City=$_POST["Agent_Address_City_form"];
$POC=$_POST["POC_form"];
$Contact_No='+91'.$_POST["Contact_No_form"];
mysqli_query($con,"INSERT INTO agent_details (agent_name,add_line_1,add_line_2,add_street,add_area,add_city,agent_poc,agent_contact_number,available_to_add) VALUES ('$Agent_Name','$Agent_Address_line1','$Agent_Address_line2','$Agent_Address_street','$Agent_Address_Area','$Agent_Address_City','$POC','$Contact_No','1')");
mysqli_query($con,"INSERT INTO agent_info(Agent_Name, POC, Contact_No, City, Available_to_add) VALUES('$Agent_Name','$POC','$Contact_No','$Agent_Address_City','1')");
mysqli_close($con);
header("Location: ../UI/entering_successful.html");
exit;
?>
