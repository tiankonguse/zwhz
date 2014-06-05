 <?php
	include_once('inc/check.php');
	require_once("inc/init.php");
	$title = "添加用户";
	include_once('inc/header.inc.php');
?>
<div>
<div class="height_20"></div>
<table  class="mytable table-bordered table-condensed tablesorter table-hover">
	<tbody>
		<tr>
			<td colspan="4">添加普通管理员</td>
		</tr>
		<tr>
		  <td class="tr_first">普通管理员名称</td>
		  <td><input id="newUsername" type="text" class="longtext" maxlength="20"><span class="important">*</span></td>
		  <td class="tr_first"></td>
		</tr>
		<tr>
			<td>普通管理员密码</td>
			<td>
				<input id="newPassword" type="password" class="longtext" maxlength="20">
				<span class="important">*</span>
			</td>
			<td>
				<button class="btn btn-success" id="addNewUser" type="button">添加</button>
			</td>
		</tr>
		<tr>
			<td>普通管理员密码确认</td>
			<td>
				<input id="newPassword2" type="password" class="longtext" maxlength="20">
				<span class="important">*</span>
			</td>
			<td></td>
		</tr> 
	</tbody>
</table>

<script>
$("#addNewUser").click(function(){
	var $newUsername    = $("#newUsername").val();
	var $newPassword    = $("#newPassword").val();
	var $newPassword2   = $("#newPassword2").val();
	
	if($newUsername == "" || $newPassword == "" || $newPassword2 == ""){
		showMessage("表单填写不完整，加*的必须填写！");
	}else if($newPassword != $newPassword2){
		showMessage("两次密码不一样！");
	}else{
		$.post("inc/manger.ajax.php?mangercode=6",{
			newUsername:$newUsername,
			newPassword:$newPassword,
			newPassword2:$newPassword2
		},function(d){
			if(d.code == 0){
				showMessage(d.message,function(){window.location="mangerUser.php";},4000);
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
