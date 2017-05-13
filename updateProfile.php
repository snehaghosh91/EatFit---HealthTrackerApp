<!--doctype html>-->
<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include_once("fetchProfileData.php");
?>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta charset="utf-8">
<style>
body{
    background-color: #f8f8f8;
    padding:2px;
	height: 500px;
}

</style>


    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<nav class="navbar navbar-default navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

            <a class="navbar-brand" href="home.php">GETFIT</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <a class="navbar-brand navbar-right" href="logout.php"><span class="glyphicon glyphicon-user">Logout</span></a>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <form class="navbar-form navbar-right"  method="post" action="search.php" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" name="fromcal" placeholder="from Calories">
                    <input type="text" class="form-control" name="tocal" placeholder="to Calories">
                    <input type="text" class="form-control" name="key" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>

        </div>
</nav>




<div class="col-12" style="height:100px">

<div class="tabs"  style="padding:10px; margin-left: 0px; height:500px; width: 20%">
	
	<div class="links" style="width: 80%;  margin-left: -20px; margin-top: -50px; height: 20px; background-color:f8f8f8">
	</div>
	
	<div class="links" style="width:100%; height: 50px; margin-top:-12px; border-radius:5px">
	<a href="#" style="text-decoration: none; color:grey"><h4 align="center" style="padding:10px"> QUICK LINKS</4></a>
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="home.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> Home</h3></a>
	</div>

    <div class="links" style="width:100%; height: 70px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
        <a href="input1.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px">  Add additional Calorie Intake</h3></a>
    </div>

	</div>
</div>



<div class="row" id="test" style="padding-bottom:10px; height:500px; margin-left: 400px; width: 80% ;margin-top: -500px">
    <form class="form-horizontal" id="updateProfileForm" method="post" action="userInfo.php?username=<?php echo $username;?>" enctype="multipart/form-data">
        <div class="col-sm-offset-1 col-sm-4">
            <div class="form-group">
                <div>
                    <br><br><br>

                    <div>
                        <!--<input class="form-control input-sm" id="username" required="true" placeholder="username" name="username" value=<?php //echo $username;?> />-->
                        <p>Username:&nbsp<?php echo $username;?></p>

                    </div>
                    <br>

                    <div>
                        <p>First Name:&nbsp
                            <input class="form-control input-sm" required="true" placeholder="firstname" name="firstname" value=<?php echo $firstname;?> />
                        </p>
                    </div>
                    <br>

                   <div>
                       <p>Last Name:&nbsp
                           <input class="form-control input-sm" required="true" placeholder="lastname" name="lastname" value=<?php echo $lastname;?> />
                       </p>
                   </div>
                    <br>

                   <div>
                       <p>Email:&nbsp
                           <input class="form-control input-sm" required="true" placeholder="email" name="email" value=<?php echo $email;?> />
                       </p>
                   </div>
                    <br>

                   <div>
                       <p>Phone:&nbsp
                           <input class="form-control input-sm" required="true" placeholder="phone" name="phone" value=<?php echo $phone;?> />
                       </p>
                   </div>
                    <br>

                   <div>
                       <p>Gender:&nbsp
                           <select name="gender" required="true" id="gender">
                               <option value="M">Male</option>
                               <option value="F">Female</option>
                           </select>
                       </p>
                   </div>
                    <br>

                   <div>
                       <p>Age:&nbsp
                           <input class="form-control input-sm" required="true" placeholder="age" name="age" value=<?php echo $age;?> />
                       </p>
                   </div>
                    <br>

                   <div>
                       <p>Height:&nbsp
                           <input class="form-control input-sm" required="true" placeholder="height" name="height" value=<?php echo $height;?> />
                       </p>
                   </div>
                    <br>

                   <div>
                       <p>Weight:&nbsp
                           <input class="form-control input-sm" required="true" placeholder="weight" name="weight" value=<?php echo $weight;?> />
                       </p>
                   </div>
                    <br>


                   <div>
                       <p>Lifestyle:&nbsp
                           <select name="lifestyle"  required="true" id="lifestyle">
                               <option value="1.2">Sitting/Lying all day</option>
                               <option value="1.3">Seated work, no exercise</option>
                               <option value="1.4">Seated work, light exercise</option>
                               <option value="1.5">Moderately physical work, no exercise</option>
                               <option value="1.6">Moderately physical work, light exercise</option>
                               <option value="1.7">Moderately physical work, heavy exercise</option>
                               <option value="1.8">Heavy physical work,heavy exercise</option>
                               <option value="2.0">Above average physical work/exercise</option>
                            </select>
                       </p>
                   </div>
                    <br>


                <input class="btn-primary" type="submit" value="Update Profile" form="updateProfileForm" />
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<script type="text/javaScript">
    $('#gender').val('<?php echo $gender;?>');
    $('#lifestyle').val('<?php echo $lifestyle;?>');
    //$("#username").prop('disabled', true);
</script>
</body>
</html>
  

	

	
	
