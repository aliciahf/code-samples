<?php
	//start session
	session_start();

	//conect to database
	$cxn = new mysqli(	
 		"warehouse.cims.nyu.edu", 
 		"ahf254", 
 		"n9e7jav8", 
 		"ahf254_score_lookup"
 	);

	//queries
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "
		SELECT password 
		FROM user_login 
		WHERE username = \"".$username."\";
	";

	//run query
	$result = $cxn->query($query); 
 	$record = mysqli_fetch_array($result);

 	//store session variables
 	if ($record[0] == $password) {
		$_SESSION['access'] = true;
		$_SESSION['user'] = $username;
	} else {
		$_SESSION['access'] = false;
	};

	//clear results
 	mysqli_free_result($result);
 	mysqli_free_result($record);
  	mysqli_close($cxn);
?>

<!DOCTYPE html>
<html>
	<head>
 		<?php include "head.php" ?>
 	</head>
	<body>
		<?php include "topbar.php" ?>

		<script type="text/javascript">
			//check if user is successfully logged in
			$(document).ready(function() {
			    <?php echo 'var access = '.json_encode($_SESSION['access']).';'; ?>
			    console.log(access);
			    if (access == true) {
			    	$("#fail_message").hide();
			    } else {
			    	$("#success_message").hide();
			    }
			});
		</script>

		<div align="center" class="container" id="fail_message">
			<p><br><br>Sorry, something went wrong! Please go back and try again.</p>
			<!-- return to login -->
			<a class="btn btn-danger" href="index.php">Back</a>
		</div>
		<div class="container" id="success_message">
			<?php 
				//connect to server
				$cxn = new mysqli(	
			 		"warehouse.cims.nyu.edu", 
			 		"ahf254", 
			 		"n9e7jav8", 
			 		"ahf254_score_lookup"
			 	);

				//record session username
			 	$username = $_SESSION['user'];

			 	//get and record session dbn
			 	$get_dbn = "
					SELECT dbn
					FROM user_login 
					WHERE username = \"".$username."\";
				";
				$result = $cxn->query($get_dbn); 
				$dbn = mysqli_fetch_array($result);
				$_SESSION['dbn'] = $dbn[0];

				//get and record session school
				$get_school = "
					SELECT school
					FROM sat_results
					WHERE dbn = \"".$dbn[0]."\"
				";
				$result2 = $cxn->query($get_school); 
				$user_school = mysqli_fetch_array($result2);
				$_SESSION['user_school'] = $user_school[0];

				//get and record session name
				$get_name = "
					SELECT f_name,l_name 
					FROM user_details
					WHERE username = \"".$username."\";
				";
				$result3 = $cxn->query($get_name); 
				$user_name = mysqli_fetch_array($result3);
				$_SESSION['user_name'] = "$user_name[0]. $user_name[1]";

				//clear results
			 	mysqli_free_result($result);
			 	mysqli_free_result($result2);
			 	mysqli_free_result($result3);
			  	mysqli_close($cxn);
			?>
			<h3>Welcome back, <?php print($_SESSION['user_name']); ?>!</h3>
			<p class="lead">Please select which options you would like to review for <?php print($_SESSION['user_school']); ?>:</p>

			<form class="col-sm-offset-4" method="GET" action="generate_results.php">
				<div class="checkbox">
					<input type="checkbox" name="num_test" value=true>
					Total Number of SAT Test Takers<br>
				</div>
				<div class="checkbox">
					<input type="checkbox" name="cr_avg" value=true>
					Critical Reading Score (Average)<br>
				</div>
				<div class="checkbox">
					<input type="checkbox" name="math_avg" value=true>
					Mathematics Score (Average)<br>
				</div>
				<div class="checkbox">
					<input type="checkbox" name="writing_avg" value=true>
					Writing Score (Average)<br>
				</div>
				<input type="submit" value="Submit" class="btn btn-primary">
			</form>
			<br>
			<h3>View All Contributing Schools</h3>
			<a class="btn btn-warning btn-lg btn-block" href="generate_schools.php">Access School Sites</a>

		</div>
	</body>
</html>