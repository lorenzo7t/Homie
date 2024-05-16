<?php
$host = "db-mysql-homie-do-user-16566741-0.c.db.ondigitalocean.com";
$username = "doadmin";
$password = "AVNS_cHQGTt60SUNMFk3QDFb";
$dbname = "defaultdb";
$port=25060;

// Create connection
$conn = new mysqli($host, $username, $password, $dbname, $port);


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
/* echo "Connected successfully";
 */
?>


