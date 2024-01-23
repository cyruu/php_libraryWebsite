<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "librarywebsite";


$conn = mysqli_connect($server, $username, $password, $database);
// Check the connection
if (!$conn) {
    die("Connection failed: ");
}
?>