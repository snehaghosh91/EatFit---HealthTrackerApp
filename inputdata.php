<?php
/**
 * Created by PhpStorm.
 * User: paritadhandha
 * Date: 5/7/17
 * Time: 8:33 PM
 */
session_start();
include_once("fetchProfileData.php");
include_once ("DBconnect.php");
date_default_timezone_set("America/New_York");
$date =date("Y-m-d");

    $label = $_GET['label'];
    $calories = $_GET['calories'];
    echo $label;
    echo $calories;
    $query="insert into recipeeaten (username, eatendate, label, meal, mealid, photo, calories)
            values ('$username','$date','$label', 'Additional meal', '4', null, '$calories');";
echo $query;

    $result=$conn->query($query);
    $message= "success";

exit(header("Location: home.php",TRUE));
?>