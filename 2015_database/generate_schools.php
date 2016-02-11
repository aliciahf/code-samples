<?php
	//start session
	session_start();
?>

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
	 				<label class="control-label">Sort Schools By: &nbsp;&nbsp;&nbsp;</label>
						<select class="form-control" name="order_by" type="test">
							<option value="dbn">dbn</option>
							<option value="name">name</option>
						</select>
					<input class="btn btn-primary" type="submit" value="Sort">
				</div>
 			</form>
 			<div style="float:right"><a class='btn btn-danger' href='user_logout.php'>Logout</a></div>
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
			 	$school_details = "
					SELECT DISTINCT dbn,name,url,image
					FROM school_details ORDER BY $order_by;
			 	";
			 	// print("\nQuery: $school_details\n<hr />\n");

			 	$result = $cxn->query($school_details);
			 	$length = count($record);
			 	while ($record = mysqli_fetch_array($result)) {
			 		if ($record[3] != NULL) {
				 		print("
							<div class='block'>
								<a href=$record[2]>
								<img class='icon img-thumbnail' src=$record[3]>
								<p class='block_label'>$record[1]</p>
								</a>
							</div>
				 		");
				 	} else {
				 		print("
				 			<div class='block'>
				 				<a href=$record[2]>
				 				<img class='icon img-thumbnail' src='http://homecut.info/wp-content/uploads/2015/06/school-building-icon-jti7shuuw.png'>
					 			<p class='block_label'>$record[1]</p>
					 			</a>
					 		</div>
				 		");
				 	}
			 	}
	 		?>
 		</div>
 	</body>
</html>