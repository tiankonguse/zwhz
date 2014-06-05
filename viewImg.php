 <?php
	include_once('inc/check.php');
	require_once("inc/init.php");
	$title = " ";
	include_once('inc/header.inc.php');	
?>
<div>
	<div class="height_20"></div>
	<table class="table table-striped table-bordered table-condensed tablesorter mytable">
		<thead>
			<tr>
				<th>图片</th>
				<th>图片描述</th>
				<th>添加时间</th>
				<th>添加人</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!$conn || !$result || $ret){
			echo "<tr><td colspan='5'>".$ret["message"]."</td></tr>";
		}else{
			getList(8,5);
		}
		?>
		</tbody>
	</table>

 </div>

<?php
function getList($type,$rowNum){
	global $conn;
	$num = 0;

	$sql = "select * from main WHERE code = '$type' ORDER BY id ";
	$result = mysql_query($sql ,$conn);
	if($result){
		while($row=@mysql_fetch_array($result)){
			$num++;
			echo "			
				<tr>
					<td>".$row['title']."</td>
					<td><img height='117' width='153' src='".$row['content']."' style='width:153px;height:117px;'></td>
					<td><input type='text' class='longtext' maxlength='10' style='width:auto;' value='".$row['time']."' disabled></td>
					<td><input type='text' class='longtext' maxlength='10' style='width:auto;' value='".$row['user']."' disabled></td>
					<td><button class='btn btn-danger' onclick=\"deleteImg('".$row["id"]."');\">删除</button></td>
				</tr>
			";
		}
		if($num == 0){
			echo "<tr><td  colspan='5'>暂时没有动态图片</td></tr>";
		}
		echo "<tr><td  colspan='5'>动态图片最个可添加4个</td></tr>";
	}else{
		echo "<tr><td  colspan='5'>数据库操作失败，请联系管理员</td></tr>";
		return ;
	}
	
}

?>
<script>

function deleteImg(id){
	bootbox.confirm("你确定要删除这个动态图片吗?", function(result) {
		if(result){
			$.post("inc/manger.ajax.php?mangercode=12",{
				id:id
			},function(d){
				if(d.code == 0){
					showMessage(d.message,function(){window.location.reload();},4000);
				}else{
					showMessage(d.message);
				}
			},"json");
		}
	}); 
}


</script>
 <?php 
	include_once('inc/footer.inc.php'); 
	require_once("inc/end.php");
?>
