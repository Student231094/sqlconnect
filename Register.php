<?php
$con = mysqli_connect('localhost', 'root', 'root', 'unityaccess');

if (mysqli_connect_errno()) {
    echo "1: Connection failed"; 
    exit();
}

$username = $_POST["name"];
$password = $_POST["password"];

// Check if name exists
$namecheckquery = "SELECT username FROM players WHERE username='" . $username . "';";
$namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed");

if (mysqli_num_rows($namecheck) > 0) {
    echo "3: Name already exists";
    exit();
}

// Validate password in PHP
if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[\W_]/', $password)) {
    echo "7: Password does not meet requirements";  // New error code
    exit();
}

// Add user to the table
$salt = "\$5\$rounds=5000\$" . "steamedhams" . $username . "\$";
$hash = crypt($password, $salt);
$insertuserquery = "INSERT INTO players (username, hash, salt) VALUES ('$username', '$hash', '$salt');";

mysqli_query($con, $insertuserquery) or die("4: Insert player query failed");

echo "0";
?>
