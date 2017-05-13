<?php
session_start();
//error_reporting(E_ERROR | E_PARSE);
//include_once("DBconnect.php");
include_once("fetchProfileData.php");
//$username=$_SESSION['username'];
//$firstName=$_SESSION['firstname'];

    if($gender=='F'){
        $bmr = 655  + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age);
    }else{
        $bmr = 66  + (13.7 * $weight) + (5 * $height) - (6.8 * $age);
    }
    $dailyrequirement = $bmr * $lifestyle;
 $datetoday = date("Y-m-d");
$sqlc = "SELECT sum(calories) as c from recipeeaten where username='$username' and eatendate = '$datetoday' order by mealid ASC " ;
 //, recipe_photo.photo as photo from review natural join recipe_photo where photoid=1
		$resultc = mysqli_query($conn, $sqlc);
		while($rowc = mysqli_fetch_assoc($resultc)) {
			$r = $rowc["c"];
		}

		//echo $r;

    ?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
	
	<meta charset="UTF-8">

<style>

.button{
	background-color: #DEB887; 
	border-radius:15px
}
.button:hover{
	background-color: white;
	border: #DEB887 solid 1px;
	
}

 h4.titles{
		color: #777;
		font-size: 17px;
        font-family: 'PT Sans';
		margin-top: -10px;
		}
		
		
   h3.recipetext{
		color: #000;
		font-size: 17px;
        font-family: 'PT Sans';
		margin-top: -10px;
		}
		
 recipe{
	height: 200px;
	width: 200px; margin-left: 25px;
	margin-top: 25px;
	}

 body {
        background: #f8f8f8;
        width: 100%;
        margin-top: 10px;
    }

.row::after {
    content: "";
    clear: both;
    display: block;
	
}
[class*="col-"] {
    float: left;
    padding: 15px;
	

}
.col-0 {width: 1%;}
.col-1 {width: 8.33%;}
.col-2 {width: 13.66%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 70%;}
.col-11 {width: 91.66%;
}
.col-12 {width: 85%;}

.handonhover { cursor: pointer; cursor: hand; }

</style>	
</head>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">


<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<style>
table tr {
	border-left: 1px solid #000;
 
}
</style>



<body>

<nav class="navbar navbar-default navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">EatFit</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	 
	 <a class="navbar-brand navbar-right" href="logout.php"><span class="glyphicon glyphicon-user">Logout</span></a>
	 <a class="navbar-brand navbar-right" href="updateProfile.php"><span >Hello <?php echo $username?>  </span></a>
       <form class="navbar-form navbar-right"  method="post" action="search.php" role="search">
        <div class="form-group">
            <input type="text" class="form-control" name="fromcal" placeholder="from Calories">
            <input type="text" class="form-control" name="tocal" placeholder="to Calories">
            <input type="text" class="form-control" name="key" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
	   <div class="navbar-header">
     
	  </div>
	  
      
  </div><!-- /.container-fluid -->
</nav>
</nav> 
<br>
<br>

<div class="col-3" STYLE="MARGIN-top: -50px">

<div class="tabs"  style="padding:10px; margin-left: 0px; height:1000px; background-color: #f8f8f8">
	
	<div class="links" style="width: 100%;  margin-left: -10px; margin-top: -10px; height: 20px; background-color:#f8f8f8">
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#f8f8f8; margin-top:-12px; border-radius:5px">
	<a href="#" style="text-decoration: none; color:grey"><h4 align="center" style="padding:10px"> QUICK LINKS</4></a>
	</div>

	
	<div class="links" style="width:100%; height: 70px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="recommend.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> Recommended Recipies</h3></a>
	</div>


	<div class="links" style="width:100%; height: 70px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="input1.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px">  Add additional Calorie Intake</h3></a>
	</div>
</div>
</div>
<br><br><br><br>
<div class="col-7" STYLE="MARGIN-top: -150px">
    <div class="row" id="test" align="center" style="padding-bottom:10px; margin-left: 20px; width: 100%; margin-top: 00px">

            <div class="title"><h2> </h2></div>
            <div class="datatablediv" align="center" style="width: 600px; margin-left:0px;">


                <fieldset>
                    <br><br>
                    <h4> Your BMR is <?php echo $bmr?></h4>
                    <h4>You require  <?php echo $dailyrequirement ?> calories per day</h4>
                    <h4>You have consumed  <?php echo $r ?> calories today.</h4>

                    <h4>You require  <?php echo $dailyrequirement-$r ?> calories to finish reach your daily diet.</h4>
                </fieldset>
            </div>

    </div>

<br><br>


<div class="datatablediv" style="width: 800px; margin-left:0px;">
<fieldset>
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>MealType</th>
                <th>Photo</th>
                <th>Recipe Name</th>
                <th>Calories</th>
            </tr>
        </thead>
		  <tbody>
 <?php

 $datetoday = date("Y-m-d");

$sqlc = "SELECT sum(calories) as c from recipeeaten where username='$username' and eatendate = '$datetoday' order by mealid ASC " ;
 //, recipe_photo.photo as photo from review natural join recipe_photo where photoid=1
		$resultc = mysqli_query($conn, $sqlc);
		while($rowc = mysqli_fetch_assoc($resultc)) {
			$r = $rowc["c"];
		}



 $sql = "SELECT * from recipeeaten where username='$username' and eatendate = '$datetoday' order by mealid ASC " ;
 //, recipe_photo.photo as photo from review natural join recipe_photo where photoid=1
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
//			$rid=$row["rid"];
//			$query = "SELECT AVG(stars) as stars from review where rid=$rid";
//			$resultstars = mysqli_query($conn, $query);
//			$starsarray = mysqli_fetch_assoc($resultstars);
//			$stars = round($starsarray['stars']);
            $label = $row['label'];
            $meal= $row['meal'];
            $calories = $row['calories'];
            $photo=$row['photo'];


 ?>


            <tr>

                <td align="center">
                    <?php
                    echo $meal;
                    ?>
                </td>

                <td align="center">
				<?php
				if($row["photo"]!=null)

					{
                        echo  '<img src="'.$photo.'" width="100" height="100">';
					}
					else{
						echo "no photo available";
					}
				?>
				</td>

                <td align="center">
				<?php
				echo $label
                ?>
				</td>

				<td align="center">
				<?php
				 echo $calories;
				?>
                </td>
            </tr>

		<?php
		}
		}
		?>

        </tbody>
    </table>
	</fieldset>
	</div>


</div>


</div>



</body>
<script>
		$(document).ready(function() {
    $('#example').DataTable( {
        responsive: true
    } );
} );
	</script>

	
</html>