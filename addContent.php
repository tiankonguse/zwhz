 <?php
	include_once('inc/check.php');
	require_once("inc/init.php");
	$title = "查看合作动态";
	include_once('inc/headEditer.php');
	
	$type = intval($_GET["type"]);
	
?>
<div>
<div class="height_20"></div>
<table class="mytable table-bordered table-condensed tablesorter table-hover">
	<tbody>
		<tr>
			<td height="30" width="10%"><?php echo ini_get('upload_max_filesize'); ?>标题</td>
			<td height="30" width="90%" style="text-align:left;">
				<input id="title" type="text" class="longtext" style="width:500px;" />
			</td>
		</tr>
		<tr>
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
		</tr>
		<tr>
		  <td colspan="2" style="text-align:center;">
		  <textarea name="content" id="content" style="width:100%;height:400px;visibility:hidden;"></textarea>
		  </td>
		</tr>
		<tr>
			<td colspan="2"><button class="btn  btn-success"  id="submit" type="button">发表</button></td>
		</tr>
	</tbody>
</table>

 </div>
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
		$("#type").val('<?php  echo $type; ?>');
	});
	
	$("#submit").click(function(){
		editor.sync();
		var $title = $("#title").val();
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

		$.post("inc/manger.ajax.php?mangercode=9",{
			title:$title,
			type:$type,
			content:$content
		},function(d){
			if(d.code == 0){
				showMessage(d.message,function(){window.location="viewContentList.php?type="+$type;},4000);
			}else{
				showMessage(d.message);
			}
			
		},"json");
		
		
	});
	
</script>
 
 <?php 
	include_once('inc/footer.inc.php'); 
	require_once("inc/end.php");
?>
