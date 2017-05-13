<?php
/**
 * Created by PhpStorm.
 * User: paritadhandha
 * Date: 4/30/17
 * Time: 10:22 PM
 */
ob_start();
include_once("DBconnect.php");
session_start();

//echo "In Login<br>";

if(isset($_SESSION["username"])){
    exit(header("Location:index.php",TRUE));
}

//echo "<br>";

$username = trim($_POST['username']);
$username = strip_tags($username);
$username = htmlspecialchars($username);
$username = strtolower($username);

$password = $_POST['password'];


if(!($sql = $conn->prepare("SELECT DISTINCT username, email FROM userprofile WHERE (lower(username)=? or lower(email)=?) and password=?"))){
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}
$sql->bind_param("sss",$username,$username,sha1($password) );
$rslt = $sql->execute();

$sql->bind_result($user,$em);

if ($rslt > 0){

    $sql->fetch();
    if((strcmp(strtolower($user),strtolower($username))==0)||(strcmp(strtolower($em),strtolower($username))==0)){
        $_SESSION['username']=$username;
        $sql->close();
        $conn->close();
        echo "happemning".$user;
        exit(header("Location:index.php",TRUE));}
    else{
        $sql->close();
        $conn->close();
        exit(header("Location:index.php?msg=No%20such%20Username%20or%20Password.",TRUE));
    }
}else {
    $sql->close();
    $conn->close();
    exit(header("Location:index.php?msg=No%20such%20Username%20or%20Password",TRUE));
}
ob_end();
?>