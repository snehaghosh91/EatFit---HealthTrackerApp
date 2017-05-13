
<?php
// Connecting, selecting database
error_reporting(0);
$servername = "healthapp.cxcugujne966.us-west-2.rds.amazonaws.com";
$uname = "root";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $uname, $password, $dbname);
if ($conn->connect_error)
{
  die("Connection failed: ".$conn->connect_error);
}


?>
