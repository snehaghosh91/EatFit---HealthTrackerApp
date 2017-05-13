
<?php

//session_start();
include_once("base.php");
include_once("detchProfileData.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'Unirest.php';
require_once 'Inflect.php';
//$querystring = $_SERVER['QUERY_STRING'];
$recipename = $_GET["recipename"];
//$recipename = urldecode(str_replace("label=", "", $querystring));
$response = Unirest\Request::get("https://edamam-recipe-search-and-diet-v1.p.mashape.com/search?_app_id=a71c2316&_app_key=&q=".$recipename,
  array(
    "X-Mashape-Key" => "",
    "Accept" => "application/json"
  )
);

?>

<div class="row" id="test" align="center" style="padding-bottom:10px; margin-left: 180px; width: 100%; background-color: #f8f8f8; margin-top: -1000px">
        <div class="col-6" style="margin-left: 300px" id="test" style=" background-color: #f8f8f8">
            <div class="title"><h2> </h2></div>
            <div class="datatablediv" align="center" style="width: 600px; margin-left:0px;">
            <?php
				foreach($response->body->hits[0]->recipe as $rcp => $val){
					
					if($rcp == 'label'){
						$recipename = $val;
						echo "<h2>".strtoupper($val)."</h2> <br> ";
					}
					if($rcp == 'url'){
						$orig_url = $val;
						
					}
					if($rcp == 'calories'){
						$calories = $val;
						echo "<h3>Calories ".$calories."</h3> <br> ";
						
					}
					if($rcp == 'image'){
						$img = $val;
						echo "<img src='".$val."' /> <br> <h3> Ingredients:</h3> ";
						
					}
					if($rcp == 'ingredientLines'){
						foreach ($val as $line) {
							echo $line."<br>";
						}
						
					}
					
					
				}
				echo "<a href=".$orig_url." target='_blank'>More Info</a> <br>";
			?>
                <fieldset>
                    <br><br>
                    
                </fieldset>
            </div>
        </div>
    

<?php
$ingredients = array();
foreach($response->body->hits[0]->recipe->ingredients as $ing) {
  array_push($ingredients, Inflect::singularize($ing->food));
}


// Your AWS Access Key ID, as taken from the AWS Your Account page
$aws_access_key_id = "";

// Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
$aws_secret_key = "";

// The region you are interested in
$endpoint = "webservices.amazon.com";

$uri = "/onca/xml";

$ingredient_asin = array();

foreach($ingredients as $ing) {
	$query = $ing;
	$params = array(
	    "Service" => "AWSECommerceService",
	    "Operation" => "ItemSearch",
	    "AWSAccessKeyId" => "AKIAJO3WGAWPDPN2AKHA",
	    "AssociateTag" => "recipesearc04-20",
	    "SearchIndex" => "Grocery",
	    "Keywords" => $query,
	    "ResponseGroup" => "Images,ItemAttributes,OfferFull",
	    "Availability" => "Available"
	);

	// Set current timestamp if not set
	if (!isset($params["Timestamp"])) {
	    $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
	}

	// Sort the parameters by key
	ksort($params);

	$pairs = array();

	foreach ($params as $key => $value) {
	    array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
	}

	// Generate the canonical query
	$canonical_query_string = join("&", $pairs);

	// Generate the string to be signed
	$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;

	// Generate the signature required by the Product Advertising API
	$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));

	// Generate the signed URL
	$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

	if (($response_xml_data = file_get_contents($request_url))===false){
	    echo "Error fetching XML\n";
	} else {
	   libxml_use_internal_errors(true);
	   $data = simplexml_load_string($response_xml_data);
	   if (!$data) {
	       echo "Error loading XML\n";
	       foreach(libxml_get_errors() as $error) {
	           echo "\t", $error->message;
	       }
	   }
	}

	$query = strtolower($query);
	$query_words = explode(" ", $query);

	$result_asins = array();
	$full_result_asin = '';

	foreach($data->Items->Item as $item) {
	  if (empty($item->ItemAttributes->ListPrice)) {
	    continue;
	  }
	  $asin = $item->ASIN;
	  $all_match = true;
	  $num_matches = 0;
	  foreach($query_words as $word) {
	    $match = false;
	    foreach($item->ItemAttributes->Feature as $feature) {
	      $feature = strtolower($feature);
	      if (strpos($feature, $word) !== false) {
	        $match = true;
	        break;
	      }
	    }
	    if (strpos(strtolower($item->ItemAttributes->Label), $word) !== false) {
	      $match = true;
	    }
	    if (strpos(strtolower($item->ItemAttributes->Manufacturer), $word) !== false) {
	      $match = true;
	    }
	    if (strpos(strtolower($item->ItemAttributes->Publisher), $word) !== false) {
	      $match = true;
	    }
	    if (strpos(strtolower($item->ItemAttributes->Studio), $word) !== false) {
	      $match = true;
	    }
	    if (strpos(strtolower($item->ItemAttributes->Title), $word) !== false) {
	      $match = true;
	    }
	    if ($match == false) {
	      $all_match = false;
	    } else {
	      $num_matches += 1;
	    }
	  }
	  if ($all_match == true) {
	    $full_result_asin = $asin;    
	    break;
	  }
	  $result_asins[(string) $asin] = $num_matches;
	}

	$result = '';

	if ($full_result_asin !== '') {
	  $result = $full_result_asin;
	} else {
	  $max_val = 0;
	  $max_key = '';
	  while(list($key, $val) = each($result_asins)) {
	    if ($val > $max_val) {
	      $max_val = $val;
	      $max_key = $key;
	    }
	  }
	  $result = $max_key;
	}
	if($result != ''){
		$ingredient_asin[$ing] = $result;
	}
}
if(empty($ingredient_asin)){
	echo "Sorry the items are not available on Amazon<br>";
	exit;
}

$cart_params = array(
    "Service" => "AWSECommerceService",
    "Operation" => "CartCreate",
    "AWSAccessKeyId" => "AKIAJO3WGAWPDPN2AKHA",
    "AssociateTag" => "recipesearc04-20",
    "ResponseGroup" => "Cart"
);
$item_index = 1;
foreach ($ingredient_asin as $key => $value) {
	$itemkey = "Item.".$item_index.".ASIN";
	$cart_params[$itemkey] = $value;
	$qntykey = "Item.".$item_index.".Quantity";
	$cart_params[$qntykey] = 1;
	$item_index += 1;
}

// print_r($cart_params);
// Set current timestamp if not set
if (!isset($cart_params["Timestamp"])) {
    $cart_params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
}

// Sort the parameters by key
ksort($cart_params);

$cart_pairs = array();

foreach ($cart_params as $key => $value) {
    array_push($cart_pairs, rawurlencode($key)."=".rawurlencode($value));
}

// Generate the canonical query
$canonical_query_string = join("&", $cart_pairs);

// Generate the string to be signed
$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;

// Generate the signature required by the Product Advertising API
$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));

// Generate the signed URL
$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);
if (($response_xml_data = file_get_contents($request_url))===false){
    echo "Error fetching XML\n";
} else {
   libxml_use_internal_errors(true);
   $data = simplexml_load_string($response_xml_data);
   if (!$data) {
       echo "Error loading XML\n";
       foreach(libxml_get_errors() as $error) {
           echo "\t", $error->message;
       }
   }
}

$purchase_url = $data->Cart->PurchaseURL;
?>
<br>
<div class="col-6" style="margin-left: 300px" id="test" style=" background-color: #f8f8f8">
<a href="<?php echo $purchase_url ?>" target="_blank">Place Order!</a>
</div>
<div>
	<input type="button" onclick="myFunction('breakfast', 0)" value="Mark for Breakfast" /> 
</div>
<div>
	<input type="button" onclick="myFunction('lunch', 1)" value="Mark for lunch" />
</div>
<div>
	<input type="button" onclick="myFunction( 'dinner', 2)" value="Mark for Dinner" />

</div>

<input type="hidden" id="img" value='<?php echo $img ?>' />
<input type="hidden" id="calories" value='<?php echo $calories ?>' />
<input type="hidden" id="rname" value='<?php echo $recipename ?>' />
<script type="text/javascript">

	function myFunction(meal, mealid) {
		img = document.getElementById('img').value;
		recipename = document.getElementById('rname').value;
		calories = document.getElementById('calories').value;
		var mark = $.post('markrecipe.php', { recipename:recipename, meal: meal, mealid:mealid, img:img, calories:calories});
		
	}
</script>
</div>