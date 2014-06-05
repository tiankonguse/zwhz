 <?php
	include_once('inc/check.php');
	require_once("inc/init.php");
	$title = " ";
	include_once('inc/header.inc.php');
	
	if(isset($_GET["page"])){
		$page = intval($_GET["page"]);
	}else{
		$page = 1;
	}

	if(isset($_GET["type"]) && intval($_GET["type"]) >0){
		$type = intval($_GET["type"]);
	}else{
		$ret = output(14,"非法操作");
	}
	
?>
<div>
	<div class="height_20"></div>
	<table class="table table-striped table-bordered table-condensed tablesorter mytable">
		<thead>
			<tr>
				<th>标题</th>
				<th>类型</th>
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
	global $type;
	global $page;
	$rowNum = 8;
	
	$types = array(
			'1' => "合作动态",
			'2' => "合作院校",
			'3' => "政策文件",
			'4' => "通知公告",
			'5' => "合作项目"
		    );
	
	$ret = getContentCount();
	if($ret['code'] != 0){
		echo "<tr><td colspan='5'>".$ret['message']."</td></tr>";
		return ;
	}else{
		$contentNum = intval($ret['message']);
	}
	
	$pageNum = ceil($contentNum/$rowNum);
	
	if($page > $pageNum)$page = $pageNum;
	if($page < 1)$page = 1;

	$sql = "select * from main WHERE code = '$type' ORDER BY id DESC LIMIT ".($rowNum * ($page - 1))." , ".$rowNum." ";
	$result = mysql_query($sql ,$conn);
	$num = 0;
	if($result){
		while($row=@mysql_fetch_array($result)){
			$num++;
			echo "			
				<tr>
					<td><a href='viewContent.php?id=".$row['id']."'>".$row['title']."</a></td>
					<td>".$types[$row['code']]."</td>
					<td>".$row['time']."</td>
					<td>".$row['user']."</td>
					<td><div class='btn-group'  data-toggle='buttons-radio'><button class='btn' onclick=\"deleteContent('".$row["id"]."');\">删除</button><a class='btn' href='viewContent.php?id=".$row['id']."'>修改</a></div></td>
				</tr>
			";
		}
		if($num == 0){
			echo "<tr><td  colspan='5'>暂时添加过该项内容</td></tr>";
		}else{
			echo "<tr><td  colspan='5'>共有 $contentNum 个记录    每页显示 $rowNum 条 $page/$pageNum 页  <a href='viewContentList.php?type=$type&page=1'>首页</a> <a href='viewContentList.php?type=$type&page=".($page-1)."'>上一页</a> <a href='viewContentList.php?type=$type&page=".($page+1)."'>下一页</a> <a href='viewContentList.php?type=$type&page=$pageNum'>尾页</a></td></tr>";
		}
		
		
		
	}else{
		echo "<tr><td  colspan='5'>暂时没有数据</td></tr>";
		return ;
	}
	
}

function getContentCount(){
	global $conn;
	global $type;
	$sql = "SELECT count(*) num FROM main WHERE code = '$type'";
	$result = @mysql_query($sql ,$conn);
	if($result && ($row=@mysql_fetch_array($result))){
		return output(0,$row['num']);
	}
	return output(4,"数据库操作失败，请联系管理员");
}


?>
<script>

function deleteContent(id){
	bootbox.confirm("你确定要删除这个记录吗?", function(result) {
		if(result){
			$.post("inc/manger.ajax.php?mangercode=7",{
				id:id
			},function(d){
				showMessage(d.message,function(){window.location.reload();},4000);
			},"json");
		}
	}); 
}


</script>
 <?php 
	include_once('inc/footer.inc.php'); 
	require_once("inc/end.php");
?>
