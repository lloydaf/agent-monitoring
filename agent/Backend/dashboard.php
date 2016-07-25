<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
</head>
<body>
<?php
include ('../UI/header.html');
include('../Backend/connect.php');
$user=$_SESSION['username'];
$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
$user_details_query=mysqli_query($con,"SELECT * FROM user_details where username = '$user'");
$user_fetch_array=mysqli_fetch_array($user_details_query);
$row_no=mysqli_num_rows($query);
$row=mysqli_fetch_array($query);
if($user_fetch_array['level']=='admin'){
    header('Location: dashboard_admin.php');
}
if($row_no==1)
{
?>
<h1>Welcome to Agent Database, <?php echo $user_fetch_array['first_name'].' '.$user_fetch_array['last_name']; ?></h1>
<p style="text-align:center;font-size:20px;">Click on the below buttons to navigate.</p>
<p style="font-weight:bold;">Agent Details:</p>
<p><button id="DatabaseButton" class="float-left submit-button" >Agent Database</button></p>
<p><button id="AddAgentButton" class="float-left submit-button" >Add Agent</button></p>
<p><button id="MyAgentsButton" class="float-left submit-button" >My Agents</button></p>
<p style="margin-top:1cm;font-weight:bold;">Settings:</p>
<p><button id="LogoutButton" class="float-left submit-button">Logout</button></p>
<p><button id="ChangePasswordButton" class="float-left submit-button">Change Password</button></p>
<script type="text/javascript">
document.getElementById("ChangePasswordButton").onclick = function() {
    location.href="change_password.php";
}
    document.getElementById("DatabaseButton").onclick = function () {
        location.href = "../UI/main.html";
    }
    document.getElementById("AddAgentButton").onclick = function () {
    	location.href = "../UI/agent_add.html";
    }
    document.getElementById("LogoutButton").onclick = function () {
    	location.href = "logout.php";
    }
    document.getElementById("MyAgentsButton").onclick = function () {
    	location.href = "my_agents.php";
    }
</script>
<script>
$(document).ready(function(){
 $("#dashboard_li").attr("class","active"); });
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert("kindly login again");
window.location.replace("../UI/login.html");
</script>
<?php
}
include('../UI/footer.html');
?>
</body>
</html>
