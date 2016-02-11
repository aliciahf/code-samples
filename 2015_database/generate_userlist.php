<!DOCTYPE html>
<html>
	<head>
 		<?php include "head.php" ?>
 	</head>
 	<body>
		<?php include "topbar.php" ?>

 		<div class="container">
 			<form style="float:left" class="form-inline" method="POST" action="">
 				<div class="form-group">
	 				<label class="control-label">Sort Users By: &nbsp;&nbsp;&nbsp;</label>
						<select class="form-control" name="order_by" type="test">
							<option value="user_login.username">username</option>
							<option value="user_login.password">password</option>
							<option value="user_login.email">email</option>
							<option value="user_login.dbn">dbn</option>
							<option value="user_details.f_name">first name</option>
							<option value="user_details.l_name">last name</option>
						</select>
					<input class="btn btn-primary" type="submit" value="Sort">
				</div>
 			</form>
 			<div style="float:right"><a class='btn btn-danger' href='index.php'>Back</a></div>
 		</div>
 		<br>
 		<div class="container">
	 		<?php
				//connect to server
				$cxn = new mysqli(	
			 		"warehouse.cims.nyu.edu", 
			 		"ahf254", 
			 		"n9e7jav8", 
			 		"ahf254_score_lookup"
			 	);

			 	$order_by = $_POST['order_by'];

			 	//create dynamic school listing
			 	$user_details = "
					SELECT user_login.username,user_details.f_name,user_details.l_name, user_login.password,user_login.email,user_login.dbn 
					FROM user_login 
					INNER JOIN user_details 
					ON user_login.username=user_details.username 
					ORDER BY $order_by;
			 	";
			 	// print("\nQuery: $school_details\n<hr />\n");

			 	$result = $cxn->query($user_details);
			 	$length = count($record);
			 	print("<table class='table-hover table-striped table'>
			 				<tr>
			 					<th>Username</th>
			 					<th>First Name</th>
			 					<th>Last Name</th>
			 					<th>Password</th>
			 					<th>Email</th>
			 					<th>DBN</th>
			 				</tr>");
			 	while ($record = mysqli_fetch_array($result)) {
			 		print("
			 				<tr>
			 					<td>$record[0]</td>
			 					<td>$record[1]</td>
			 					<td>$record[2]</td>
			 					<td>$record[3]</td>
			 					<td>$record[4]</td>
			 					<td>$record[5]</td>
			 				</tr>
			 		");
			 	}
			 	print("</table>");
	 		?>
 		</div>
 	</body>
</html>