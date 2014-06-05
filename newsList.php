<?php
require_once("inc/init.php");
$title = "中外合作办学网站";
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

$types = array(
		'1' => "合作动态",
		'2' => "合作院校",
		'3' => "政策文件",
		'4' => "通知公告",
		'5' => "合作项目"
	    );
?>
<div class="wrap">
<?php include_once('inc/index.top.php'); ?>
<?php include_once('inc/index.nav.php'); ?>

	<div class="content" style="min-height: 410px;">
		<div class="content-left" style="min-height: 400px;">
			<?php include_once('inc/index.show_img.php'); ?>
			<div style="clear:both;"></div>
			<div style="height:10px;"></div>
			<?php include_once('inc/index.school.php'); ?>			
		</div>
		
		<div class="content-right" style="min-height: 400px;">
			<div class="content_right_nav">
				您的位置: <a href=".">首页</a> &gt; <a href="newsList.php?type=<?php echo "$type";?>"><?php echo $types[$type]; ?></a>
			</div>
			<div class="content_right_news-list">
			<?php
				if(!$conn || !$result || $ret){
					echo "<div>服务器出现问题，请联系管理员</div>";
				}else{
					getList($type,$page);
				}
			?>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>

<script>
$(document).ready(
	function(){
		$(".nav ul li.nav<?php echo $type; ?>").addClass("active");
	}
);
</script>
<?php
function getList($type,$page){
	global $conn;
	$rowNum = 12;
	
	$types = array(
			'1' => "合作动态",
			'2' => "合作院校",
			'3' => "政策文件",
			'4' => "通知公告",
			'5' => "合作项目"
		    );
	
	$ret = getContentCount($type);
	
	if($ret['code'] != 0){
		echo "<div>".$ret['message']."</div>";
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
			<div class='news-item'>
				<div class='news-dot'>.</div>
				<div class='news-title'>
					<a href='news.php?type=$type&id=".$row['id']."'>".$row['title']."</a>
				</div>
				<div class='news-time'>".$row['time']."</div>
				<div style='clear:both;'></div>
            </div>
			";
		}
		
		if($num == 0){
				echo "<div><b>暂时没有内容</b></div>";
		}else{
			echo "<div class='dede_pages'>共有 $contentNum 个记录    每页显示 $rowNum 条 $page/$pageNum 页  <a href='newsList.php?type=$type&page=1'>首页</a> <a href='newsList.php?type=$type&page=".($page-1)."'>上一页</a> <a href='newsList.php?type=$type&page=".($page+1)."'>下一页</a> <a href='newsList.php?type=$type&page=$pageNum'>尾页</a></div>";
		}
		
	}else{
		echo "<div>服务器出现问题，请联系管理员</div>";
		return ;
	}
	
}

function getContentCount($type){
	global $conn;
	$sql = "SELECT count(*) num FROM main WHERE code = '$type'";
	$result = @mysql_query($sql ,$conn);
	if($result && ($row=@mysql_fetch_array($result))){
		return output(0,$row['num']);
	}
	return output(4,"数据库操作失败，请联系管理员");
}


?>

<?php include_once('inc/index.footer.php'); ?>
<?php include_once('inc/footer.inc.php'); ?>

