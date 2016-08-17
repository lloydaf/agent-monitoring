<?php include('../UI/header.html');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Visit Statistics</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<style type="text/css">
		table
		{
			background-color: #F1F4F5;
		}
		caption
		{
			text-align: center;
			font-weight: bold;
			font-size: 20px;
		}
		table, th, td 
		{
		    border: 2px solid black;
		    border-collapse: collapse;
		}
		th, td 
		{
		    padding: 5px;
		    text-align: left;
		}
	</style>
	<script>
		$(document).ready(function(){
			$("#salesperson_li").attr("class","active");
		});
	</script>
</head>
<body>
	<?php
	include('../Backend/connect.php');
	$user=$_SESSION['username'];
	$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
	$user_details_query=mysqli_query($con,"SELECT * FROM user_details where username = '$user'");
	$user_fetch_array=mysqli_fetch_array($user_details_query);
	$row_no=mysqli_num_rows($query);
	$row=mysqli_fetch_array($query);
	if($user_fetch_array['level']=='admin')
	{
		if($row_no==1)
		{
			$salesperson_list_query=mysqli_query($con,"SELECT * from user_details where level = 'user'");
			?>
			<form id="choose_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<p>Select Salesperson</p>
			<select id="salesperson_list_select" name="salesperson">
			</select>
			<p></p>
			<p>From date:<span style="color:red">*</span></p>
			<p><input type="text" id="datepicker_start" name="date_form_from" required="required" pattern="^\d{4}-\d{2}-\d{2}$" title="Please enter a valid date"></p>
			<p>To date:<span style="color:red">*</span></p>
			<p><input type="text" id="datepicker_end" name="date_form_to" required="required" pattern="^\d{4}-\d{2}-\d{2}$" title="Please enter a valid date"></p>
			<input type="submit" value="submit">
			</form>
			<?php
			if(isset($_POST['salesperson'])&&!empty($_POST['salesperson']))
			{ 
				$username_salesperson=$_POST['salesperson'];
				$date_from=$_POST['date_form_from'];
				$date_to=$_POST['date_form_to'];
				?>
				<div id="all_table_div" style="display:none">
					<table id="all_table" style="width:100%">
						<caption>Visits</caption>
						<thead>
							<tr>
								<th>Salesperson Name</th>
								<th>Agent Name</th>
								<th>Visits</th>
								<th>Feedback</th>
							</tr>
						</thead>
						<tbody>	
							<?php
							$us_uni_qu=mysqli_query($con,"SELECT * FROM visit where visited_date between '$date_from' and '$date_to' order by username");
							while($us_uni_ar=mysqli_fetch_array($us_uni_qu))
							{
									$sp_name_q= mysqli_query($con,"SELECT first_name, last_name from user_details where username= '".$us_uni_ar['username']."'");
									$sp_name_a= mysqli_fetch_array($sp_name_q);
									$ag_name_q= mysqli_query($con,"SELECT agent_name from agent_details where agent_contact_number='".$us_uni_ar['contact_no']."'");
									$ag_name_ar= mysqli_fetch_array($ag_name_q);
									?>
								<tr>
									<td><?php echo $sp_name_a['first_name'].' '.$sp_name_a['last_name']; ?></td>
									<td><?php echo $ag_name_ar['agent_name']; ?></td>
									<td><?php echo $us_uni_ar['visited_date']; ?></td>
									<td><?php echo $us_uni_ar['feedback']; ?></td>
								</tr>
								<?php	
							}
							?>
						</tbody>
					</table>
				</div>
				<div id="table_div" style="display:none">
					<table id="visit_table" style="width:100%">
						<caption>Visits</caption>
						<thead>
							<tr>
								<th>Agent Name</th>
								<th>Visits</th>
								<th>Feedback</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$print_num_query=mysqli_query($con,"SELECT distinct contact_no FROM visit WHERE username = '$username_salesperson'");
							while($print_num_array=mysqli_fetch_array($print_num_query))
							{
								$print_name_query=mysqli_query($con," SELECT Agent_Name from agent_info where Contact_No = '".$print_num_array['contact_no']."'");
								$print_name_array=mysqli_fetch_array($print_name_query);
								$date_query=mysqli_query($con,"SELECT * from visit where username = '$username_salesperson' and contact_no = '".$print_num_array['contact_no']."' and visited_date between '$date_from' and '$date_to' order by visited_date DESC");
								?>
								<?php while($date_array=mysqli_fetch_array($date_query))
								{ 
									?>
									<tr>
										<td><?php echo $print_name_array['Agent_Name'] ;?></td>
										<td><?php 
										echo $date_array['visited_date']; ?><br><?php 
										?>
										</td>
										<td><?php 
										echo $date_array['feedback'];?><br><?php 
										?>
										</td>
									</tr>
									<?php
								}
							}
							//end of while loop
							?>
						</tbody>
					</table>
				</div>
				<?php if($_POST['salesperson']=='all')
				{ ?>
				<script type="text/javascript">
					$(document).ready(function()
					{
						$('#all_table_div').show();
					});
				</script>
				<?php 
				}
				else 
				{ ?>
				<script type="text/javascript">
					$(document).ready(function()
					{
						$('#table_div').show();
					});
				</script>
				<?php 
				} 
						
				
				
			}
			?>
			<script>
				var list='<option value="" selected="selected">Select Agent</option><option value="all">All Agents</option>';
				<?php while($salesperson_list_array=mysqli_fetch_array($salesperson_list_query,MYSQLI_ASSOC)){
				?>
				var first = <?php echo json_encode($salesperson_list_array['first_name']); ?>;
				var last =  <?php echo json_encode($salesperson_list_array['last_name']); ?>;
				var username =  <?php echo json_encode($salesperson_list_array['username']); ?>;
				list+='<option value="' + username + '">' + first + ' ' + last + '</option>';
				<?php
				}?>
				$(function()
				{
					$('#datepicker_end').datepicker({ maxDate: 0, dateFormat: 'yy-mm-dd' });
					$('#datepicker_start').datepicker({ maxDate: 0, dateFormat: 'yy-mm-dd' });
					$('#salesperson_list_select').html(list);
				});
			</script>
			<br>
			<button id="gobackbutton" class="float-left submit-button">Go Back</button>
			<script>
				$('#gobackbutton').click(function()
				{
					window.location.replace('dashboard.php');
				});
			</script>
			<?php
		}
		else
		{
			/*else redirect, row_no!=1*/
			header('Location: dashboard.php');
		}
	}
	else
	{
		/* else redirect, not admin*/
		header('Location: dashboard.php');
	}
	?>
</body>
</html>