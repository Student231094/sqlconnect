<?php 
$con = mysqli_connect('localhost', 'root', 'root', 'unityaccess');

// Check that connection happened
if (mysqli_connect_errno()) 
{
    echo "1: Connection failed"; // Error code #1 = connection failed
    exit();
}

$username = $_POST["name"];
$newLevel = $_POST["level"];

// Check if user exists
$namecheckquery = "SELECT username FROM players WHERE username='" . $username . "';";
$namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed"); // Error code #2 - name check failed

if (mysqli_num_rows($namecheck) != 1) 
{
    echo "5: Either no user with this name, or more than one"; // Error code #5 - invalid number of matches
    exit();
}

// Update the level
$updatequery = "UPDATE players SET level='" . $newLevel . "' WHERE username='" . $username . "';";
mysqli_query($con, $updatequery) or die("7: Save query failed"); // Error code #7 - update failed

echo "0"; // Success
?>
