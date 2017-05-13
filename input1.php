<?php
session_start();
include_once("fetchProfileData.php");
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">


    <nav class="navbar navbar-default navbar-inverse" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="home.php">Cookzilla</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <a class="navbar-brand navbar-right" href="Logout.php"><span class="glyphicon glyphicon-user">Logout</span></a>
                <a class="navbar-brand navbar-right" href="updateProfile.php"><span >Hello <?php echo $username?>  </span></a>
                <div class="navbar-header">

                </div>


            </div>
    </nav>

</head>
<div style=" margin-left: 30%; margin-top: 10% ">

    <button type="button" "><a href="home.php">< Back to Home</a> </button><br><br><br>
    <form action="inputdata.php" method="get">
        Recipe Name<input type="text" name="label"><br><br><br>

        Calories<input type="text" name="calories"><br><br><br>
        <input type="submit">
    </form>


</div>

</html>
