<?php
    session_start();
    include_once("fetchProfileData.php");
    //$username = "sneha";
    $meal = $_POST["meal"];
    $mealid = $_POST["mealid"];
    $calories = $_POST["calories"];
    $label = $_POST["recipename"];
    $img = $_POST["img"];
    date_default_timezone_set("America/New_York");
    $updatedate = date("Y-m-d");
    echo $meal;
    $sqlproject = "INSERT INTO recipeeaten values ('".$username."', '".$updatedate."', '".$label."', '".$meal."', '".$mealid."', '".$img."', ".$calories.")";
    if ($conn->query($sqlproject) === TRUE) {
        echo "Congratulations!! Your data has been created successfully.";
    } else {
        echo "Error: <br>" . $conn->error;
    }
?> 