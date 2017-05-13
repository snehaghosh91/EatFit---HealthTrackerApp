<?php
session_start();
include_once("base.php");
require 'DBconnect.php';
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include_once("fetchProfileData.php");
$arg_user = $username;

function match_ings($ings1, $ings2) {
  $num_match = count(array_intersect($ings1, $ings2));
  $percent1 = $num_match*100/count($ings1);
  $percent2 = $num_match*100/count($ings2);
  if ($percent1 > $percent2) {
    return $percent1;
  }
  return $percent2;
}

$sql = "SELECT username, label, calories, photo from recipeeaten";
$result = $conn->query($sql);

$recipe_info = array();

$user_recipes = array();
while ($result_array = mysqli_fetch_assoc($result)) {
  $user = $result_array['username'];
  $label = strtolower($result_array['label']);
  $recipe_info[$label] = array();
  $recipe_info[$label]['calories'] = $result_array['calories'];
  $recipe_info[$label]['photo'] = $result_array['photo'];
  if (array_key_exists($user, $user_recipes)) {
    if (!in_array($label, $user_recipes[$user])) {
      array_push($user_recipes[$user], $label);
    }
  } else {
    $user_recipes[$user] = array($label);
  }
}
//print_r($recipe_info);

$sql = "SELECT label, ingredient from recipeingredient";
$result = $conn->query($sql);

$recipe_ing = array();
while ($result_array = mysqli_fetch_assoc($result)) {
  $recipe = strtolower($result_array['label']);
  $ing = str_replace(",", "", $result_array['ingredient']);
  $words = preg_split('/\s+/', $ing);
  foreach ($words as $word) {
    $word = strtolower($word);
	  $ing = $result_array['ingredient'];
	  if (array_key_exists($recipe, $recipe_ing)) {
	    if (!in_array($word, $recipe_ing[$recipe])) {
	      array_push($recipe_ing[$recipe], $word);
	    }
	  } else {
	    $recipe_ing[$recipe] = array($word);
	  }
  }
}

// Two recipes are considered to be matched if at least these many ingredients matched.
$percent_ing_matched = 30;

$arg_user_recipe_list = $user_recipes[$arg_user];

$user_recipe_matches = array();
foreach($user_recipes as $user => $recipe_list) {
  if ($user == $arg_user) continue;
  foreach($recipe_list as $recipe) {
    $recipe = strtolower($recipe);
    $score = 0;
    foreach($arg_user_recipe_list as $arg_user_recipe) {
      $arg_user_recipe = strtolower($arg_user_recipe);
      $percent_matches = match_ings($recipe_ing[$recipe],
				    $recipe_ing[$arg_user_recipe]);
      if ($percent_matches < $percent_ing_matched) {
        continue;
      }
      if ($score < $percent_matches) {
        $score = $percent_matches;
      }
    }
    if ($score > 0) {
      $count_arr = count($user_recipe_matches[$user]);
      if ($count_arr > 0) {
        $recipe_score = array($recipe, $score);
        array_push($user_recipe_matches[$user], $recipe_score);
      } else {
        $user_recipe_matches[$user] = array(array($recipe, $score));
      }
    }
  }
}

$recommended_recipes = array();
$recipe_users = array();
foreach($user_recipe_matches as $user => $recipe_score_list) {
  foreach($recipe_score_list as $recipe_score) {
    $recipe = $recipe_score[0];
    $score = $recipe_score[1];
    if ($score == 100) continue;
    $recommended_recipes[$recipe] = $score;

    if (array_key_exists($recipe, $recipe_users)) {
      array_push($recipe_users[$recipe], $user);
    } else {
      $recipe_users[$recipe] = array($user);
    }
  }
}
arsort($recommended_recipes);
//print_r($recommended_recipes);
//echo "<br>";
//print_r($recipe_users);
?>

<div class="row" id="test" align="center" style="padding-bottom:10px; margin-left: 180px; width: 100%; background-color: #f8f8f8; margin-top: -1000px">
        <div class="col-6" style="margin-left: 20px" id="test" style=" background-color: #f8f8f8">

<div id="main-content" class="container">
    <h2 class="text-center menu-title">Recommendations</h2>
    <div id="menu-item"> 
      
      
  <?php
  $count = 0;
  foreach ($recommended_recipes as $recipe => $score) {
    if($count %3 == 0){
      echo "<div class='row'>";
    }
    
      echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>";
      ?>
      <img class="recipeimg" id="<?php echo $recipe; ?>" src="<?php echo $recipe_info[$recipe]["photo"]; ?>" height="300" width="300"/><br/>
      <?php
      echo "<h3><b>".strtoupper($recipe)."</b></h3> <div> <h4>Calories: ".$recipe_info[$recipe]["calories"]." <h4></div>";
      echo "<b>Liked by &nbsp;</b>";
      foreach ($recipe_users[$recipe] as $key => $value) {
        echo $value;
        echo "&nbsp;";
      }
      echo "</div>";
      if(($count+1) %3 == 0){
      echo "</div>";
    }
      $count += 1;
  }
  ?>
  </div>
  </div>
  </div>
  </div>
<script type="text/javascript">

  $(document).ready(function(){
  $('.recipeimg').click(function() {
     var label = $(this).attr('id');
     window.location.href = "recipedetail.php?recipename="+label;
       return false;
  });
  });
</script>
