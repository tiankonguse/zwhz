<div class="friend">
	<div class="caption">
		<span class="caption-name hezuo"><strong>友情链接</strong></span>
		<span><img src="img/ak17.jpg"></span>
	</div>
	<?php
		if(!$conn || !$result || $ret || !getFriendLinkList(7,8)){
			echo "			
				<div class='friend-item'>
					<div class='friend-item-name'>
						服务器出现问题，请联系管理员
					</div>						
				</div>";
		}
	?>
</div>

<?php
function getFriendLinkList($type){
	global $conn;
	$sql = "select * from main WHERE code = '$type' ORDER BY id DESC ";
	$result = @mysql_query($sql ,$conn);
	if(!$result){
		return false;
	}
	
	$num = 0;
	while($row=@mysql_fetch_array($result)){
		$num++;
		echo "						
			<div class='friend-item'>
				<div class='friend-item-name'>
					<a href='".$row['content']."'>".$row['title']."</a>
				</div>						
			</div>";
		if($num == 4)break;
	}
	if($num == 0){
		echo "						
			<div class='friend-item'>
				<div class='friend-item-name'>
					暂时没有友情链接
				</div>						
			</div>";
	}
	return true;
}

?>