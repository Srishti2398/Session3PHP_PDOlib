
<?php

$servername = "localhost";
$dbname = "testDB";
$username = "phpmyadmin";
$password = "ttn";
$search_value=$_POST["search"];
$mysqli = new mysqli($servername, $username,$password, $dbname);

// Checking for connections
if ($mysqli->connect_error) {
	die('Connect Error (' .
	$mysqli->connect_errno . ') '.
	$mysqli->connect_error);
}

// SQL query to select data from database
$sql="select * from test2 where firstname like '%$search_value%'";
$result = $mysqli->query($sql);
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Details of employee</title>
	<!-- CSS FOR STYLING THE PAGE -->
	<style>
		table {
			margin: 0 auto;
			font-size: large;
			border: 1px solid black;
		}

		h1 {
			text-align: center;
			color: #006600;
			font-size: xx-large;
			font-family: 'Gill Sans', 'Gill Sans MT',
			' Calibri', 'Trebuchet MS', 'sans-serif';
		}

		td {
			background-color: #E4F5D4;
			border: 1px solid black;
		}

		th,
		td {
			font-weight: bold;
			border: 1px solid black;
			padding: 10px;
			text-align: center;
		}

		td {
			font-weight: lighter;
		}
	</style>
</head>

<body>
	<section>
		<h1>Details of Employee</h1>
		<!-- TABLE CONSTRUCTION-->
		<table>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email Id</th>
				<th>Contact No</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS-->
			<?php // LOOP TILL END OF DATA
				while($rows=$result->fetch_assoc())
				{
			?>
			<tr>
				<!--FETCHING DATA FROM EACH
					ROW OF EVERY COLUMN-->
				<td><?php echo $rows['firstname'];?></td>
				<td><?php echo $rows['lastname'];?></td>
				<td><?php echo $rows['email_id'];?></td>
				<td><?php echo $rows['contact_no'];?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>
