<?php
	//conect to database
	$cxn = new mysqli(	
 		"warehouse.cims.nyu.edu", 
 		"ahf254", 
 		"n9e7jav8", 
 		"ahf254_score_lookup"
 	);

	$username = $_POST['username'];
	$password = $_POST['password'];
	$email 	  = $_POST['email'];
	$f_name   = $_POST['f_name'];
	$l_name	  = $_POST['l_name'];
	$dbn   	  = $_POST['dbn'];

	//queries
	$record_user_details = "
		INSERT INTO user_details (
			username,
			l_name,
			f_name
		) 
		VALUES (
			\"$username\",
			\"$l_name\",
			\"$f_name\"
		);
	";
	$record_user_login = "
		INSERT INTO user_login (
			username,
			password,
			email,
			dbn
		) 
		VALUES (
			\"$username\",
			\"$password\",
			\"$email\",
			\"$dbn\"
		);
	";

	//execute queries
	$result = $cxn->query($record_user_details);
	$result2 = $cxn->query($record_user_login); 

	mysqli_free_result($result);
	mysqli_free_result($result2);
?>

<!DOCTYPE html>
<html>
	<head>
 		<?php include "head.php" ?>
 	</head>
 	<body>
 		<?php include "topbar.php" ?>
		<br><br>
 		<div align="center" class="container">
 			<p>
 				Thank you for creating an account!<br>
 				Please login on the front page with your new username and password.<br>
 			</p>
 			<a class='btn btn-danger' href='index.php'>Back</a>
 	</body>
</html>