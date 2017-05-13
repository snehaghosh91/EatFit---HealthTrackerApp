<?php

/**
 * Created by PhpStorm.
 * User: paritadhandha
 * Date: 4/30/17
 * Time: 9:56 PM
 */

session_start();



if(isset($_SESSION["username"])){
    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <title>Index</title>

    <style type="text/css">
        /* Bordered form */
        form {
            border: 3px solid #f1f1f1;
        }

        /* Full-width inputs */
        input[type=text], input[type=password], input[type=email] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Set a style for all buttons */
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        /* Add a hover effect for buttons */
        button:hover {
            opacity: 0.8;
        }

        /* Extra style for the cancel button (red) */
        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        /* Center the avatar image inside this container */
        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        /* Avatar image */
        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        /* Add padding to containers */
        .container {
            padding: 16px;
        }

        /* The "Forgot password" text */
        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
            .cancelbtn {
                width: 100%;
            }
        }
    </style>

    <script type="text/javascript">
        function validate(){
          /*  var x = document.forms["registration"]["email"].value;
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");
            if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                window.alert("Not a valid e-mail address");
                return false;
            }*/
            var pwd=document.forms["registration"]["password"].value;
            var cpwd=document.forms["registration"]["confirmpassword"].value;

            //window.alert(pwd+"       "+cpwd+"        "+pwd.localeCompare(cpwd));
            if(pwd.localeCompare(cpwd)!=0){
                document.getElementById("pwdmatch").innerHTML="Passwords do not match.";
                //window.alert("Passwords do not match.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<form name="registration" action="add_user.php" method="post" onsubmit="return validate();">

    <div class="container">
        <input required='true' type="text" name="username" placeholder="Username" />  <br>
        <input type="password" required='true' name="pass" placeholder="Password" />
        <input type="password" required='true' name="pass2" placeholder="Confirm Password" /><br/><br>
        <input required='true' type="text" name="firstname" placeholder="First Name" />
        <input  type="text" required='true' name="lastname" placeholder="Last Name" /><br>
        <input required='true' type="email" name="email" placeholder="Email" />  <br>
        <input required='true' type="text" name="phone" placeholder="Phone" />  <br>
        <input  type="text" required='true' name="age" placeholder="Age" /><br><br>
        <input  type="text" required='true' name="height" placeholder="Height (in cm)" /><br> <br>
        <input  type="text" required='true' name="weight" placeholder="Weight (in kg)" /><br><br>
        <div>
            <p>Gender:&nbsp
                <select name="gender" required="true" id="gender">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </p>
        </div>

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

        <label id="pwdmatch"><b></b></label>
        <button type="submit">Register</button>
        <!--
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
        <?php
        if(isset($_GET['emailError'])){
            echo "<font color='red'><label><b>".$_GET['msg']."</b></label></font>";
        }?>
        <label><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <label><b>Confirm Password</b></label>
        <input type="password" placeholder="Enter Password Again" name="confirmpassword" required>

        <label id="pwdmatch"><b></b></label>
        <button type="submit">Register</button>
        -->

    </div>
    <?php
    if(isset($_GET['msg'])){
        echo "<font color='red'><label><b>".$_GET['msg']."</b></label></font>";
    }?>
    <a href="index.php">Already a User? Click Here to Sign In</a>

</form>
</body>
</html>