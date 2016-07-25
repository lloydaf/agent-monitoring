<!DOCTYPE html>
<html>
<head>
	<title>Administrator Dashboard</title>
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
?>
<h1>Welcome to Agent Database, <?php echo $user_fetch_array['first_name'].' '.$user_fetch_array['last_name']; ?></h1>
<p style="font-weight:bold;">Salesperson Details:</p>
<p><button id="viewsalespersonbutton" class="float-left submit-button">View Salesperson Info</button></p>
<p><button id="activatesalespersonbutton" class="float-left submit-button">Activate Salesperson Account</button></p>
<p style="font-weight:bold;">Agent Details:</p>
<p><button id="viewagentdatabase" class="float-left submit-button">View Agent Database</button></p>
<p><button id="addagentbutton" class="float-left submit-button">Add Agent</button></p>
<p><button id="myagentsbutton" class="float-left submit-button">My Agents</button></p>
<p style="font-weight:bold;">Settings:</p>
<p><button id="logoutbutton" class="float-left submit-button">Logout</button></p>
<p><button id="ChangePasswordButton" class="float-left submit-button">Change Password</button></p>
<script type="text/javascript">
    document.getElementById("ChangePasswordButton").onclick = function() {
        location.href="change_password.php";
    }
    document.getElementById("activatesalespersonbutton").onclick = function(){
        location.href="pending_requests.php";
    }
document.getElementById("viewsalespersonbutton").onclick = function () {
    	location.href = "../UI/sales_main.html";
    }
    document.getElementById("viewagentdatabase").onclick = function () {
        location.href = "../UI/main.html";
    }
    document.getElementById("addagentbutton").onclick = function () {
    	location.href = "../UI/agent_add.html";
    }
    document.getElementById("logoutbutton").onclick = function () {
    	location.href = "logout.php";
    }
    document.getElementById("myagentsbutton").onclick = function () {
    	location.href = "my_agents.php";
    }
    $(document).ready(function(){
    $('#dashboard_li').attr('class','active'); });
</script>
<?php include('../UI/footer.html');?>
</body>
</html>
