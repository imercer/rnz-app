<?php
session_start();
$servername = "localhost";
$username = "rnz_app_api";
$password = "UQBa9HrAhFQ77Mbw";
$dbname = "rnz_app";
?>
<head><meta charset="UTF-8">
<title>Registration</title>
</head>
<?php
if (isset($_COOKIE['NZNewsUserID'])) {
    unset($_COOKIE['NZNewsUserID']);
}
if (!isset($_POST['preferences'])) {
   $_SESSION['error'] = "You haven't selected any categories, select at least one category to show and then try again";
    echo '<script type="text/javascript">
            window.location.href = "/welcome.php"
        </script>';
}
if (isset($_SESSION["userid"])) {
    $olduid = $_SESSION["userid"];
    $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $userid = mysqli_real_escape_string($conn, $_POST['userid']);

            $sql = "DELETE FROM preferences WHERE user_id='$olduid'";
            if ($conn->query($sql) === TRUE) {
                     echo "\n";
            } else {
                    die("Existing preferences cleared \n" . $conn->error);
            }
    }
setcookie("NZNewsUserID", $_POST['userid'], strtotime( '+1 year' ));

foreach ($_POST['preferences'] as $selected) {
    $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
            $preferencesql = mysqli_real_escape_string($conn, $selected);
            $userid = mysqli_real_escape_string($conn, $_POST['userid']);

            $sql = "INSERT INTO preferences 
                        (`user_id`, 
                        `preferences`,
                        `timestamp`) 
                    VALUES (
                        '$userid', 
                        '$preferencesql',
                         NOW());";
            if ($conn->query($sql) === TRUE) {
                     echo "\n";
            } else {
                    die("Preference Not Entered \n" . $conn->error);
            }
}
$_SESSION["userid"] = $_POST['userid'];
echo '<script type="text/javascript">
            window.location.href = "/index.php"
        </script>';
?>