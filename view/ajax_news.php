<html>

<head>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<script>

  $(document).ready(function(){
  	
					$('.mainGrid').perfectScrollbar('destory');
				
  });
function thumbsDown(news_id){
 
	 $.ajax({
		url:"ajax_vote.php", 
		data:"news_id="+news_id+"&mode=down",
		success:function(data) {
		//alert(data);
			$('#down_'+news_id).html(data);
		}
	});
}
function thumbsUp(news_id){

	 $.ajax({
		url:"ajax_vote.php", 
		data:"news_id="+news_id+"&mode=up",
		success:function(data) {
			//alert(data);
			$('#up_'+news_id).html(data);
		}
	});
}

</script>
</head>
<body>
<?php
include('../include/connect.php');



	$news = mysqli_query($connect,"select vote.up, vote.down, news.id as newsid ,news.fullname, news.subject, news.description,
				news.datetime,news.image_path,category.category 
					from news 
					left join category on
					category_id = category.id
					left join vote on
					news.id = vote.news_id
					where news.action_id = '1'
					ORDER BY news.id desc");
			
	$count = mysqli_num_rows($news);
	
	if($count>0){
	
		while($row = $news->fetch_assoc()){
			$id = $row['newsid'];
			$fullname =  $row['fullname'];
			$subject = $row['subject'];
			$description = $row['description'];
			$datetime = $row['datetime'];
			$category = $row['category'];
			$imagepath = $row['image_path'];
			$up = $row['up'];
			$down = $row['down'];
			if(!isset($down)){
				$down = 0;
			}
			if(!isset($up)){
				$up = 0;
			}
			
			echo "<div id='feed_$id' class='feed_body'>";
			echo "<div class='feed_img'>";
				echo "<img src='".$imagepath."'>";
			echo "</div>";
			echo "<div class='feed_text'>";
			 echo "<div class='feed_subject'>";
				echo $subject.' <span class="feed_time">Submitted by: '.$fullname."</span>";
			 echo "</div>";
				echo $description;
			
				echo "<div class='feed_time'>";
				echo "Category: ".$category.' <i class="fa fa-clock-o"></i> Posted on: '.$datetime;
				echo "</div>";
			echo "<div class='feed_vote'>";
			echo " &nbsp;&nbsp;  <a title='Like' onClick='thumbsUp($id)'><i class='fa fa-thumbs-up'></i></a> <span  id='up_$id' style='color:green'>".$up."</span>";
			echo "&nbsp;&nbsp; <a title='Dislike' onClick='thumbsDown($id)'><i class='fa fa-thumbs-down'></i></a>  <span id='down_$id' style='color:red;'>".$down."</span>";
		
			
			echo "</div>";
			echo "</div>";
			
			echo "<br>";
		}
	}else{
		echo "No Result to Load.";
	}
?>
</body>
</html>