<?php
session_start();
include_once("DBconnect.php"); //Establishing connection with our database

error_reporting(0);
$error = ""; //Variable for storing our errors.
if(isset($_POST["dologin"]))
{
if(empty($_POST["username"]) || empty($_POST["password"]))
{
$error = "Both fields are required.";
}else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];

// To protect from MySQL injection
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);
$password = md5($password);

//Check username and password from database
$sql="SELECT firstname FROM userprofile WHERE username='$username' and password='$password'";
$result=$conn->query($sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

//If username and password exist in our database then create a session.
//Otherwise echo error.

if(mysqli_num_rows($result) == 1)
{
$_SESSION['firstname'] = $row['firstname']; // Initializing Session
$_SESSION['username'] = $username;
echo "Firstname = ".$_SESSION['firstname']."<br>";
    echo "Username = ".$_SESSION['username']."<br>";

//echo "successful";

exit(header("Location: home.php",TRUE)); // Redirecting To Other Page
//    window.href.loca
}else
{
$error = "Incorrect username or password.";
}

}
}

?>