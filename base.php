<?php 
include_once("fetchProfileData.php"); 
//session_start();
//include_once("DBconnect.php");

//$uid=$_SESSION['uid'];
//$firstName=$_SESSION['username'];

    if($gender=='F'){
        $bmr = 655  + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age);
    }else{
        $bmr = 66  + (13.7 * $weight) + (5 * $height) - (6.8 * $age);
    }
    $dailyrequirement = $bmr * $lifestyle;

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
      <a class="navbar-brand" href="home.php">Health Tracker App</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	 
	 <a class="navbar-brand navbar-right" href="Logout.php"><span class="glyphicon glyphicon-user">Logout</span></a>
	 <a class="navbar-brand navbar-right" href="updateProfile.php"><span >Hello <?php echo $username?>  </span></a>
       <form class="navbar-form navbar-right"  method="post" action="search.php" role="search">
        <div class="form-group">
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

<div class="col-12" STYLE="MARGIN-top: -50px">

<div class="tabs"  style="padding:10px; margin-left: 0px; height:1000px; width: 20%; background-color: #f8f8f8">
	
	<div class="links" style="width: 150%;  margin-left: -10px; margin-top: -10px; height: 20px; background-color:#f8f8f8">
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#f8f8f8; margin-top:-12px; border-radius:5px">
	<a href="displaygroups.php" style="text-decoration: none; color:grey"><h4 align="center" style="padding:10px"> QUICK LINKS</4></a>
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#A52A2A; margin-top: -5px; border-radius:5px">
	<a href="home.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> HOME</h3></a>
	</div>
	
	
	<div class="links" style="width:100%; height: 70px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="recommend.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> Recommended Recipes</h3></a>
	</div>

</div>