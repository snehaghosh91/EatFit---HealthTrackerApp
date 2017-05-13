
<?php
//session_start();
include_once("DBconnect.php");
include_once("fetchProfileData.php");
//$input = "green";
$calgte=$_POST["fromcal"];
$callte =$_POST["tocal"];

if ($calgte==null)
{
    $calgte=0;
}

if ($callte==null)
{
    $callte=99999;
}

//error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'Unirest.php';
require 'vendor/autoload.php';
$input=$_POST["key"];

//echo $_POST["fromcal"];
//echo $_POST["tocal"];

/*
if($input != null) {
    $response = Unirest\Request::get("https://edamam-recipe-search-and-diet-v1.p.mashape.com/search?_app_id=&_app_key=&q=" . $input,
        array(
            "X-Mashape-Key" => "WoCeEXLrQ4mshPcOMkJ5dSZ5TTu8p13JtYTjsntfFzh2nMEF6I",
            "Accept" => "application/json"
        )
    );
}
*/

if($input == null) {
    $input = "<required>";
}


if($callte != null || $calgte != null)
{//if cal from 600
    //echo("in not null");
    if ($callte == null && $calgte != null) {
        $response = Unirest\Request::get("https://edamam-recipe-search-and-diet-v1.p.mashape.com/search?_app_id=&_app_key=&calories=gte+" . $calgte . "&q=" . $input,
            array(
                "X-Mashape-Key" => "WoCeEXLrQ4mshPcOMkJ5dSZ5TTu8p13JtYTjsntfFzh2nMEF6I",
                "Accept" => "application/json"
            )
        );
       // echo "in if";
       //echo $response;
    }

//if cal to 600
    if ($callte != null && $calgte == null) {
        $response = Unirest\Request::get("https://edamam-recipe-search-and-diet-v1.p.mashape.com/search?_app_id=&_app_key=&calories=lte+" . $callte . "&q=" . $input,
            array(
                "X-Mashape-Key" => "WoCeEXLrQ4mshPcOMkJ5dSZ5TTu8p13JtYTjsntfFzh2nMEF6I",
                "Accept" => "application/json"
            )
        );
    }
//if cal from 400 to 600
    if ($callte != null && $calgte != null) {
        //echo "in";
        $response = Unirest\Request::get("https://edamam-recipe-search-and-diet-v1.p.mashape.com/search?_app_id=&_app_key=&calories=gte+" . $calgte . "%2C+lte+" . $callte . "&q=" . $input,
            array(
                "X-Mashape-Key" => "WoCeEXLrQ4mshPcOMkJ5dSZ5TTu8p13JtYTjsntfFzh2nMEF6I",
                "Accept" => "application/json"
            )
        );
    }
}
else
{
    echo "in else";
    $response = Unirest\Request::get("https://edamam-recipe-search-and-diet-v1.p.mashape.com/search?_app_id=&_app_key=&q=" . $input,
        array(
            "X-Mashape-Key" => "WoCeEXLrQ4mshPcOMkJ5dSZ5TTu8p13JtYTjsntfFzh2nMEF6I",
            "Accept" => "application/json"
        )
    );
}
$recipes = array();
foreach($response->body->hits as $rcp) {
    // $filtered_rcp = filterrecipe($rcp);
    array_push($recipes, $rcp);
}
$filteredrecipe = array();
// // print_r($recipes);
 $index = 0;
foreach ($recipes as $rcpe) {
    $recipe3 = array();
    foreach ($rcpe->recipe as $rpc => $val){

        if($rpc == 'label'){
            $recipe3[$rpc] = $val;
        }
        if($rpc == 'image'){
            $recipe3[$rpc] = $val;
        }
        if($rpc == 'calories'){
            $recipe3[$rpc] = $val;
        }

    }
    $filteredrecipe[$index] = $recipe3;
    $index += 1;
}
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
      <a class="navbar-brand" href="home.php">EatFit</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	 
	 <a class="navbar-brand navbar-right" href="Logout.php"><span class="glyphicon glyphicon-user">Logout</span></a>
	 <a class="navbar-brand navbar-right" href="updateProfile.php"><span >Hello <?php echo $firstname?>  </span></a>
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
	  
      
  </div>
</nav>

</head>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<style>
table tr {
	border-left: 1px solid #000;
 
}
</style>


	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
</head>
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>


<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
  <script type="text/javascript">
    $(document).ready(function () {
        $('#table_id').dataTable();
    });
</script>
  </script>
</body>

<body>
<br>
<br>

<div class="links" style="width:1200px; height: 50px; background-color:#f8f8f8; margin-top:-12px; margin-left:10px; border-radius:5px">
	

<div class="links" style="width:200px; height: 50px; background-color:white; margin-top:-12px; border-radius:5px">
	<a href="#.php" style="text-decoration: none; color:grey"><h4 align="center" style="padding:10px"> QUICK LINKS</4></a>
	</div>


<div class="links" style="width:200px; height: 50px; background-color:#A52A2A; float:left; border-radius:5px">
	<a href="home.php" style="text-decoration: none; color:white"><h4 align="center" style="padding:10px"> Home</h4></a>
	</div>

	<br>
	<br>
	<br>
	
<div class="links" style="width:200px; height: 50px; background-color:#A52A2A; float:left; border-radius:5px">
	<a href="recommend.php" style="text-decoration: none; color:white"><h4 align="center" style="padding:10px"> Recommendations</h4></a>
	</div>
<br>
<br>
<br>

	
</div>
	<div class="row" id="test" style="padding-bottom:10px; margin-left: 180px; width: 100%; background-color: #f8f8f8; margin-top: -50px">
	<div class="typename"  style="padding-left:500px ; padding-top: -50px; margin-bottom: -20px">
			<p><b><h3 class="titles"> ALL RECIPES: </h3></b></p>
			</div>	
			<br>
			<br>
			<br>
	
<div class="datatablediv" style="width: 800px; margin-left:250px;">
<fieldset>
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th align="center">Photo</th>
                <th align="center">Name</th>
                <th align="center"> Calories</th>
            </tr>
        </thead>
		  <tbody>
 <?php

		for($i=0;$i<10;$i++){
            if($filteredrecipe[$i]["calories"]>=$calgte && $filteredrecipe[$i]["calories"] <=$callte)
            {
        ?>  


		  
            <tr>
			
                <td align="center">
				<?php
				if($filteredrecipe[$i]["image"]!=null)

					{
                        $temp = $filteredrecipe[$i]["image"];
                        //echo $temp;
                        echo  '<img src="'.$temp.'" width="100" height="100">';
					}
					else{
						echo "no photo available";
					}
				?>
				</td>

                <td align="center">
                <a href="recipedetail.php?recipename=<?php echo $filteredrecipe[$i]['label']?>">
				<?php
				echo $filteredrecipe[$i]["label"];?>
				</h3>
                </a>
				</td>


                <td align="left">
                <?php
                echo intval($filteredrecipe[$i]["calories"])?>
                
                </h3>
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
	
	</body>
	<script>
		$(document).ready(function() {
    $('#example').DataTable( {
        responsive: true
    } );
} );
	</script>
	
</html>