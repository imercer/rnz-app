<?php
$servername = "localhost";
$username = "rnz_app_api";
$password = "UQBa9HrAhFQ77Mbw";
$dbname = "rnz_app";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	echo "<div class=\"alert alert-danger\" role=\"alert\">An error occured while retriving stories! I'll be onto it <br>";
        die("Connection failed: " . $conn->connect_error);
	echo "</div>";
} 
$sql = "TRUNCATE `topics`";
if ($conn->query($sql) === TRUE) {
    echo "All Topics Cleared \n";
} else {
    die("All Topics Cleared \n" . $conn->error);
}
$conn->close();
?>