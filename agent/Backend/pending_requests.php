<?php include('../UI/header.html');?>
<!DOCTYPE html>
<html>
<head>
	<title>Pending Requests Page</title>
<style type="text/css">
	table, th, td {
    border: 2px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
	
</style>
<script type="text/javascript">
	$("#salesperson_li").attr("class","active");
</script>
</head>
<body>
<?php
include('../Backend/connect.php');
$user=$_SESSION["username"];
$query=mysqli_query($con,"SELECT * from live_sessions where username = '$user'");
$row_no=mysqli_num_rows($query);
if($row_no==1)
{
	?>
	<table id="pendingtable" style="width:100%">
	<caption>Pending Requests Table</caption>
		<thead>
			<tr>
				<th>Salesperson Name</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$fetch_username_query=mysqli_query($con,"SELECT * from pending_requests");
		if(mysqli_num_rows($fetch_username_query)!=0)
		{
			while($fetch_username_array=mysqli_fetch_array($fetch_username_query)){
				?>
				<tr>
					<td><?php echo $fetch_username_array['username'];?>
					</td>
					<td><form action="activate_acc.php" method="post">
							<input type="hidden" name="username_form" value="<?php echo $fetch_username_array['username'];?>">
							<button class="float-left submit-button" type="submit" value="submit">Activate</button>
						</form>	
					</td>
				</tr>	

			<?php	
			}
		}	
		else
		{
			?>
				<tr>
					<td>No pending requests</td>
					<td></td>
				</tr>	
			<?php
		}
		?>
		</tbody>
	</table>	
	<p><button id="MainMenuButton" class="float-left submit-button">Go Back</button></p>
<script type="text/javascript">
    document.getElementById("MainMenuButton").onclick = function () {
        location.href = "../Backend/dashboard.php";
    }   		
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