<!DOCTYPE html>
<html>
<head>
<title>Your agents</title>
<style>
table, th, td {
    border: 2px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: center;
    font-family: sans-serif;

}
.inner
{
    display: inline-block;
    padding-right: 5px;
}
</style>

</head>
<body>
<?php
include('../UI/header.html');
include('../Backend/connect.php');
$user=$_SESSION["username"];
$query1=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
$row_no=mysqli_num_rows($query1);
if($row_no==1)
{


  if(!isset($_POST['agent_view_form']))
  {
    $user_id=$_SESSION['user_id'];
  }
  else 
  {
    $user_id=$_POST['agent_view_form'];
  }

  $query=mysqli_query($con,"SELECT * FROM agent_info where user_id = '$user_id'");
  $client_name=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM user_details where user_id = '$user_id'"));
  ?>
  <h1>Agents of <?php echo $client_name['first_name'].' '.$client_name['last_name']; ?></h1>
  <table id="maintable" style="width:100%">
    <caption>Agent Database</caption>
    <thead>
    <tr class="heading">
      <th>Agent Name</th>
      <th>Person of Contact</th>
      <th>Contact Number</th>
      <th>City</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    	<?php 
    	while($row = mysqli_fetch_array($query)){
    	?>
    	
      <tr>
      	<td><?php echo $row['Agent_Name'];?></a></td>
      	<td><?php echo $row['POC'];?></td>
      	<td><?php echo $row['Contact_No'];?></td>
      	<td><?php echo $row['City'];?></td>
      	<td>
          <div class="inner">
            <form action="../Backend/view_agent.php" method="post">
            <?php if(isset($_POST['agent_view_form'])){
              ?>
              <input type="hidden" name="flag_field" value="1">
            <?php } ?>
              <input type="hidden" name="hidden_field" value="<?php echo $row['Contact_No']; ?>">
              <input type="hidden" name="flag" value="1">
              <button class="float-left submit-button">Details
              </button>
            </form>
          </div>
        
          <div class="inner">
            <form action="../Backend/remove_from_my_agents.php" method="post">
            <?php if(isset($_POST['agent_view_form'])){
              ?>
              <input type="hidden" name="flag_field" value="1">
            <?php } ?>
              <input type="hidden" name="remove_field" value="<?php echo $row['Contact_No']; ?>">
              <button class="float-left submit-button">Remove
              </button>
            </form>
          </div>
        <?php if(!isset($_POST['agent_view_form'])){ ?>
          <div class="inner">
            <form action="../Backend/edit_agent.php" method="post">
              <input type="hidden" name="hidden_edit_field" value="<?php echo $row['Contact_No']; ?>">
              <button class="float-left submit-button">Edit
              </button>
            </form>
          </div>
          <div class="inner">
            <form action="../Backend/add_visit.php" method="post">
              <input type="hidden" name="visit_field" value="<?php echo $row['Contact_No']; ?>">
              <button class="float-left submit-button">Add Visit
              </button>
            </form>
          </div>
          <div class="inner">
            <form action="view_visits.php" method="post">
              <input type="hidden" name="contact_no_form" value="<?php echo $row['Contact_No'];?>">
              <input type="hidden" name="client_name_form" value="<?php echo $row['Agent_Name'];?>">
              <button class="float-left submit-button">View My Visits
              </button>
            </form>
          </div>
          <div class="inner">
            <form action="schedule_visit.php" method="post">
              <input type="hidden" name="schedule_visit_form" value="<?php echo $row['Contact_No'];?>">
              <button class="float-left submit-button">Schedule Visit
              </button>
            </form>
          </div>
          <div class="inner">
            <form action="view_scheduled.php" method="post">
              <input type="hidden" name="contact_no_form" value="<?php echo $row['Contact_No'];?>">
              <input type="hidden" name="client_name_form" value="<?php echo $row['Agent_Name'];?>">
              <button class="float-left submit-button">View Scheduled
              </button>
            </form>
          </div>
        <?php }?>
        </td>
      </tr>
      
    <?php
  	  }
  	  mysqli_close($con);
     ?>	
    </tbody>
  </table>
  <?php if(isset($_POST['agent_view_form'])){ ?>
  <script>
    $(document).ready(function()
    {
      $("#salesperson_li").attr("class","active"); 
    });
  </script>
<?php }
else{ ?>
  <script>
    $(document).ready(function()
    {
      $("#my_agents_li").attr("class","active"); 
    });
  </script>
<?php } ?>
  <br>
  <button id="MainMenuButton" class="float-left submit-button">Go Back</button>
  <?php 
  if(isset($_POST['value_form']))
  {
    ?>
    <script type="text/javascript">
      document.getElementById("MainMenuButton").onclick = function () 
      {
          location.href = "../UI/sales_main.html";
      }   
    </script>
    <?php 
  } 
  else 
  {
    ?>
    <script type="text/javascript">
        document.getElementById("MainMenuButton").onclick = function () 
        {
            location.href = "dashboard.php";
        }   
    </script>
    <?php 
  } 
  ?>
<?php 
}
else
{
    ?>
  <script>
    window.location.replace('../UI/index.html');
  </script>
  <?php
}
?>  
</body>
</html>
