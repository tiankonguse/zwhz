 <?php
	include_once('inc/check.php');
	require_once("inc/init.php");
	$title = "添加图片";
	include_once('inc/headEditer.php');
?>
<div>
<div class="height_20"></div>
<table  class="mytable table-bordered table-condensed tablesorter table-hover">
	<tbody>
		<tr>
			<td colspan="2">添加动态图片</td>
		</tr>
		<tr>
			<td>描述</td>
			<td><input id="title" type="text" class="longtext" style="width:500px;" /></td>
		</tr>
		<tr>
			<td>图片</td>
			<td><img height="234px" width="306px" src="" alt="" id="showImg" style="height: 234px;width: 306px;"></td>
		</tr>
		<tr>
			<td>URL</td>
			<td>
				<input id="imgUrl" type="text"  class="longtext" value=""/>
				<input type="button" class="btn" id="choiseImg" value="选择图片" />
			</td>
		</tr>
		<tr>
			<td  colspan="2">
				<button class="btn btn-success" id="addImg" type="button">添加</button>
			</td>
		</tr> 

		
	</tbody>
</table>
<script>
	KindEditor.ready(function(K) {
		var editor = K.editor({
			allowFileManager : true
		});
		K('#choiseImg').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					clickFn : function(url, title, width, height, border, align) {
						editor.hideDialog();
						$("#showImg").attr({ src: url});
						$("#imgUrl").val(url);
						
					}
				});
			});
		});

		
	});
	
</script>
<script>
$("#addImg").click(function(){
	var $title    = $("#title").val();
	var $imgUrl    = $("#imgUrl").val();
	
	if($title == "" || $imgUrl == ""){
		showMessage("表单填写不完整，加*的必须填写！");
	}else{
		$.post("inc/manger.ajax.php?mangercode=13",{
			title:$title,
			imgUrl:$imgUrl
		},function(d){
			if(d.code == 0){
				showMessage(d.message,function(){window.location="viewImg.php";},4000);
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
