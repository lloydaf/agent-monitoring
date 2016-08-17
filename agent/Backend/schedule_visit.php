<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<title>Schedule a Visit</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script>
	  $(function() {
	    $('#datepicker').datepicker({ minDate: 0, dateFormat: 'yy-mm-dd' });
	  });
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
  margin: 2px;
  padding: 2px;
  font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
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
		button {
  padding: 5px;
  background-color: white;
  border: 1px solid black;

}
button:hover {background-color: #83E5FF;}
input#datepicker{
  border: 1px solid black;
  background-color: #F4F7F2;
}
	</style>
</head>

<body>
	<ul class="topnav">
	  <li><a id="dashboard_li" class="notactive" href="../Backend/dashboard.php">Dashboard</a></li>
	  <?php include('../Backend/connect.php');
if(isset($_SESSION["username"])){
$user=$_SESSION["username"];
$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
$row_no=mysqli_num_rows($query);
if($row_no==1){
$query_new=mysqli_query($con,"SELECT level from user_details where username = '$user'");
$arr=mysqli_fetch_array($query_new);
if($arr['level']=='admin'){
?>
  <li><a id="salesperson_li" class="notactive" href="../UI/sales_main.html">Salespeople</a></li>
<?php }}}  ?>  
	  <li><a id="database_li" class="notactive" href="../UI/main.html">Database</a></li>
	  <li><a id="my_agents_li" class="notactive" href="../Backend/my_agents.php">My Agents</a></li>
	  <li class="right"><a id="logout_li" href="../Backend/logout.php">Logout</a></li>
	</ul>
	<?php
	$user=$_SESSION["username"];
	$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
	$row_no=mysqli_num_rows($query);
	if($row_no==1)
	{
	$Contact_No=$_POST['schedule_visit_form'];
	?>
	<p>Enter the date to Schedule a Visit</p>
	<form action="schedule_enter.php" method="post">
		<input type="text" id="datepicker" name="date_form" required="required" pattern="^\d{4}-\d{2}-\d{2}$" title="Please enter a valid date">
		<input type="hidden" name="contact_no_form" value="<?php echo $Contact_No; ?>">
		<button class="float-left submit-button">Schedule</button>
	</form>
	<?php	
	}	
	?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#my_agents_li').attr("class","active");
	});
</script>	
</body>
</html>