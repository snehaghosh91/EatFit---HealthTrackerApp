

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require 'vendor/autoload.php';

$received_data=json_decode($_POST['json_data'],true);
//$received_data = preg_replace('/\\\\\"/',"\"", $received_data);

//echo json_decode($_POST['json_data']);
$credentials = new \Aws\Credentials\Credentials('AKIAJYF5OFJ4BOWSM2VA', 'OG6cOnSLJQnI+nW0VgXjg7ystQ9C22V8BXjVATG6');
$signature = new \Aws\Signature\SignatureV4('es', 'us-west-2');

$middleware = new \Wizacha\Middleware\AwsSignatureMiddleware($credentials, $signature);
$defaultHandler = \Elasticsearch\ClientBuilder::defaultHandler();
$awsHandler = $middleware($defaultHandler);

$clientBuilder =  \Elasticsearch\ClientBuilder::create();

$clientBuilder
    ->setHandler($awsHandler)
    ->setHosts(['search-priyanshi-35mcs4sifteslgsqi5i7zvfzpi.us-west-2.es.amazonaws.com:80'])
;
 $client = $clientBuilder->build();

/*$result = $client->index([
    'index' => 'myindex',
    'type' => 'tweets',
    'body' => [
        'username' => 'Priyanshi',
        'sentiment' => 'SUPER_ANGRY',
        'tweetmessage' => 'in person mila karo for errors!',
        'my_id' => 'trump'
    ]
]);*/

/*foreach ($received_data as $key => $value)
{

}  */

$result = $client->index([
    'index' => 'finalindexrecipe',
    'type' => 'recipes',
    'body' => $received_data
]);

//var_dump($result);
//foreach($received_data as $value)
//{
//    echo sprintf('%s',$value->hits->0->recipe->calories);
//}

echo $received_data["hits"][0]["recipe"]["calories"];
?>
