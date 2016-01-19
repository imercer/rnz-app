<?php
$servername = "localhost";
$username = "rnz_app_api";
$password = "UQBa9HrAhFQ77Mbw";
$dbname = "rnz_app";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
} 
$sql = "TRUNCATE `topics`";
if ($conn->query($sql) === TRUE) {
    echo "All Topics Cleared \n";
} else {
    die("All Topics Cleared \n" . $conn->error);
}
$conn->close();
?>