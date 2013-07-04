 <?php
	include_once('inc/check.php');
	require_once("inc/init.php");
	$title = "中外合作办学网站后台管理登录";
	include_once('inc/header.inc.php');
?>
 <div class="manger_middle_left">
<div class="accordion manger_middle_menu" id="accordion1">

	<div class="accordion-group">
		<div class="menu_name">
			<a data-toggle="collapse" data-parent="#accordion1" href="#menuone" class="accordion-toggle btn btn_menu">设置管理员</a>
		</div>
		<div id="menuone"  class="accordion-body collapse in">
			<div class="accordion-inner">
				<div class="menu_list_item"><a href="alterInfo.php" target="right">个人信息修改</a></div>
				<div class="menu_list_item"><a href="mangerUser.php" target="right">管理员管理</a></div>
				<div class="menu_list_item"><a href="addMangerUser.php" target="right">添加管理员</a></div>
			</div>
		</div>
	</div>


	<div class="accordion-group">
		<div class="menu_name">
			<a data-toggle="collapse"  data-parent="#accordion1"  href="#menutwo" class="accordion-toggle btn btn_menu" >合作动态</a>
		</div>
		<div id="menutwo"  class="accordion-body collapse">
			<div class="accordion-inner">
				<div class="menu_list_item"><a href="viewContentList.php?type=1" target="right">查看合作动态</a></div>
				<div class="menu_list_item"><a href="addContent.php?type=1" target="right">添加合作动态</a></div>
			</div>
		</div>
	</div>


	<div class="accordion-group">
		<div class="menu_name">
			<a data-toggle="collapse"  data-parent="#accordion1"  href="#menuthree" class="accordion-toggle btn btn_menu">合作院校</a>
		</div>
		<div id="menuthree"  class="accordion-body collapse">
			<div class="accordion-inner">
				<div class="menu_list_item"><a href="viewContentList.php?type=2" target="right">查看合作院校</a></div>
				<div class="menu_list_item"><a href="addContent.php?type=2" target="right">添加合作院校</a></div>
			</div>
		</div>
	</div>


	<div class="accordion-group">
		<div class="menu_name">
			<a data-toggle="collapse" data-parent="#accordion1" href="#menufour" class="accordion-toggle btn btn_menu">政策文件</a>
		</div>
		<div id="menufour" class="accordion-body collapse">
			<div class="accordion-inner">
				<div class="menu_list_item"><a href="viewContentList.php?type=3" target="right">查看政策文件</a></div>
				<div class="menu_list_item"><a href="addContent.php?type=3" target="right">添加政策文件</a></div>
			</div>
		</div>
	</div>


	<div class="accordion-group">
		<div class="menu_name">
			<a data-toggle="collapse" data-parent="#accordion1" href="#menufive" class="accordion-toggle btn btn_menu">通知公告</a>
		</div>
		<div id="menufive" class="accordion-body collapse">
			<div class="accordion-inner">
				<div class="menu_list_item"><a href="viewContentList.php?type=4" target="right">查看通知公告</a></div>
				<div class="menu_list_item"><a href="addContent.php?type=4" target="right">添加通知公告</a></div>
			</div>
		</div>
	</div>

	<div class="accordion-group">
		<div class="menu_name">
			<a data-toggle="collapse" data-parent="#accordion1" href="#menusix" class="accordion-toggle btn btn_menu">合作项目</a>
		</div>
		<div id="menusix" class="accordion-body collapse">
			<div class="accordion-inner">
				<div class="menu_list_item"><a href="viewContentList.php?type=5" target="right">查看合作项目</a></div>
				<div class="menu_list_item"><a href="addContent.php?type=5" target="right">添加合作项目</a></div>
			</div>
		</div>
	</div>


	<div class="accordion-group">
		<div class="menu_name">
			<a data-toggle="collapse" data-parent="#accordion1" href="#menuseven" class="accordion-toggle btn btn_menu">组织机构</a>
		</div>
		<div id="menuseven" class="accordion-body collapse">
			<div class="accordion-inner">
				<div class="menu_list_item"><a href="viewContent.php?type=6" target="right">查看组织机构</a></div>
			</div>
		</div>
	</div>
	
	<div class="accordion-group">
		<div class="menu_name">
			<a data-toggle="collapse" data-parent="#accordion1" href="#menueight" class="accordion-toggle btn btn_menu">友情链接</a>
		</div>
		<div id="menueight" class="accordion-body collapse">
			<div class="accordion-inner">
				<div class="menu_list_item"><a href="viewFrendLink.php" target="right">查看友情链接</a></div>
				<div class="menu_list_item"><a href="addFrendLink.php" target="right">添加友情链接</a></div>
			</div>
		</div>
	</div>
	
	<div class="accordion-group">
		<div class="menu_name">
			<a data-toggle="collapse" data-parent="#accordion1" href="#menunine" class="accordion-toggle btn btn_menu">动态图片</a>
		</div>
		<div id="menunine" class="accordion-body collapse">
			<div class="accordion-inner">
				<div class="menu_list_item"><a href="viewImg.php" target="right">查看动态图片</a></div>
				<div class="menu_list_item"><a href="addImg.php" target="right">添加动态图片</a></div>
			</div>
		</div>
	</div>

	
</div>

</div>
<?php 
	if(isset($_GET['message'])){
		echo "<script>$(function(){showMessage('" . $_GET['message'] . "');});</script>";
	} 
	include_once('inc/footer.inc.php'); 
	require_once("inc/end.php");
?>