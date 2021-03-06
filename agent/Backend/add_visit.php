<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Add visit</title>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script>
$(document).ready(function(){
 $("#my_agents_li").attr("class","active"); });
  $(function() {
    $('#datepicker').datepicker({ minDate: -2, maxDate: 0, dateFormat: 'yy-mm-dd' });
  });
  </script>
  <style type="text/css">
  	textarea {
  		width: 300px;
  		height:100px;
   
  	}
  </style>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
input#datepicker{
  border: 1px solid black;
  background-color: #F4F7F2;
}
button {
  padding: 5px;
  background-color: white;
  border: 1px solid black;

}
button:hover {background-color: #83E5FF;}
textarea {
  border: 1px solid black;
  background-color: #F4F7F2;
}
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

  <li><a id="database_li" class="notactive" href="../UI/main.html">Database</a></li>
  <?php }}} ?>  
  <li><a id="my_agents_li" class="notactive" href="../Backend/my_agents.php">My Agents</a></li>
  <li class="right"><a id="logout_li" href="../Backend/logout.php">Logout</a></li>
</ul>

<?php
if($row_no==1)
{
  $query_user_id=mysqli_query($con,"SELECT * from user_details where username= '$user'");
  $arr_user_id=mysqli_fetch_array($query_user_id);
  $user_id=$arr_user_id['user_id'];
  $agent_list_query=mysqli_query($con,"SELECT Contact_No, Agent_Name from agent_info WHERE user_id='$user_id'");
  
  
?>
<p>Select date:<span style="color:red">*</span></p>
<form id="date_form" action="visit_enter.php" method="post">
<p><input type="text" id="datepicker" name="date_form" required="required" pattern="^\d{4}-\d{2}-\d{2}$" title="Please enter a valid date"></p>
<p>Agent:<span style="color:red">*</span></p>
<select name="contact_no_form" class="agent_list_class" id="agent_list">
</select>
<p>Feedback from visit:<span style="color:red">*</span></p>
<textarea name="feedback_form" form="date_form" required="required"></textarea><br>
<button id="submit_button" class="float-left submit-button" value="submit">Submit</button>
</form>
<br>
<button type="float-left submit-button" id="backbutton">Go Back</button>
<script type="text/javascript">
var list='<option value="0" selected="selected">Select Agent</option>';
<?php while($agent_list_arr=mysqli_fetch_array($agent_list_query,MYSQL_ASSOC))
{ ?>
var values=<?php echo json_encode($agent_list_arr['Agent_Name']); ?>;
var keys=<?php echo json_encode($agent_list_arr['Contact_No']); ?>;
list+='<option value="' + keys + '" > ' + values + '</option>';
<?php } ?>
$('#agent_list').html(list); 
$('#backbutton').click(function(){
  window.location.replace('../Backend/dashboard.php');
});
</script>

<?php
}
else
{
 ?>
<script type="text/javascript">
  alert("kindly login again.");
  window.location.replace("index.html");
</script>
 <?php
 } 
 include('../UI/footer.html');
 ?>
 </body>
 </html>