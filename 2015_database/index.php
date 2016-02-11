<?php session_start(); ?>

<!-- MAIN HTML -->
<!DOCTYPE html>
 <html>
 	<head>
 		<?php include "head.php" ?>
 	</head>
 	<body>
 		<?php include "topbar.php" ?>

 		<div class="container" id="login_forms">
			<h2>LOGIN AS EXISTING USER</h2><br>
			<!-- CHECK NEW USER INFORMATION -->
			<form class="form-horizontal" method="POST" action="user_login.php">
				<div class="form-group">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-8">
						<input class="form-control" name="username" type="text" placeholder="Username" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input class="form-control" name="password" type="text" placeholder="Password" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<input type="submit" value="Login" class="btn btn-info">
					</div>
				</div>
			</form>
			<br>
			<h2>CREATE NEW USER</h2>
			<!-- INSERT NEW USER INFORMATION -->
			<form class="form-horizontal" method="POST" action="user_create.php">
				<div class="form-group">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
						<input class="form-control" name="username" type="text" placeholder="Username" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input class="form-control" name="password" type="text" placeholder="Password" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input class="form-control" name="email" type="email" placeholder="Email" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-5">
						<input class="form-control" name="f_name" type="text" placeholder="First Name" required>
					</div>
					<div class="col-sm-5">
						<input class="form-control" name="l_name" type="text" placeholder="Last Name" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">School: </label>
					<div class="col-sm-10">
						<select class="form-control" name="dbn" type="text" required>
							<?php
								// connect to server
								$cxn = new mysqli(	
							 		"warehouse.cims.nyu.edu", 
							 		"ahf254", 
							 		"n9e7jav8", 
							 		"ahf254_score_lookup"
							 	);
								// create dynamic dropdown (dbn + school name)
								$get_school_info = "
									SELECT dbn, school 
									FROM sat_results
									ORDER BY school;
								";
								$result = $cxn->query($get_school_info);
								$length = count($record);
								while ($record = mysqli_fetch_array($result)) {
									print("<option value = $record[0]>$record[1]</option>");
								}
								mysqli_free_result($result);
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<input type="submit" value="Register" class="btn btn-primary">
					</div>
				</div>
			</form>
 		</div>
 		<br><br><br>
		<div class="container">
			<a class="btn btn-warning btn-lg btn-block" href="generate_userlist.php">VIEW ALL USERS</a><br>
			<a class="btn btn-warning btn-lg btn-block" href="generate_schools.php">VIEW ALL SCHOOLS*</a>
			<small><i>* Not all schools are included since the list is long and the data I based this app off of did not include site URLs or logos. The first 20+ entries were included as a sample for the purpose of this assignment.</i></small>
		</div>
 	</body>
 </html>