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

// Empty out cart and quote tables in case they contain old data
$emptyCart = "DELETE FROM cart";
$emptyQuote = "DELETE FROM quote";

if (!mysqli_query($conn, $emptyCart)) {
    echo "Error: " . $emptyCart . "<br>" . mysqli_error($conn);
}

if (!mysqli_query($conn, $emptyQuote)) {
    echo "Error: " . $emptyQuote . "<br>" . mysqli_error($conn);
}

// Insert user data into table

$brand = $_POST['brand'];
$model = $_POST['model'];
$qty = $_POST['qty'];

// Workaround - assuming user does not insert over 10 rows, this will work.
$insert = "INSERT INTO cart (brand, model, qty) VALUES ('$brand[0]', '$model[0]', '$qty[0]'),
    ('$brand[1]', '$model[1]', '$qty[1]'), 
    ('$brand[2]', '$model[2]', '$qty[2]'), 
    ('$brand[3]', '$model[3]', '$qty[3]'), 
    ('$brand[4]', '$model[4]', '$qty[4]'),
    ('$brand[5]', '$model[5]', '$qty[5]'), 
    ('$brand[6]', '$model[6]', '$qty[6]'),
    ('$brand[7]', '$model[7]', '$qty[7]'), 
    ('$brand[8]', '$model[8]', '$qty[8]'),
    ('$brand[9]', '$model[9]', '$qty[9]')";
    
// Deletes all blank rows from table afterwards to clean up
$delete = "DELETE FROM `cart` WHERE qty=0";

// Success/failure for INSERT
if (!mysqli_query($conn, $insert)) {
    echo "Error: " . $insert . "<br>" . mysqli_error($conn);
}

// Success/failure for DELETE
if (!mysqli_query($conn, $delete)) {
    echo "Error: " . $delete . "<br>" . mysqli_error($conn);
}

// INSERT SORTED CART INFO INTO QUOTE TABLE

$organized = "INSERT INTO quote (brand, model, qty) 
    SELECT brand, model, SUM(qty) 
    FROM `cart` 
    GROUP BY model 
    ORDER BY qty";

if (!mysqli_query($conn, $organized)) {
    echo "Error: " . $organized . "<br>" . mysqli_error($conn);
}

$pricing = "UPDATE quote SET quote.price = (SELECT price FROM pricing WHERE pricing.model = quote.model)";

if (!mysqli_query($conn, $pricing)) {
    echo "Error: " . $pricing . "<br>" . mysqli_error($conn);
}

$total = "UPDATE quote SET total = qty * price";

if (!mysqli_query($conn, $total)) {
    echo "Error: " . $total . "<br>" . mysqli_error($conn);
}
?>

<!-- TESTING HTML INSIDE PHP -->

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
		<div class="tableDiv">
			<h1> Your Quote:
			<!--PHP to add info from quote table-->
			<?php
                $result = mysqli_query($conn,"SELECT SUM(total) FROM quote");
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                 echo "<span class='greenQuote'> $" . $row['SUM(total)'] . "</span> </h1>";
                }
                
                $another = mysqli_query($conn,"SELECT * FROM quote");
                
                echo "<table class='formattedTable'>
                <tr>
                    <th> Brand </th>
                    <th> Model </th>
                    <th> Quantity </th>
                    <th> Price </th>
                    <th> Total </th>
                </tr>";
                
                while($row = mysqli_fetch_array($another))
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
                
                // Close connection
            mysqli_close($conn);
            ?>
			<div class="acceptDeclineDiv">
				<a class = "tableLinks" href="order-information.html"> Accept Quote </a>
				<br />
				<a class = "tableLinks" href="http://brokenheadphones.store/"> Decline </a>
			</div>
		</div>
	</div>
<script src="nav.js"></script>
</body>
</html>