<?php
require_once("inc/init.php");
$title = "中外合作办学网站";
include_once('inc/header.inc.php');
?>

<div id="test"></div>

<script>

$(document).ready(function(){
	var Sys = {};
	var ua = navigator.userAgent.toLowerCase();
	if (window.ActiveXObject)Sys.ie = ua.match(/msie ([\d.]+)/)[1];
	if(Sys.ie && Sys.ie<=7.0) document.write('IE: '+Sys.ie);
});


</script>


<?php include_once('inc/footer.inc.php'); ?>

