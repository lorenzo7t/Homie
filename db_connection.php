<?php
$host = "db-mysql-homie-do-user-16566741-0.c.db.ondigitalocean.com";
$username = "doadmin";
$password = "AVNS_cHQGTt60SUNMFk3QDFb";
$dbname = "defaultdb";
$port=25060;

$conn = new mysqli($host, $username, $password, $dbname, $port);
$conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 30); 

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>


