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
				<th>网站名称</th>
				<th>网站链接</th>
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
			getList();
		}
		?>
		</tbody>
	</table>

 </div>

<?php
function getList(){
	global $conn;
	$rowNum = 4;
	$type = 7;
	$num = 0;
	
	
	$sql = "select * from main WHERE code = '$type' ORDER BY id ";
	$result = mysql_query($sql ,$conn);
	if($result){
		while($row=@mysql_fetch_array($result)){
			$num++;
			echo "			
				<tr>
					<td><input type='text' class='longtext' maxlength='10' style='width:auto;' value='".$row['title']."' disabled></td>
					<td><input type='text' class='longtext' maxlength='10' style='width:auto;' value='".$row['content']."' disabled></td>
					<td><input type='text' class='longtext' maxlength='10' style='width:auto;' value='".$row['time']."' disabled></td>
					<td><input type='text' class='longtext' maxlength='10' style='width:auto;' value='".$row['user']."' disabled></td>
					<td><button class='btn btn-danger' onclick=\"deleteFrendLink('".$row["id"]."');\">删除</button></td>
				</tr>
			";
		}
		if($num == 0){
			echo "<tr><td  colspan='5'>暂时友情链接</td></tr>";
		}
	}else{
		echo "<tr><td  colspan='5'>暂时友情链接</td></tr>";
	}
	echo "<tr><td  colspan='5'>友情链接最多可以添加 $rowNum 个</td></tr>";

	
}



?>
<script>

function deleteFrendLink(id){
	bootbox.confirm("你确定要删除这个友情链接吗?", function(result) {
		if(result){
			$.post("inc/manger.ajax.php?mangercode=10",{
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
