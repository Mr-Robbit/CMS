
<?php session_start(); ?>
<?php 
$_SESSION['username'] = null;
$_SESSION['user_firstname'] = null; 
$_SESSION['user_email'] = null;
$_SESSION['role'] = null;
$_SESSION['user_id'] = null;

header('Location: ../index.php');

?>