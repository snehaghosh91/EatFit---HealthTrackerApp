<?php
include_once("DBconnect.php");
$username=$_SESSION["username"];

//$username="pri";
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
//xinclude("file_with_errors.php");
error_reporting(0);

//$uaddress=$ucity=$ustate=$ustate=$zip=$uphoto=$description=$dateOfBirth=$mobileNumber="";
$sql = "select * from userprofile where username='$username';";

if ($result = $conn->query($sql)){

 while($rs = $result->fetch_assoc()){
      $username=$rs['username'];
	  $firstname=$rs['firstname'];
	  $lastname=$rs['lastname'];
	  $email=$rs['email'];
	  $phone=$rs['phone'];
	  $gender=$rs['gender'];
	  $age=$rs['age'];
	  $height=$rs['height'];
      $weight=$rs['weight'];
      $lifestyle  = $rs['lifestyle'];
  }
}


//echo $username." ".$firstname;
?>









