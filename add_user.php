<?php
/**
 * Created by PhpStorm.
 * User: paritadhandha
 * Date: 5/1/17
 * Time: 1:26 PM
 */


session_start();

//echo "In Add_user<br>";

if(isset($_SESSION["user"])){
    exit(header("Location:home.php",TRUE));
}

if(!isset($_POST['username'])){
    exit(header("Location:indexpara.php",TRUE));
}
if(!isset($_POST['pass'])){
    exit(header("Location:indexpara.php",TRUE));
}

include_once("DBconnect.php");
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

if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
    $error = true;
    $emailError = "Please enter valid email address.";
    exit(header("Location:registerpara.php?emailError=".$emailError, TRUE));
}

if(!($sql = $conn->prepare("SELECT DISTINCT username, email FROM userprofile WHERE (lower(username)=?);"))){
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}
$sql->bind_param("s",$username);
$rslt = $sql->execute();
$sql->bind_result($user,$em);

$sql->fetch();
if (strcmp($username,$user)==0) {
    $sql->fetch();
    if(strcmp($email,$em)!=0){
        $msg='This%20username%20already%20exists%20with%20different%20email';
    }else{
        $msg='This%20user%20already%20exists.';
    }
    exit(header("Location:registerpara.php?msg=".$msg, TRUE));
}
else{
    $sql = $conn->prepare("INSERT INTO `userprofile` (`username`,`firstname`,`lastname`,`email`,`phone`,`gender`,`age`, `height`, `weight`, `lifestyle`,`password`) VALUES (?,?,?,?,?,?,?,?,?,?,?);");

    $sql->bind_param("ssssisiiids",$username,$firstname,$lastname,$email,$phone,$gender,$age, $height, $weight, $lifestyle,sha1($pass) );
    $rslt = $sql->execute();
    printf("%d Row inserted.\n", $stmt->affected_rows);
    $_SESSION['user']=$username;
    $sql->close();
    $conn->close();
    exit(header("Location:indexpara.php",TRUE));
}

?>