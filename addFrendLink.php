 <?php
	include_once('inc/check.php');
	require_once("inc/init.php");
	$title = "";
	include_once('inc/header.inc.php');
?>
<div>
<div class="height_20"></div>
<table  class="mytable table-bordered table-condensed tablesorter table-hover">
	<tbody>
		<tr>
			<td colspan="2">添加友情链接</td>
		</tr>
		<tr>
		  <td>网站名称</td>
		  <td><input id="newSiteName" type="text" class="longtext" style="width:500px;" ><span class="important">*</span></td>
		</tr>
		<tr>
			<td>网站链接</td>
			<td>
				<input id="newSiteUrl" type="text" class="longtext" style="width:500px;" >
				<span class="important">*</span>
			</td>
		</tr>
		<tr>
			<td colspan="2"><button class="btn btn-success" id="addFriendLink" type="button">添加</button></td>
		</tr> 
	</tbody>
</table>

<script>
$("#addFriendLink").click(function(){
	var $SiteName    = $("#newSiteName").val();
	var $SiteUrl    = $("#newSiteUrl").val();
	
	if($SiteName == "" || $SiteUrl == ""){
		showMessage("表单填写不完整，加*的必须填写！");
	}else{
		$.post("inc/manger.ajax.php?mangercode=11",{
			SiteName:$SiteName,
			SiteUrl:$SiteUrl
		},function(d){
				if(d.code == 0){
					showMessage(d.message,function(){window.location="viewFrendLink.php";},4000);
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
