<?php
session_start();
if(!isset($_SESSION["username"]) || $_SESSION["username"]==""){
	header("location:login.php");
	die();
}
?>