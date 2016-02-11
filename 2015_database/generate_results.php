<?php
	//start session
	session_start();
	$session_id = session_id();

	//conect to database
	$cxn = new mysqli(	
 		"warehouse.cims.nyu.edu", 
 		"ahf254", 
 		"n9e7jav8", 
 		"ahf254_score_lookup"
 	);

	$num_test 	  = $_GET['num_test'];
	$cr_avg 	  = $_GET['cr_avg'];
	$math_avg 	  = $_GET['math_avg'];
	$writing_avg  = $_GET['writing_avg'];
	$access_check = $_SESSION['access'];

	//queries
	$stat_pull = "
		SELECT num_test,cr_avg,math_avg,writing_avg
		FROM sat_results
		WHERE dbn = \"".$_SESSION['dbn']."\";
	";

	//execute query
	$result = $cxn->query($stat_pull);

	//isolate data
	$unsorted_data = mysqli_fetch_array($result);
	$testers = $unsorted_data[0];
	$cr = $unsorted_data[1];
	$math = $unsorted_data[2];
	$writing = $unsorted_data[3];
?>

<!DOCTYPE html>
<html>
	<head>
 		<?php include "head.php" ?>
 	</head>
	<body>
		<?php include "topbar.php" ?>

		<div class="container">
			<h3>REPORT RESULTS:</h3>
			<table class="table table-hover table-striped">
			<?php
				//display data
				if ($num_test == true && $access_check == true) {
					print("<tr><td>Total Number of Test Takers:</td> <td>$testers</td>");
				} if ($cr_avg == true && $access_check == true) {
					print("<tr><td>Average Critical Reading Score:</td> <td> $cr </td>");
				} if ($math_avg == true && $access_check == true) {
					print("<tr><td>Average Math Score:</td> <td> $math </td>");
				} if ($writing_avg == true && $access_check == true) {
					print("<tr><td>Average Writing Score:</td> <td> $writing </td>");
				} if ($num_test == true || $cr_avg == true || $math_avg == true || $writing_avg == true) {
					print("</table><br><br><div align='center'><a class='btn btn-danger' href='user_logout.php'>Logout</a></div><br>");
				} if ($num_test == false && $cr_avg == false && $math_avg == false && $writing_avg == false) {
					print("<div align='center'><p><br><br>Nothing was found. Please login and try again.</p><a class='btn btn-danger' href='index.php'>Back</a></div>");
				} if ($access_check == false) {
					print("<div align='center'><p><br><br>Sorry, something went wrong! Please go back and try again.</p><a class='btn btn-danger' href='index.php'>Back to Home Page</a></div>");
				}

				mysqli_free_result($result);
				mysqli_close($cxn);
			?>
			</table>
		</div>
	</body>
</html>

	