<?php


//error_reporting(E_ALL);
ini_set("display_errors", 1);
//include("file_with_errors.php");

//error_reporting(E_ERROR);
include_once("DBconnect.php");
// to inset into recipe table
$error= "";
function cleanData($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

/*
if(isset($_POST["username"]) && isset($_POST["firstname"])&& isset($_POST["email"])) {
    echo $_POST["username"];
    echo $_POST["firstname"];
    echo $_POST["lastname"];
    echo $_POST["email"];
    echo $_POST["phone"];
    echo $_POST["height"];
    echo $_POST["weight"];
    echo $_POST["age"];
    echo $_POST["lifestyle"];
    echo $_POST["gender"];
}

*/






if(isset($_GET["username"]))
    $username = $_GET["username"];

if(isset($_POST["firstname"]))
    $firstname = $_POST["firstname"];
if(isset($_POST["lastname"]))
    $lastname = $_POST["lastname"];
if(isset($_POST["email"]))
    $email = $_POST["email"];

//$uphoto = addslashes(file_get_contents($_FILES['uphoto']['tmp_name']));

if(isset($_POST["phone"]))
    $phone = $_POST["phone"];
if(isset($_POST["gender"]))
    $gender = $_POST["gender"];

//$dateOfBirth = date('Y-m-d', strtotime($dateOfBirth));

if(isset($_POST["age"]))
    $age = $_POST["age"];
if(isset($_POST["height"]))
    $height =$_POST["height"];
if(isset($_POST["weight"]))
    $weight=$_POST["weight"];
if(isset($_POST["lifestyle"]))
    $lifestyle=$_POST["lifestyle"];

	
					
		$sql ="update userprofile set firstname='$firstname', lastname='$lastname', email='$email', phone=$phone, gender='$gender', age=$age, height=$height, weight=$weight,lifestyle=$lifestyle where username = '$username';";
     //   echo $sql;
        $execute_sql_log=mysqli_query($conn,$sql);

        if($execute_sql_log)
            header("Location: updateprofile.php");


?>