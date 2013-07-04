 <?php
	include_once('inc/check.php');
	require_once("inc/init.php");
	$title = "更改个人信息";
	include_once('inc/header.inc.php');
?>
 <div class="alterInfo">
  
<table  class="mytable table-bordered table-condensed tablesorter table-hover">
	<tbody>
		<tr>
			<td colspan="4">修改账户名称(由数字、字母、下划线组成)</td>
		</tr>
		<tr>
		  <td>当前账户名称</td>
		  <td><input id="oldUsername" type="text" class="longtext" maxlength="20" value="<?php echo $_SESSION["username"]; ?>" disabled></td>
		  <td></td>
		</tr>
		<tr>
			<td class="tr_first">新的账户名称</td>
			<td>
				<input id="newUsername" type="text" class="longtext" maxlength="20">
				<span class="important">*</span>
			</td>
			<td class="tr_first">
				<button class="btn btn-success" id="updateUsername" type="button">更改用户名</button>
			</td>
		</tr>
		<tr>
			<td>当前登录密码</td>
			<td>
				<input id="username_pass" type="password" class="longtext" maxlength="20">
				<span class="important">*</span>
			</td>
			<td></td>
		</tr> 
	</tbody>
</table>
<script>
$("#updateUsername").click(function(){
	var $newUsername = $("#newUsername").val();
	var $username_pass = $("#username_pass").val();
	
	if($newUsername == "" || $username_pass == ""){
		showMessage("修改用户名时，表单填写不完整，加*的必须填写！");
	}else{
		$.post("inc/manger.ajax.php?mangercode=2",{
			newUsername:$newUsername,
			username_pass:$username_pass
		},function(d){
			if(d.code == 0){
				showMessage(d.message,function(){window.location.reload();},4000);
			}else{
				showMessage(d.message);
			}
		},"json");
	}
});

</script>
<div class="height_20"></div>

<table  class="mytable table-bordered table-condensed tablesorter table-hover">
	<tbody>
		<tr>
			<td colspan="4">修改登录密码</td>
		</tr>
		<tr>
		  <td class="tr_first">新的登密码</td>
		  <td><input id="newPassword" type="password" class="longtext" maxlength="20"><span class="important">*</span></td>
		  <td class="tr_first"></td>
		</tr>
		<tr>
			<td>新的登录密码确认</td>
			<td>
				<input id="newPassword2" type="password" class="longtext" maxlength="20">
				<span class="important">*</span>
			</td>
			<td>
				<button class="btn btn-success" id="updatePassword" type="button">更改密码</button>
			</td>
		</tr>
		<tr>
			<td>当前登录密码</td>
			<td>
				<input id="oldpassword" type="password" class="longtext" maxlength="20">
				<span class="important">*</span>
			</td>
			<td></td>
		</tr> 
	</tbody>
</table>
<script>
$("#updatePassword").click(function(){
	var $newPassword = $("#newPassword").val();
	var $newPassword2 = $("#newPassword2").val();
	var $oldpassword = $("#oldpassword").val();
	
	if($newPassword == "" || $newPassword2 == "" || $oldpassword == ""){
		showMessage("修改密码时，表单填写不完整，加*的必须填写！");
	}else if($newPassword2 != $newPassword){
		showMessage("修改密码时，两次密码不一样！");
	}else{
		$.post("inc/manger.ajax.php?mangercode=3",{
			newPassword:$newPassword,
			newPassword2:$newPassword2,
			oldpassword:$oldpassword
		},function(d){
			if(d.code == 0){
				showMessage(d.message,function(){window.location.reload();},4000);
			}else{
				showMessage(d.message);
			}
		},"json");
	}
});

</script>
<div class="height_20"></div>


<table  class="mytable table-bordered table-condensed tablesorter table-hover">
	<tbody>
		<tr>
			<td colspan="4">修改联系信息</td>
		</tr>
		<tr>
		  <td>当前Email</td>
		  <td><input  type="text" class="longtext" maxlength="20" value="<?php echo $_SESSION["email"]; ?>" disabled></td>
		  <td></td>
		</tr>
		<tr>
			<td class="tr_first">常用联系邮箱</td>
			<td>
				<input id="newEmail" type="text" class="longtext" maxlength="20">
				<span class="important">*</span>
			</td>
			<td class="tr_first">
				<button class="btn btn-success" id="updateinfo" type="button">修改联系信息</button>
			</td>
		</tr>
		<tr>
			<td>当前登录密码</td>
			<td>
				<input id="email_password" type="password" class="longtext" maxlength="20">
				<span class="important">*</span>
			</td>
			<td></td>
		</tr> 
	</tbody>
</table>
<script>
$("#updateinfo").click(function(){
	var $newEmail    = $("#newEmail").val();
	var $email_password = $("#email_password").val();
	
	if($newEmail == "" || $email_password == ""){
		showMessage("修改联系信息时，表单填写不完整，加*的必须填写！");
	}else{
		$.post("inc/manger.ajax.php?mangercode=4",{
			newEmail:$newEmail,
			email_password:$email_password
		},function(d){
			if(d.code == 0){
				showMessage(d.message,function(){window.location.reload();},4000);
			}else{
				showMessage(d.message);
			}
		},"json");
	}
});

</script>

 </div>
 
 <?php 
	include_once('inc/footer.inc.php'); 
	require_once("inc/end.php");
?>

 
 