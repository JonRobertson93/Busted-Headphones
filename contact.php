<?php
// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Create the email and send the message
$to = "<email here>"; // Where the email will send to
$subject = "Message regarding headphones";
$body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email\n\nMessage:\n$message";
$header = "From: <from email>\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$header .= "Reply-To: $email";	

if (!mail($to, $subject, $body, $header)) {
  echo "Email did not send!";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title> Sell Junk Headphones </title>
	<link href="style.css" rel="stylesheet">
	<link href="responsive.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
	<div id="navbar">
		<div id="nav-link-1">
			<span> <i class="fas fa-headphones-alt"></i> <a href="http://brokenheadphones.store/"> Busted Headphones</a> </span>
		</div>
		<div class="nav-link"> <a href="http://brokenheadphones.store/"> Home </a> </div>
		<div class="nav-link"> <a href="#"> FAQs </a> </div>
		<div class="nav-link"> <a href="http://brokenheadphones.store/contact.html"> Contact </a> </div>
		<a href="javascript:void(0);" id="icon"> <i class="fas fa-bars"></i></a>
	</div>
	<!-- Main body content -->
	<div id="container">
	    <div id="messageMessage">
            <p> <b> Thank you for your message.</b></p>
            <p> We will get back to you within the next 12-24 hours.</p>
        </div>
    </div>
<script src="nav.js"></script>
</body>
</html>
