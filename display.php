<html>
<body>
<?php
$link = mysql_connect('localhost', 'root', 'root');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('php_forms');
$query = mysql_query("SELECT * FROM entry"); 
	WHILE($rows = mysql_fetch_array($query)):
		$name = $rows['name'];
		$email = $rows['email'];
		$phone_no = $rows['phone_no'];
	echo "$name<br>$email<br>$phone_no<br>";
?>
<form action="forms.php" method="post">
<input value="Back" type="submit">
</form>
</body>
</html>
