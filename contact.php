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
$to = "headphonecenter@outlook.com";
$subject = "Message regarding headphones";
$body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email\n\nMessage:\n$message";
$header = "From: headphonecenter@outlook.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
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
	<link href="../navbar.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
	<!-- NAVBAR - FIRST COMPONENT IN BODY -->
<nav id="navbar">
    <h1> Broken Headphones </h1>
        <a href="../" id="home"> Home </a>
        <p id="projects"> Projects <i id="downArrow" class="fa fa-caret-down"></i></p>
        <ul class="dropdown">
            <li> Animal Clicker </li>
            <li> Art Portfolio </li>
            <li> Broken Headphones </li>
            <li> Concentration Game </li>
            <li> eBay Calculator </li>
            <li> Frogger Game </li>
            <li> HTML Email Blast Ad </li>
            <li> Responsive News Site </li>
            <li> Restroom Rater </li>
            <li> Sample Portfolio Page </li>
        </ul>
    </nav>
	<!-- Main body content -->
	<!-- Reference - https://www.gadgetsalvation.com/ -->
	<div id="container">
	    <div id="messageMessage">
            <p> <b> Thank you for your message.</b></p>
            <p> We will get back to you within the next 12-24 hours.</p>
        </div>
    </div>
<script src="nav.js"></script>
</body>
</html>
