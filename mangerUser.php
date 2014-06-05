 <?php
	include_once('inc/check.php');
	require_once("inc/init.php");
	$title = "管理用户";
	include_once('inc/header.inc.php');
?>
<div>
	<div class="height_20"></div>
	<table class="table table-striped table-bordered table-condensed tablesorter mytable">
		<thead>
			<tr>
				<th>用户名</th>
				<th>联系邮箱</th>
				<th>最近登录时间</th>
				<th>最近登录IP</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!$conn || !$result || $ret){
			echo "<tr><td>".$ret["message"]."</td></tr>";
		}else{
			$sql = "SELECT * FROM user WHERE username != 'admin'";
			
			$result = @mysql_query($sql ,$conn);

			if(!$result){
				echo "<tr><td>数据库查询失败</td></tr>";
			}else{
				while($row=mysql_fetch_array($result)) {
					echo "<tr>";
					echo "<td>".$row["username"]."</td>";
					echo "<td>".$row["email"]."</td>";

					$log = getLog($row["username"]);
				
					echo "<td>".$log['data']."</td>";
					echo "<td>".$log['ip']."</td>";
					echo "<td><div class='btn-group'  data-toggle='buttons-radio'><button class='btn' onclick=\"deleteUser('".$row["username"]."');\">删除</button><button class='btn' onclick=\"resetPassword('".$row["username"]."');\">重置密码</button></div></td>";
					echo "</tr>";
				}
			}
		}

		?>

		</tbody>
	</table>

 </div>
<script>
function resetPassword(username){
	$("#updatePasswordAlter .modal-header h3").html("重置用户"+username+"的密码");
	$("#updatePasswordAlter .modal-footer button.btn-primary").attr("onclick","confirmUpdatePassword('"+username+"');");
	$('#updatePasswordAlter').modal();
}

function confirmUpdatePassword(username){
	var newPassword = $("#newPassword").val();
	var newPassword2 = $("#newPassword2").val();
	
	if(newPassword != newPassword2){
		showMessage("两次输入的密码不一样，请重新操作");
	}else{
		$('#updatePasswordAlter').modal('hide');
		$.post("inc/manger.ajax.php?mangercode=3",{
			username:username,
			newPassword:newPassword,
			newPassword2:newPassword2
		},function(d){
			showMessage(d.message);
		},"json");
	}
}

function deleteUser(username){
	bootbox.confirm("你确定要删除这个用户吗?", function(result) {
		if(result){
			$.post("inc/manger.ajax.php?mangercode=5",{
				username:username
			},function(d){
				showMessage(d.message,function(){window.location.reload();},3000);
			},"json");
		}
	}); 
}


</script>

<div id="updatePasswordAlter"  class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>重置密码</h3>
  </div>
  <div class="modal-body">
    <p>请输入密码：<input id="newPassword" type="password" class="longtext" maxlength="10"></p>
    <p>请确认密码：<input id="newPassword2" type="password" class="longtext" maxlength="10"></p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" >取消</button>
    <button class="btn btn-primary" onclick="confirmUpdatePassword();">确认</button>
  </div>
</div>


 <?php 
	include_once('inc/footer.inc.php'); 
	require_once("inc/end.php");
?>
