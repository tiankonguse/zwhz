<?php
require_once("inc/init.php");
$title = "中外合作办学网站";
include_once('inc/header.inc.php');
?>
<div class="wrap">

<?php include_once('inc/index.top.php'); ?>
<?php include_once('inc/index.nav.php'); ?>
	
	<div class="content">
		<div class="content-top">
			<?php include_once('inc/index.show_img.php'); ?>
			<?php include_once('inc/index.hezuo.php'); ?>
			<div class="content-top-right float-left content-top-height">
				<?php include_once('inc/index.school.php'); ?>
				<div style="height:5px;"></div>
				<?php include_once('inc/index.friend.php'); ?>
			</div>
			<div style="clear:both;"></div>
		</div>
		<div style="height:10px;"></div>
		<div class="content-bottom">
			<?php include_once('inc/index.gonggao.php'); ?>
			<?php include_once('inc/index.zhengce.php'); ?>
			<div style="clear:both;"></div>
		</div>
	</div>

<script>
$(document).ready(function(){
		$(".nav ul li:first").addClass("active");
});
</script>
<?php include_once('inc/index.footer.php'); ?>
<?php include_once('inc/footer.inc.php'); ?>

