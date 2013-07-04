 <?php
 
 /*
	inc/manger.ajax.php?mangercode=2
	showMessage(d.message,function(){window.location="mangerUser.php";},4000);
	定义一个操作
	login.check.php   => 1
	alterUsername.php => 2
	alterPassword.php => 3
	alterInfo.php     => 4
	deleteUser        => 5
	addNewUser.php    => 6
	deleteContent     => 7
	updateContent     => 8
	addContent        => 9
	deleteFriendLink  => 10
	addFriendLink     => 11
	deleteImg         => 12
	addImg            => 13
*/
 
session_start();
require_once("init.php");
require_once("JSON.php");
$json = new Services_JSON();
require_once("manger.fun.php");

if(!isset($_GET["mangercode"])){
	$ret = output(14,"非法操作");
	echo $json->encode($ret);
}else{
	$code = $_GET["mangercode"];
	if(!$ret && $code != 1){
		if(!isset($_SESSION["username"]) || $_SESSION["username"]==""){
			$ret = output(9,"请先登录在操作");
		}
	}
	
	if((!$conn || !$result) && $ret){
		echo $json->encode($ret);
	}else{
		switch($code){
			case 1:echo $json->encode(login());break;
			case 2:echo $json->encode(alterUsername());break;
			case 3:echo $json->encode(alterPassword());break;
			case 4:echo $json->encode(alterInfo());break;
			case 5:echo $json->encode(deleteUser());break;
			case 6:echo $json->encode(addNewUser());break;
			case 7:echo $json->encode(deleteContent());break;
			case 8:echo $json->encode(updateContent());break;
			case 9:echo $json->encode(addContent());break;
			case 10:echo $json->encode(deleteFriendLink());break;
			case 11:echo $json->encode(addFriendLink());break;
			case 12:echo $json->encode(deleteImg());break;
			case 13:echo $json->encode(addImg());break;
		}
	}
}




require_once("end.php");
?>

