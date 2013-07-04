 
<?php
function login(){
	global $conn;
	
	if(isset($_POST['username']) && isset($_POST['password'])){
		$username = mysql_real_escape_string($_POST['username']);
		$password = sha1(SALT . $_POST['password']);
		
		$sql = "select * from user where username = '$username' and password = '$password'";
		$result = @mysql_query($sql ,$conn);
		if($result && mysql_num_rows($result) > 0 && $row=mysql_fetch_array($result)){
			
			
			$_SESSION['username'] = $username;
			$_SESSION['email'] = $row['email'];
			$_SESSION['lev'] = $row['lev'];
			$_SESSION['password'] = $row['password'];

			$logintime = mysql_real_escape_string(date("Y-m-d H:i:s"));
			$loginip = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
			$sql = "INSERT INTO `login_log`(`login_name`, `login_time`, `login_ip`) VALUES ('$username','$logintime','$loginip')";
			$result = @mysql_query($sql ,$conn);
		
			//if(!$result)return output(5,"插入登录日志错误");
			
			return output(0,"登录成功");
		 }else{
			return output(12,"用户名或密码错误");
		 }

		
	}else{
		return output(6,"表单填写不完整，加*的必须填写");
	}
}


function alterUsername(){
	global $conn;

	if(isset($_POST['newUsername']) && isset($_POST['username_pass'])){
		//检查表单数据
		$oldUsername = trim($_SESSION["username"]);
		$newUsername = trim($_POST['newUsername']);
		
		if(strcmp($newUsername, "") == 0){
			return output(6,"表单填写不完整，加*的必须填写");
		}
		

		//检查密码是否正确
		$username = mysql_real_escape_string($oldUsername);
		$newUsername = mysql_real_escape_string($newUsername);
		$password = sha1(SALT . $_POST['username_pass']);
		
		$sql = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
		$result = @mysql_query($sql ,$conn);
		if(!$result){
			return output(4,"数据库操作失败，请联系管理员");
		}
		if(mysql_num_rows($result) == 0){
			return output(12,"用户名或密码错误");
		}
		
		
		//检查权限
		if(strcmp("admin",$oldUsername) == 0 || strcmp("zwhz",$oldUsername) == 0){
			return output(5,"你没有权限不足，请联系管理员");
		}
		
		
		//更新用户名
		$sql = "UPDATE user SET username = '$newUsername' where username = '$username'";
		$result = @mysql_query($sql ,$conn);
		if($result){
			$_SESSION['username'] = $newUsername;
			return output(0,"新用户名修改成功，请退出重新登陆。");
		}else{
			return output(4,"数据库操作失败，请联系管理员");
		}
		
	}else{
		return output(6,"表单填写不完整，加*的必须填写");
	}
}


function alterPassword(){
	global $conn;

	if(isset($_POST['newPassword']) && isset($_POST['newPassword2']) && isset($_POST['oldpassword'])){
		
		//检查表单数据
		$username = trim($_SESSION["username"]);
		if(strcmp($_POST['newPassword'],"") == 0 || strcmp($_POST['newPassword2'],"") == 0  || strcmp($_POST['oldpassword'],"") == 0 ){
			return output(6,"表单填写不完整，加*的必须填写");
		}
		if(strcmp($_POST['newPassword'],$_POST['newPassword2']) != 0){
			return output(11,"两次密码不同");
		}
		if(strlen($_POST['newPassword']) <6){
			return output(9,"密码安全级别太低");
		}
		
		//检查权限
		if(strcmp($username,"admin") == 0){
			return output(5,"你的权限不足，请联系管理员");
		}
		
		
		//检查密码
		$username = mysql_real_escape_string($username);
		$newPassword = sha1(SALT . $_POST['newPassword']);
		$oldpassword = sha1(SALT . $_POST['oldpassword']);
		$sql = "SELECT * FROM user WHERE username = '$username' and password = '$oldpassword'";
		$result = @mysql_query($sql ,$conn);
		if(!$result){
			return output(4,"数据库操作失败，请联系管理员");
		}
		
		if(mysql_num_rows($result) == 0){
			return output(12,"用户名或密码错误");
		}
		
		//更新密码
		$sql = "UPDATE user SET password = '$newPassword' where username = '$username' and password = '$oldpassword'";
		$result = @mysql_query($sql ,$conn);
		if($result){
			return output(0,"密码修改成功");
		}else{
			return output(4,"数据库操作失败，请联系管理员");
		}
		
	}else if(isset($_POST['username']) && isset($_POST['newPassword']) && isset($_POST['newPassword2'])){
		
		//检查表单数据
		$username = trim($_POST['username']);

		if(strcmp($_POST['newPassword'],$_POST['newPassword2']) != 0){
			return output(5,"两次密码不一样！");
		}
		
		if(strlen($_POST['newPassword']) <6){
			return output(6,"密码长度太短");
		}
		
		//检查权限
		$ret = getUserLev($_SESSION["username"]);
		
		if($ret['code'] != 0){
			return $ret;
		}
	
		if($ret['message'] == 2 || strcmp($username,"admin") == 0){
			return output(5,"你权限不足，请联系管理员");
		}
		
		//重置密码
		$username = mysql_real_escape_string($username);
		$newPassword = sha1(SALT . $_POST['newPassword']);
		
		$sql = "UPDATE user SET password = '$newPassword' where username = '$username'";
		
		$result = @mysql_query($sql ,$conn);
		
		if($result){
			return output(0,"密码修改成功");
		}else{
			return output(4,"数据库操作失败，请联系管理员");
		}
		
	}else{
		return output(6,"表单填写不完整，加*的必须填写");
	}
}


function alterInfo(){
	global $conn;

	if(isset($_POST['newEmail']) && isset($_POST['email_password'])){
		//检查表单数据
		$username = trim($_SESSION["username"]);
		if(strcmp($_POST['newEmail'],"") == 0 || strcmp($_POST['email_password'],"") == 0){
			return output(6,"表单填写不完整，加*的必须填写");
		}
		if(!preg_match('/^.+?@.+?\..+?$/',$_POST['newEmail'])) {
			return output(13,"email格式不正确！");
		}

		//检查密码
		$username = mysql_real_escape_string($username);
		$newEmail = mysql_real_escape_string($_POST['newEmail']);
		$email_password = sha1(SALT . $_POST['email_password']);
		$sql = "SELECT * FROM user WHERE username = '$username' and password = '$email_password'";
		$result = @mysql_query($sql ,$conn);
		if(!$result){
			return output(4,"数据库操作失败，请联系管理员");
		}
		if(mysql_num_rows($result) == 0){
			return output(12,"用户名或密码错误");
		}
		
		//更新email
		$sql = "UPDATE user SET email = '$newEmail' where username = '$username' and password = '$email_password'";
		$result = @mysql_query($sql ,$conn);
		if($result){
			$_SESSION['email'] = $newEmail;
			return output(0,"联系信息修改成功");
		}else{
			return output(4,"数据库操作失败，请联系管理员");
		}
		
	}else{
		return output(6,"表单填写不完整，加*的必须填写");
	}
}


function deleteContent(){
	global $conn;

	if(isset($_POST['id'])){
		//检查表单数据		
		$id = intval(trim($_POST['id']));
		if($id == 0){
			return output(14,"非法操作");
		}
	
		//检查权限

		
		//删除记录
		$id = mysql_real_escape_string($id);		
		$sql = "DELETE FROM main WHERE id = '$id'";
		$result = @mysql_query($sql ,$conn);
		if($result){
			return output(0,"删除成功");
		}else{
			return output(4,"数据库操作失败，请联系管理员");
		}
		
	}else{
		return output(14,"非法操作");
	}
}


function deleteUser(){
	global $conn;

	if(isset($_POST['username'])){
		//检查表单数据		
		$username = trim($_POST['username']);
		if(strcmp($username, "") == 0){
			return output(6,"表单填写不完整，加*的必须填写");
		}
	
		//检查权限
		$ret = getUserLev($_SESSION["username"]);
		
		
		if($ret['code'] != 0){
			return $ret;
		}
	
		if($ret['message'] == 2 || strcmp("admin",$username) == 0 || strcmp("zwhz",$username) == 0){
			return output(5,"你没有权限不足，请联系管理员");
		}
		
		//删除用户
		$username = mysql_real_escape_string($username);		
		$sql = "DELETE FROM user WHERE username = '$username'";
		$result = @mysql_query($sql ,$conn);
		if($result){
			return output(0,"删除用户成功");
		}else{
			return output(4,"数据库操作失败，请联系管理员");
		}
		
	}else{
		return output(6,"表单填写不完整，加*的必须填写");
	}
}


function addNewUser(){
	global $conn;

	if(isset($_POST['newUsername']) && isset($_POST['newPassword']) && isset($_POST['newPassword2'])){
		
		
		//检查表单数据
		$newUsername = trim($_POST['newUsername']);
		
		if(strcmp($newUsername, "") == 0){
			return output(6,"表单填写不完整，加*的必须填写");
		}
		
		if(strcmp($_POST['newPassword'],$_POST['newPassword2']) != 0){
			return output(11,"两次密码不同！");
		}
		
		if(strlen($_POST['newPassword']) < 6){
			return output(9,"密码安全级别太低");
		}
		
		
		//检查权限
		$ret = getUserLev($_SESSION["username"]);
		
		
		if($ret['code'] != 0){
			return $ret;
		}
	
		if($ret['message'] == 2){
			return output(5,"你没有权限不足，请联系管理员");
		}
		
		
		//检查用户名是否被使用
		$newUsername = mysql_real_escape_string($newUsername);
		$newPassword = sha1(SALT . $_POST['newPassword']);
		
		$sql = "SELECT * FROM user WHERE username = '$newUsername'";
		
		$result = @mysql_query($sql ,$conn);
		
		if(!$result){
			return output(4,"数据库查询失败，请联系管理员");
		}
		
		if(mysql_num_rows($result) != 0){
			return output(8,"用户名已存在");
		}
		
		
		//添加新用户
		$sql = "INSERT INTO user(username, password) VALUES('$newUsername','$newPassword')";
		
		$result = @mysql_query($sql ,$conn);
		
		if($result){
			return output(0,"新用户名添加成功");
		}else{
			return output(4,"数据库操作失败，请联系管理员");
		}
		
	}else{
		return output(6,"表单填写不完整，加*的必须填写");
	}
}


function updateContent(){
	global $conn;

	if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['type']) && isset($_POST['content']) ){
		
		//检查表单数据
		if(strcmp(trim($_POST['title']), "") == 0 || strcmp(trim($_POST['type']), "") == 0 || strcmp(trim($_POST['content']), "") == 0){
			return output(6,"表单填写不完整，加*的必须填写");
		}
		
		//添加新content
		$id = mysql_real_escape_string($_POST['id']);
		$title = mysql_real_escape_string($_POST['title']);
		$code = mysql_real_escape_string($_POST['type']);
		$content = mysql_real_escape_string($_POST['content']);

		$sql = "UPDATE `main` SET `code` = '$code',`title`='$title ',`content`='$content' WHERE id = '$id'";
		$result = @mysql_query($sql ,$conn);
		if($result){
			return output(0,"更新成功");
		 }else{
			return output(4,"数据库操作失败，请联系管理员");
		 }
	}else{
		return output(14,"非法操作");
	}
}


function addContent(){
	global $conn;

	if(isset($_POST['title']) && isset($_POST['type']) && isset($_POST['content']) ){
		
		//检查表单数据
		if(strcmp(trim($_POST['title']), "") == 0 || strcmp(trim($_POST['type']), "") == 0 || strcmp(trim($_POST['content']), "") == 0){
			return output(6,"表单填写不完整，加*的必须填写");
		}
		
		//添加新content
		$user = mysql_real_escape_string($_SESSION['username']);
		$title = mysql_real_escape_string($_POST['title']);
		$code = mysql_real_escape_string($_POST['type']);
		$content = mysql_real_escape_string($_POST['content']);
		$time = mysql_real_escape_string(date("Y-m-d H:i:s"));

		
		$sql = "INSERT INTO `main`(`code`, `title`,  `time`, `content`, `user`) VALUES ('$code','$title','$time','$content','$user')";
		
		$result = @mysql_query($sql ,$conn);
		if($result){
			return output(0,"发表成功");
		 }else{
			return output(4,"数据库操作失败，请联系管理员");
		 }
	}else{
		return output(14,"非法操作");
	}
}


function deleteFriendLink(){
	global $conn;

	if(isset($_POST['id'])){
		//检查表单数据		
		$id = intval(trim($_POST['id']));
		if($id == 0){
			return output(14,"非法操作");
		}
	
		//检查权限

		
		//删除记录
		$id = mysql_real_escape_string($id);		
		$sql = "DELETE FROM main WHERE id = '$id'";
		$result = @mysql_query($sql ,$conn);
		if($result){
			return output(0,"删除成功");
		}else{
			return output(4,"数据库操作失败，请联系管理员");
		}
		
	}else{
		return output(14,"非法操作");
	}
}

		
function addFriendLink(){
	global $conn;
	$type = 7;
	$maxNum = 4;
	
	if(isset($_POST['SiteName']) && isset($_POST['SiteUrl'])){
		
		
		//检查表单数据
		$SiteName = trim($_POST['SiteName']);
		$SiteUrl = trim($_POST['SiteUrl']);
		
		if(strcmp($SiteName, "") == 0 || strcmp($SiteUrl, "") == 0 ){
			return output(6,"表单填写不完整，加*的必须填写");
		}
		
		
		//检查权限
		
		
		//检查网站是否已经不能再添加
		$ret = getFriendLinkCount();
		if($ret['code'] != 0){
			return $ret;
		}
		
		if($ret['message'] >= $maxNum){
			return output(16,"友情链接只能添加 $maxNum 个，请删除后在添加");
		}
		
		
		
	
		
		
		//添加新用户
		$user = mysql_real_escape_string($_SESSION['username']);
		$title = mysql_real_escape_string($_POST['SiteName']);
		$code = mysql_real_escape_string($type);
		$content = mysql_real_escape_string($SiteUrl);
		$time = mysql_real_escape_string(date("Y-m-d H:i:s"));
		
		$sql = "INSERT INTO `main`(`code`, `title`,  `time`, `content`, `user`) VALUES ('$code','$title','$time','$content','$user')";

		$result = @mysql_query($sql ,$conn);
		
		if($result){
			return output(0,"友情链接添加成功");
		}else{
			return output(4,"数据库操作失败，请联系管理员");
		}
		
	}else{
		return output(6,"表单填写不完整，加*的必须填写");
	}
}

function getFriendLinkCount(){
	global $conn;
	$type = 7;
	$sql = "SELECT count(*) num FROM main WHERE code = '$type'";
	$result = @mysql_query($sql ,$conn);
	if($result && ($row=@mysql_fetch_array($result))){
		return output(0,$row['num']);
	}
	return output(4,"数据库操作失败，请联系管理员");
}


function deleteImg(){
	global $conn;

	if(isset($_POST['id'])){
		//检查表单数据		
		$id = intval(trim($_POST['id']));
		if($id == 0){
			return output(14,"非法操作");
		}
	
		//检查权限

		
		//删除记录
		$id = mysql_real_escape_string($id);		
		$sql = "DELETE FROM main WHERE id = '$id'";
		$result = @mysql_query($sql ,$conn);
		if($result){
			return output(0,"删除成功");
		}else{
			return output(4,"数据库操作失败，请联系管理员");
		}
		
	}else{
		return output(14,"非法操作");
	}
}


function addImg(){
	global $conn;
	$type = 8;
	$maxNum = 4;
	
	if(isset($_POST['title']) && isset($_POST['imgUrl'])){
		//检查表单数据
		$title = trim($_POST['title']);
		$imgUrl = trim($_POST['imgUrl']);
		
		if(strcmp($title, "") == 0 || strcmp($imgUrl, "") == 0 ){
			return output(6,"表单填写不完整，加*的必须填写");
		}
		
		//检查权限
		
		
		//检查img是否已经不能再添加
		$ret = getImgCount($type);
		if($ret['code'] != 0){
			return $ret;
		}
		
		if($ret['message'] >= $maxNum){
			return output(16,"动态图片只能添加 $maxNum 个，请删除后在添加");
		}
		

		
		//添加新动态图片
		$user = mysql_real_escape_string($_SESSION['username']);
		$title = mysql_real_escape_string($_POST['title']);
		$code = mysql_real_escape_string($type);
		$content = mysql_real_escape_string($imgUrl);
		$time = mysql_real_escape_string(date("Y-m-d H:i:s"));
		
		$sql = "INSERT INTO `main`(`code`, `title`,  `time`, `content`, `user`) VALUES ('$code','$title','$time','$content','$user')";

		$result = @mysql_query($sql ,$conn);
		
		if($result){
			return output(0,"动态图片添加成功");
		}else{
			return output(4,"数据库操作失败，请联系管理员");
		}
		
	}else{
		return output(6,"表单填写不完整，加*的必须填写");
	}
}

function getImgCount($type){
	global $conn;
	$sql = "SELECT count(*) num FROM main WHERE code = '$type'";
	$result = @mysql_query($sql ,$conn);
	if($result && ($row=@mysql_fetch_array($result))){
		return output(0,$row['num']);
	}
	return output(4,"数据库操作失败，请联系管理员");
}


?>