<?php
/**
 * Created by PhpStorm.
 * User: paritadhandha
 * Date: 5/3/17
 * Time: 11:33 PM
 */
?>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
    <title>Recipe Search</title>
</head>


<body>
</body>
<script type="text/javascript">
    function NameAFunctionName() {
        var input='green vegetables';

        $.ajax({
            url: 'https://api.edamam.com/search?_app_id=a71c2316&_app_key=5ecc533f4060bb7af8a39652a353c693	—&q='+input,
            type: 'GET',
            dataType: 'json',
            data : {},
            //headers: {
            //WRITE IF THEIR HAVE SOME HEADER REQUEST OR DATA
            //    'X-Mashape-Key': 'xtBmhyFqj9mshwev6YTnCueBgFN6p1ODqSejsnzxlBxhpMVSEJ',
            //    'Accept': 'application/json'
            //},
            crossDomain: true,
            success: function (data, textStatus, xhr) {
                console.log(data);
                fun(data);

                //output=data;
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });

        //$('#output').innerHTML(output);
    }
    function fun(json_obj) {
        document.getElementById("output").innerHTML=json_obj["hits"][0]["recipe"]["calories"];
        $.ajax({
            url: 'test.php',
            type: 'POST',
            dataType: 'text',
            //contentType: "application/json; charset=utf-8",
            //contentType: 'json',
            data : {json_data:JSON.stringify(json_obj)},
            //data : {json_data:json_obj},
            crossDomain: true,
            success: function (data) {
                document.getElementById("output").innerHTML=data;

                //output=data;
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }


</script>
<div id="output"></div>
<script type="text/javascript">
    NameAFunctionName();
</script>
</html>


