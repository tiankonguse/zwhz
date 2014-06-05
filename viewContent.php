 <?php
	include_once('inc/check.php');
	require_once("inc/init.php");
	$title = "查看合作动态";
	include_once('inc/headEditer.php');
	
	if(!$ret){
		if(!isset($_SESSION["username"]) || $_SESSION["username"]==""){
			$ret = output(9,"请先登录在操作");
		}
	}
	
	
	
	if(!$ret){
		$type = 0;
		if(isset($_GET['type']) && strcmp($_GET['type'],'6')==0){
			$type = 6;
			$sql = "SELECT * FROM main WHERE code = '$type'";
			$result = @mysql_query($sql ,$conn);
			if($result){
				$row=@mysql_fetch_array($result);
				if(!$row){
					$ret = output(15,"$id 你查询的数据已经不存在");
				}
			}else{
				$ret = output(4,"数据库操作失败，请联系管理员");
			}
		}else{
			if(!isset($_GET['id'])){
				$ret = output(14,"非法操作");
			}else{
				$id = intval(trim($_GET['id']));
				
				$sql = "SELECT * FROM main WHERE id = '$id'";
				$result = @mysql_query($sql ,$conn);
				if($result){
					$row=@mysql_fetch_array($result);
					if(!$row){
						$ret = output(15,"$id 你查询的数据已经不存在");
					}
				}else{
					$ret = output(4,"数据库操作失败，请联系管理员");
				}
			}
		}
	

	}
	
?>

<div>
<div class="height_20"></div>
<table class="mytable table-bordered table-condensed tablesorter table-hover">
	<tbody>
<?php
	if(!$conn || !$result || $ret){
		echo "
		<tr><td>".$ret['message']."</td></tr>
	</tbody>
</table>"
;
	}else{
		getContent();
	}
?>
<?php
function getContent(){
	global $row;
	global $type;
?>
<tr>
	<td height="30" width="10%">标题</td>
	<td height="30" width="90%" style="text-align:left;">
		<input id="title" type="text" class="longtext" style="width:500px;" value="<?php echo $row['title'];?>"/>
	</td>
</tr>
<tr>
<?php
if($type != 6){
?>

	<td>类型</td>
	<td style="text-align:left;">
		<select id="type">
			<option value="1">合作动态</option>
			<option value="2">合作院校</option>
			<option value="3">政策文件</option>
			<option value="4">通知公告</option>
			<option value="5">合作项目</option>
		</select>
	</td>


<?php }else{ ?>
<td>类型</td>
<td  style="text-align:left;">组织机构 	
<input id="type" type="text"  style="visibility:hidden;" value="<?php echo $row['code'];?>"/>
</td>
<?php } ?>
</tr>
<tr>
  <td colspan="2" style="text-align:center;">
  <textarea name="content" id="content" style="width:100%;height:400px;visibility:hidden;"><?php  echo $row['content']; ?></textarea>
  </td>
</tr>
<tr>
	<td colspan="2"><button class="btn  btn-success"  id="submit" type="button">修改</button><input id="id" type="text"  style="visibility:hidden;" value="<?php echo $row['id'];?>"/></td>
</tr>

	</tbody>
</table>

<script>
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('textarea[name="content"]', {
			cssPath : './kindeditor/plugins/code/prettify.css',
			uploadJson : './kindeditor/php/upload_json.php',
			fileManagerJson : './kindeditor/php/file_manager_json.php',
			allowFileManager : true
		});
		prettyPrint();
	});
	
	$(document).ready(function(){
		$("#type").val('<?php  echo $row['code']; ?>');
	});
	
	$("#submit").click(function(){
		editor.sync();
		var $title = $("#title").val();
		var $id = $("#id").val();
		var $type = $("#type").val();
		var $content = $('#content').val();
		
		if($title == ""){
			showMessage("标题不能为空");
			return false;
		}
		if($content == ""){
			showMessage("内容不能为空");
			return false;
		}

		$.post("inc/manger.ajax.php?mangercode=8",{
			id:$id,
			title:$title,
			type:$type,
			content:$content
		},function(d){
			showMessage(d.message);
		},"json");
		
		
	});
	
</script>
<?php } ?>


 </div>
 
 
 <?php 
	include_once('inc/footer.inc.php'); 
	require_once("inc/end.php");
?>
