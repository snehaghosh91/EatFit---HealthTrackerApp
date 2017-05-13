<?php
/**
 * Created by PhpStorm.
 * User: paritadhandha
 * Date: 5/2/17
 * Time: 6:25 PM
 */
session_start();
if (!isset($_SESSION['user'])) {
    exit(header("Location:index.php",TRUE));
}
unset($_SESSION['user']);
session_unset();
session_destroy();
exit(header("Location:index.php?msg=You%20have%20successfully%20logged%20out.",TRUE));
?>