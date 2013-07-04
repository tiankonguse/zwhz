<div class="content-hezuo  float-left  content-top-height">
	<div class="caption">
		<span class="caption-name hezuo"><strong>合作动态</strong></span>
		<span><img src="img/ak17.jpg"></span>
		<span><a href="newsList.php?type=1" style="font-size: 12px;">M O R E &gt;&gt;</a></span>
	</div>
	<?php
		if(!$conn || !$result || $ret || !gethezuoList(1,9,1)){
			echo "						
				<div class='hezuo-item'>
					<div class='hezuo-item-name'>
						".$ret["message"]."
					</div>						
				</div>";
		}
	?>
</div>


<?php  

function gethezuoList($type,$rowNum,$haveTime){
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
			<div class='hezuo-item'>
				<div class='hezuo-item-name'>
					<a href='news.php?type=$type&id=".$row['id']."'>".$row['title']."</a>
				</div>";
			if($haveTime){
				echo "<div class='hezuo-item-time'>".substr($row['time'],0,10)."</div>";
			}
			echo "</div>";
	}
	
	if($num == 0){
		echo "						
			<div class='hezuo-item''>
				<div class='hezuo-item-name'>
					暂时没有内容
				</div>
			</div>";
	}
	return true;
}

?>