<?php
session_start();
if(!isset($_SESSION["login_sno"])){
header("Location: index.php");
exit(); }
?>