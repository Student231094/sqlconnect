<?php

$con = mysqli_connect('localhost', 'root', 'root', 'unityaccess');

// Check connection

if (mysqli_connect_errno()) {

echo "1: Connection failed"; 

exit();

}

$username = $_POST["username"];

$settingName = $_POST["settingName"];

$value = $_POST["value"];

// Sanitize inputs to prevent SQL Injection

$username = mysqli_real_escape_string($con, $username);

$settingName = mysqli_real_escape_string($con, $settingName);

$value = mysqli_real_escape_string($con, $value);

// Update the setting

$sql = "UPDATE players SET $settingName = '$value' WHERE username = '$username'";

if (mysqli_query($con, $sql)) {

echo "0"; // Success

} else {

echo "2: Update failed"; // Error code

}

?>
