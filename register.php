<?php
 ob_start();
 session_start();
 // $error ='';
 // if( isset($_SESSION['uid'])!="" ){
  // //header("Location: index.php");
 // }
 include_once 'dbconnect.php';
//error_reporting(0);
 if ( isset($_POST['Signup']) ) {

  // clean user inputs to prevent sql injections
  $firstname = trim($_POST['firstname']);
  $firstname = strip_tags($firstname);
  $firstname = htmlspecialchars($firstname);

  $lastname = trim($_POST['lastname']);
  $lastname = strip_tags($lastname);
  $lastname = htmlspecialchars($lastname);
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $username = trim($_POST['username']);
  $username = strip_tags($username);
  $username = htmlspecialchars($username);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
  $pass2 = trim($_POST['pass2']);
  $pass2 = strip_tags($pass2);
  $pass2 = htmlspecialchars($pass2);

  $phone = trim($_POST['phone']);
  $phone = strip_tags($phone);
  $phone = htmlspecialchars($phone);

  $age = trim($_POST['age']);
  $age = strip_tags($age);
  $age = htmlspecialchars($age);

  $height = trim($_POST['height']);
  $height = strip_tags($height);
  $height = htmlspecialchars($height);

  $weight = trim($_POST['weight']);
  $weight = strip_tags($weight);
  $weight = htmlspecialchars($weight);

  $gender = trim($_POST['gender']);
  $gender = strip_tags($gender);
  $gender = htmlspecialchars($gender);

  $lifestyle = trim($_POST['lifestyle']);
  $lifestyle = strip_tags($lifestyle);
  $lifestyle = htmlspecialchars($lifestyle);

  // basic name validation
  if (empty($firstname)|| empty($lastname)) {
   $error = "Please enter your full name.";
  } else if (strlen($firstname) < 3||strlen($lastname) < 3) {
   $error = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$firstname)|| !preg_match("/^[a-zA-Z ]+$/",$lastname)) {
   $error = "Name must contain alphabets and space.";
  }
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = "Please enter valid email address.";
  } else {
   // check user exist or not
   $query = "SELECT username FROM userprofile WHERE username='$username'";
   $result = $conn->query($query);
   $count = $result->num_rows;
   if($count!=0){
    $error = "User Name is already in use.";
   }
  }
  // password validation
  if (empty($pass)){
   $error = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = "Password must have atleast 6 characters.";
  }

  else if($pass!=$pass2){
	  $error = "Password do not match";
  }
  else
  {
	  $pass=md5($pass);
  }
  // if there's no error, continue to signup
  if( $error =='' ) {
   	
   $query = "INSERT INTO userprofile(username,firstname,lastname,email,phone,gender,age, height, weight, lifestyle,password) VALUES('$username','$firstname','$lastname','$email',$phone,'$gender',$age, $height, $weight, $lifestyle,'$pass')";
   $res = $conn->query($query);
    
   if ($res) {
	   $_SESSION['username']=$username;
	   $_SESSION['firstname'] = $firstname;

    $error = "Successfully registered, you may login now";
    exit(header("Location:home.php",TRUE)); // Redirecting To Other Page
   } else {

    $error = "Something went wrong, try again later..."; 
   } 
  }
  
  
 }
 $conn->close();
?>

<?php ob_end_flush(); ?>