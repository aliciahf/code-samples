<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CORVIDAY: contact</title>
<link rel="stylesheet" href="css/main.css">
</head>

<body>

<div class="sidebar">
	<h1>.CORVIDAY.</h1>
    <h3>THE ART OF ALICIA FENG</h3>
    <nav>
    	<?php include 'sidebar.php'; ?>
	</nav>
</div>

<div class="content">
	<div id="contact">
		<form name="sent" action="sent.php" method="post">
			<label for="name">NAME</label><br />
			<input type="text" id="name" name="name" required><br />
            
			<label for="email">EMAIL ADDRESS</label><br />
			<input type="email" id="email" name="email" required><br />
            
			<label for="subject">SUBJECT</label><br />
			<input type="text" id="subject" name="subject"><br />
			
            <label for="message">MESSAGE</label><br />
			<textarea name="message" id="message" rows="6" cols="40"></textarea><br />
            <br />
			<input type="submit" value="SEND">
		</form>
    </div>
</div>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/enter.js"></script>
<script src="js/sidebar.js"></script>
<script src="js/form-validation.js"></script>

</body>
</html>
