<div class="content-zhengce  float-left  content-bottom-height">
	<div class="caption">
		<span class="caption-name zhengce"><strong>政策文件</strong></span>
		<span><img src="img/ak17.jpg"></span>
		<span><a href="newsList.php?type=3" style="font-size: 12px;">M O R E &gt;&gt;</a></span>
	</div>
	<?php
		if(!$conn || !$result || $ret || !getzhengceList(3,8,1)){
			echo "						
				<div class='zhengce-item'>
					<div class='zhengce-item-name'>
						".$ret["message"]."
					</div>						
				</div>";
		}
	?>
</div>

<?php  



function getzhengceList($type,$rowNum,$haveTime){
	global $conn;
	$sql = "select * from main WHERE code = '$type' ORDER BY id DESC LIMIT 0 , $rowNum ";
	$result = @mysql_query($sql ,$conn);
	
	if(!$result){
		return false;
	}
	
	$num = 0;
	while($row=@mysql_fetch_array($result)){
		$num++;
		echo "						
			<div class='zhengce-item'>
				<div class='zhengce-item-name'>
					<a href='news.php?type=$type&id=".$row['id']."'>".$row['title']."</a>
				</div>";
			if($haveTime){
				echo "<div class='zhengce-item-time'>".substr($row['time'],0,7)."</div>";
			}
			echo "</div>";
	}
	
	if($num == 0){
		echo "						
			<div class='zhengce-item'>
				<div class='zhengce-item-name'>
					暂时没有内容
				</div>";
			echo "</div>";
	}
	return true;
}

?>