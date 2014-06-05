<?php
define('MEMORY','128M');
// ini_set('date.timezone',MEMORY);
ini_set('memory_limit','128M');
ini_set('post_max_size','128M');
ini_set('upload_max_filesize','128M');
// ini_set('memory_limit',MEMORY);

date_default_timezone_set('Asia/Shanghai');

//define('DB_HOST','webe.nenu.edu.cn');
define('DB_HOST','localhost');
define('DB_USER','zwhz');
define('DB_PASS','zwhz2013');
define('DB_NAME','zwhz');
define('SALT','zwhz-2013');

// define('DB_HOST','127.0.0.1');
// define('DB_USER','tiankong_zwhz');
// define('DB_PASS','zwhz2013');
// define('DB_NAME','tiankong_zwhz');
// define('SALT','zwhz-2013');



$conn = false;
$result = false;
$ret = connectDB();

function connectDB(){
	global $conn;
	global $result;
	
	//连接mysql
	$conn = @mysql_connect(DB_HOST,DB_USER,DB_PASS);
	if(!$conn)return (output(1,"连接mysql失败,请联系管理员."));

	//设置编码为utf8
	$result = @mysql_query("set names utf8");
	if(!$result)return (output(2,"设置编码为utf8失败,请联系管理员."));


	//设置数据库
	$result = @mysql_select_db(DB_NAME);
	if(!$result)return (output(3,"选择数据库失败,请联系管理员."));
	
	return false;
}

function output($id, $message){
	$ret = array(
			'code' => $id,
			'message' => $message
		    );
	return $ret; 
}

function myintval($lev){
	if(strcmp($lev,"1") == 0 || strcmp($lev,"2") == 0){
		return intval($lev);
	}
	return 0;
}

function getUserLev($username){
	global $conn;
		
	$sql = "SELECT * FROM user WHERE username = '$username'";
	$result = @mysql_query($sql ,$conn);
	if(!$result || mysql_num_rows($result) == 0){
		return output(4,"数据库查询失败");
	}
	if($row=mysql_fetch_array($result)){
		return output(0,$row['lev']);
	}
	return output(7,"查询的用户不存在，可能已被删除，请联系管理员");
}

function getLog($username){
	global $conn;
	
	$sql = "SELECT * FROM login_log WHERE login_name =  '$username' ORDER BY id DESC LIMIT 0 , 1";
	$result = @mysql_query($sql ,$conn);
	if($result && $row=@mysql_fetch_array($result)){
		$lastLoginDate = $row['login_time'];
		$lastLoginIp= $row['login_ip'];
	}else{
		$lastLoginDate = "无";
		$lastLoginIp = "无";
	}
	return 	array(
			'data' => $lastLoginDate,
			'ip' => $lastLoginIp
		    );
}	

?>
