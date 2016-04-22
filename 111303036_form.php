<html>
<head>
<b>FORMS FORMS FORMS!!!<br></b>
	<style>
		.error {color: #FF0000}
	</style>
</head>
<body>
<?php
$nameErr = $emailErr = $phone_noErr = "";
$name = $email = $phone_no = "";
$error = 0;
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST["name"])) {
		$nameErr = "Name is required";
		$error = 1;
	}
	else {
		$name = $_POST["name"];
		if (!preg_match("/^[a-zA-Z]*$/", $name)) {
			$nameErr = "Only alphabets are allowed";
			$error = 1;
		}
		if(strlen($name) >= 40) {
			$nameErr = "Entry should be less than 40 characters";
			$error = 1;
		}
	}
	
	if(empty($_POST["email"])) {
		$emailErr = "Email is required";
		$error = 1;
	}
	else {
		$email = $_POST["email"];
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
			$error = 1;
		}
		else {
			if(!(strpos($email, "coep.ac.in") || strpos($email, "gmail.com") || strpos($email, "yahoo.com") || strpos($email, "riseup.net"))) {
				$emailErr = "Invalid email";
				$error = 1;
			}
		}
	}

	$phone_no = $_POST["phone_no"];
	if(strlen($phone_no) != 10 && strlen($phone_no) != 8) {
		$phone_noErr = "Phone number should be of 8 or 10 digits";
		$error = 1;
	}
	else {
		if(!preg_match("/^[0-9]*$/", $phone_no)) {
			$phone_noErr = "Phone number should only contain digits";
			$error = 1;
		}
	}
	if($error == 0) {
		$text = "$name $email $phone_no";
		$servername = "localhost";
		$username = "root";
		$password = "root";
		
		$conn = mysqli_connect($servername, $username, $password);
		if(!conn) {
			die("Connection Failed: " . mysqli_connect_error());
		}
		
		$sql = "create database php_forms";
		mysqli_query($conn, $sql);

		$sql = "use php_forms";
		mysqli_query($conn, $sql);

		$sql = "create table entry (
			name VARCHAR(40),
			email VARCHAR(40),
			phone_no VARCHAR(10),
			primary key(phone_no)
			)";
		mysqli_query($conn, $sql);

		$sql = "INSERT INTO entry VALUES('$name', '$email', '$phone_no')";
		if(mysqli_query($conn, $sql)) {
                        echo "Data entered successfully";
                }
                else {
                        echo "Error entering data: " . $conn->error;
                }
		
		mysqli_close($conn);
	}
}
?>
<span class="error"><br><br>* Required Fields </span>
<form action="display.php" method="POST">
<br>Name: <br><input type="text" name="name" value = "<?php echo $name; ?>">
<span class="error">* <?php echo $nameErr; ?> </span><br>	
<br>Email: <br><input type="text" name="email"  value = "<?php echo $email; ?>">
<span class="error">* <?php echo $emailErr; ?> </span><br>
<br>Phone no: <br><input type="text" name="phone_no"  value = "<?php echo $phone_no; ?>">
<span class="error"> <?php echo $phone_noErr; ?> </span><br>
<br><input type="submit" name="submit" value="submit">
</form>
  

</body>
</html>
