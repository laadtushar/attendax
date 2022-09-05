<?php

session_start();

$_SESSION['db_user_name'] = null;
$_SESSION['db_user_role'] = null;
$_SESSION['flashMessage'] = 'Succesfully Logged Out';
header("location: ../index.php");

?>