<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<style>
	div {
	width: 1272px;
	height: 48px;
	background-color: #333;
}
table{
  background-color: #F1F4F5;

}

.heading{
  text-align: center;
  font-size: 20px;
}
h1{
  text-align: center;
}
tr.heading:hover {background-color: #F1F4F5;}
tr:hover {background-color: #B5FC94;}
button {
  padding: 5px;
  background-color: white;
  border: 1px solid black;

}
button:hover {background-color: #83E5FF;}
body {
  margin: 2px;
  padding: 2px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
}
.inner {
  padding: 5px;
}
ul.topnav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

ul.topnav li {float: left;}

ul.topnav li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
ul.topnav li a:hover:not(.active) {background-color: #111;}

ul.topnav li a.active {background-color: #4CAF50;}

ul.topnav li.right {float: right;}

@media screen and (max-width: 600px){
    ul.topnav li.right,
    ul.topnav li {float: none;}
}
</style>
</head>
<body>
<div></div>
<?php
include('../Backend/connect.php');
$user=$_POST['username_form'];
$pass=$_POST['password_form'];
$pass_enter=md5($pass);
$first_name=$_POST['first_name_form'];
$last_name=$_POST['last_name_form'];
$region_of_work=$_POST['work_area_form'];
$username_dupli_query=mysqli_query($con,"SELECT username from user_details");
while($username_dupli_array=mysqli_fetch_array($username_dupli_query)){
	if($username_dupli_array['username']==$user){
		?>
		<script type="text/javascript">
		alert("Sorry, username already taken, kindly try again..");
		window.location.replace('../UI/register.html');
		</script>
		<?php
	}
}
mysqli_query($con,"INSERT into user_details(username,password,first_name,last_name,region_of_work) VALUES('$user','$pass_enter','$first_name','$last_name','$region_of_work')");
mysqli_query($con,"INSERT INTO pending_requests VALUES('$user')");
mysqli_close($con);
?>
<p>Registration Successful! Click to go back.</p>
<button id="mainmenubutton" class="float-left submit-button">Main Menu</button>
<script type="text/javascript">
	document.getElementById("mainmenubutton").onclick = function(){
		location.href = "../UI/index.html"
	}
</script>
<?php //include('../UI/footer.html');?>
</body>
</html>