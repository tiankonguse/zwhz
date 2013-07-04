 <?php
	include_once('inc/check.php');
	require_once("inc/init.php");
	$title = "中外合作办学网站后台管理登录";
	include_once('inc/header.inc.php');
?>

<?php  

$username = mysql_real_escape_string($_SESSION["username"]);
$sql = "SELECT * FROM login_log WHERE login_name =  '$username' ORDER BY id DESC LIMIT 0 , 1";
$result = @mysql_query($sql ,$conn);
if($result && $row=@mysql_fetch_array($result)){
	$lastLoginDate = $row['login_time'];
	$lastLoginIp= $row['login_ip'];
}else{
	$lastLoginDate = "无";
	$lastLoginIp = "无";
}

?>
<div class="manger_top">
	<div class="manger_top_left">
		<a href="./" target="_top">首页</a>&nbsp;&nbsp;|&nbsp;&nbsp;当前用户：&nbsp;<?php echo $_SESSION["username"]; ?>&nbsp;&nbsp;|&nbsp;&nbsp;用户邮箱：&nbsp;<?php echo $_SESSION["email"]; ?>&nbsp;&nbsp;|&nbsp;上次登录时间&nbsp;<?php echo $lastLoginDate; ?>&nbsp;上次登录IP&nbsp;<?php echo $lastLoginIp; ?>&nbsp;
	</div>
	<div class="manger_top_right">
		<a href="logout.php"  target="_top">安全退出</a>
	</div>
</div>
<?php 
	if(isset($_GET['message'])){
		echo "<script>$(function(){showMessage('" . $_GET['message'] . "');});</script>";
	} 
	include_once('inc/footer.inc.php'); 
	require_once("inc/end.php");
?>