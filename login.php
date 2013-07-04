<?php
$title = "中外合作办学网站后台管理登录";
include_once('inc/header.inc.php');
if(isset($_SESSION["username"]) && strcmp($_SESSION["username"],"")!=0){
	header("location:manger.php");
	die();
}
?>
<div id="wrap">
	<div class="container">
		<div class="page-header">
			<h1><?php echo $title?></h1>
		</div>
		
		  <form class="form-signin" action="" method="post">
			<h1 class="form-signin-heading" style="text-align: center;font-size: 35.5px;">登录</h1>
			<div>
			<span>用户名：</span><input name="username" type="text" class="input-block-level" placeholder="Username" style="display: inline;width: 200px;">
			</div>
			<div>
			<span>密 码：</span><input name="password" type="password" class="input-block-level" placeholder="Password" style="display: inline;width: 200px;">
			</div>
			
			<button class="btn btn-large btn-primary" type="submit">提交</button>
			<a id="register" class="btn btn-large btn-success" >注册</a>
		  </form>
	</div>
</div>
<script>


$("#register").click(function(){
	showMessage("注册功能已关闭。若要添加用户，请联系管理员。");
	return false;
});

$("form").submit(function(){
	var I = this;
	if(this.username.value == "" || this.password.value == ""){
		showMessage("你有空缺的表单项目没有完成！");
	}else{
		$.post("inc/manger.ajax.php?mangercode=1",{
			username:I.username.value,
			password:I.password.value
		},function(d){
			if(d.code==0){
				showMessage(d.message,function(){window.location = "manger.php";},4000);
			}else{
				showMessage(d.message);
			}
		},"json");
	}
	return false;
});

</script>
<script src="js/bootstrap.js"></script>
 
<?php 
	include_once('inc/footer.inc.php'); 
?>

