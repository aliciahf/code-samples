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
    
		<?php
        $name;
        $email;
        $subject;
		$message;


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = validate_input($_POST["name"]);
            $email = validate_input($_POST["email"]);
            $subject = validate_input($_POST["subject"]);
			$message = validate_input($_POST["message"]);
		}
		
		function validate_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

		$sent = fopen("received/records.txt", "a") or exit("File not found.");
        $inquiry = $name . ", " . $email . "\r\n" . $subject . "\r\n" . $message . "\r\n \r\n";
		file_put_contents($sent,$inquiry,FILE_APPEND);
        fwrite($sent, $inquiry);
        fclose($sent);
		
        ?>
        
        <p>Your message has been received.</p>
        <p>Thank you, <?php echo $name; ?>!</p>
    </div>
</div>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/enter.js"></script>
<script src="js/sidebar.js"></script>

</body>
</html>
