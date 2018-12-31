<?php
// Server and database info
$servername = "";
$database = "";
$username = "";
$password = "";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Posted data from form
$email = $_POST['email'];
$name = $_POST['name'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];

$addShipping = "INSERT INTO shipping (email, name, address1, address2, city, state, zip) 
	VALUES ('$email', '$name', '$address1', '$address2', '$city', '$state', '$zip')";

if (!mysqli_query($conn, $addShipping)) {
    echo "Error: " . $addShipping . "<br>" . mysqli_error($conn);
}

// Copy orders from quote table to orders table - use shipping order_id as id

$create_order = "INSERT INTO orders (brand, model, qty, price, total) SELECT * FROM quote";

if (!mysqli_query($conn, $create_order)) {
    echo "Error: " . $create_order . "<br>" . mysqli_error($conn);
}

$update_order_id = "UPDATE orders SET order_id = (SELECT order_id FROM shipping ORDER BY order_id DESC LIMIT 1) WHERE order_id = 0";

if (!mysqli_query($conn, $update_order_id)) {
    echo "Error: " . $updatee_order_id . "<br>" . mysqli_error($conn);
}
?>
<!-- CONFIRMATION PAGE HTML -->

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
	<div id="confirmation">
		<h1> Order Confirmation </h1>
		<div id="personalDetails">
			<p> <b> Thank you for your order! </b> <br/> Your order has successfully been placed and you will receive an email within 24 hours with a pre-paid shipping label to mail in your headphones. </p>
			<hr>
			<h2> Shipping Information </h2>

		<?php
		
            echo "<p>" . $name . "</p>";
            echo "<p> <span>" . $address1 . "</span> <span>" . $address2 . "</span> </p>";
            echo "<p> <span>" . $city . ", </span> <span>" . $state . "</span> <span> " .$zip. "</span> </p>";
            echo "<p>" . $email . "</p>";
            echo "</div>
            <hr>
            <h2 class='leftHeading'> Order Details </h2>";
            
			// For each row in shipping table
			$order = mysqli_query($conn,"SELECT * FROM orders WHERE order_id = (SELECT order_id FROM shipping ORDER BY order_id DESC LIMIT 1)");
            echo "<table class='formattedTable' id='confirmationTable'>
                <tr>
                    <th> Brand </th>
                    <th> Model </th>
                    <th> Quantity </th>
                    <th> Price </th>
                    <th> Total </th>
                </tr>";
            while($row = mysqli_fetch_array($order))
                {
                  echo "<tr>";
                    echo "<td>" . $row['brand'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['qty'] . "</td>";
                    echo "<td> $" . $row['price'] . "</td>";
                    echo "<td> $" . $row['total'] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";

		mysqli_close($conn);
		?>
	</div>
	</div> 
<script src="nav.js"></script>
</body>
</html>


