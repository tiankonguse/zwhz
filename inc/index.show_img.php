<div class="show-img float-left content-top-height">
	<div id="myCarousel" class="carousel slide">
	  <!-- Carousel items -->
	  <div class="carousel-inner">
<?php
	$ok = true;
	if(!$conn || !$result || $ret || !getImgList(8)){
		$ok = false;
		echo "<p>出现一些问题，请联系管理员</p>";
	}
?>	
	  </div>
	  <!-- Carousel nav -->
	  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>

<?php if($ok){ ?>
<script>
$(document).ready(function(){
	$("#myCarousel carousel-inner item:first").addClass("active");
	$("#myCarousel .right").click();
	$(".show-img").mouseover(function(){
		$(".carousel-control").css("display","inline");
	});
	$(".show-img").mouseout (function(){
		$(".carousel-control").css("display","none");
	});
	
	setInterval(imgClick,5000);
	
	function imgClick(){
		$(".carousel-control").css("display","inline");
		$("#myCarousel .right").click();
		$(".carousel-control").css("display","none");
	}
});
</script>
<?php } ?>



<?php 

function getImgList($type){
	global $conn;
	$sql = "select * from main WHERE code = '$type' ORDER BY id DESC";
	$result = @mysql_query($sql ,$conn);
	
	if(!$result){
		return false;
	}
	
	$num = 0;
	while($row=@mysql_fetch_array($result)){
		$num++;
		
		echo "		
			<div class='item'>
				<img src='".$row['content']."' class='img-size' alt=''>
				<div class='carousel-caption'>
					<p>".$row['title']."</p>
				</div>
			</div>";
	}
	
	if($num == 0){
		echo "<p>暂时没有内容</p>";
	}
	return true;
}
?>