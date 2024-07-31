<?php
$server = "localhost";
$username = "root";
$password = "admin@1449";
$database = "blogdata";

$con = new mysqli($server, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
