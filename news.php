<?php
require_once("inc/init.php");
$title = "中外合作办学网站";
include_once('inc/header.inc.php');

if(isset($_GET["type"]) && intval($_GET["type"]) >0){
	$type = intval($_GET["type"]);
}else{
	$ret = output(14,"非法操作");
}

if(isset($_GET["id"]) && intval($_GET["id"]) >0){
	$id = intval($_GET["id"]);
}else{
	$ret = output(14,"非法操作");
}

$types = array(
		'1' => "合作动态",
		'2' => "合作院校",
		'3' => "政策文件",
		'4' => "通知公告",
		'5' => "合作项目",
		'6' => "组织机构"
	    );

?>
  <div class="wrap">
<?php include_once('inc/index.top.php'); ?>
<?php include_once('inc/index.nav.php'); ?>
	
	<div class="content"  style="min-height: 410px;">
		<div class="content-left" style="min-height: 400px;">
			<?php include_once('inc/index.show_img.php'); ?>
			<div style="clear:both;"></div>
			<div style="height:10px;"></div>
			<?php include_once('inc/index.school.php'); ?>			
		</div>
		
		<div class="content-right"  style="min-height: 400px;">
			<div class="content_right_nav">
				您的位置: <a href=".">首页</a>					
				<?php 
					if($type == 6){
						echo "&gt; 组织机构";
					} else{
						echo "&gt; <a href='newsList.php?type=$type'>".$types[$type]."</a> &gt; 正文";
					}
				?>
			</div>
			<div class="content_right_artical">
					<?php
						if(!$conn || !$result || $ret){
							echo "服务器出现问题，请联系管理员";
						}else{
							getArtical($type,$id);
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
function getArtical($type,$id){
	global $conn;
	
			 
	$sql = "select * from main WHERE id = '$id'";
	$result = mysql_query($sql ,$conn);
	if($result){

		if($row=@mysql_fetch_array($result)){
			echo "<div class='content-right-title'><h2>".$row['title']."</h2></div>";
			if($type != 6)echo "<div class='content_right_wrap_artical_info'>作者: ".$row['user']." 时间: ".$row['time']."</div>";
			echo "<div class='content_right_wrap_artical_content'>".$row['content']."</div>";
		}else{
		
		}		
	}else{
		echo "<ul><li>服务器出现问题，请联系管理员</li></ul>";
		return ;
	}
	
}



?>

<?php include_once('inc/index.footer.php'); ?>
<?php include_once('inc/footer.inc.php'); ?>

