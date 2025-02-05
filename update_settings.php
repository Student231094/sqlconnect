<?php
$con = mysqli_connect('localhost', 'root', 'root', 'unityaccess');

// Check connection
if (mysqli_connect_errno()) {
    echo "1: Connection failed"; 
    exit();
}

$username = $_POST["username"];

// Prepare statement to prevent SQL injection
$sql = "SELECT level FROM players WHERE username = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($level);
    $stmt->fetch();
    echo "0:" . $level; // Success, output player's level
} else {
    echo "2: User not found"; // Error code for user not found
}

$stmt->close();
$con->close();
?>
