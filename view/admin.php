<?php

/*
This PHP file is Back-end for LNews

The following actions can be perform in Backend are:
	1. Add news to the newsfeed
	2. Update news to the newsfeed
		- edit
		- delete
		- publish
		- unpublish
	3. Add category for the news


*/
include('../include/connect.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>LNews</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="../css/jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <style>
    .form-signin input{
    	width:25%;
    }
	.mainGrid{
		background-color: #dedede;
		overflow: auto;
		height: 40em;
  		padding: 20px;
	}
	.feed_text {
		margin-bottom:5px;
		min-height: 50px;
		word-wrap: break-word;
		overflow: hidden;
		padding: 5px;
		display: block;
		font-size: 12px;
		font-family: Verdana, Geneva, sans-serif;
		
	}
	.feed{
	border: 1px solid black;
	margin-bottom: 10px;
	}
	.feed_subject{
		font-size: 14px;
		font-weight: bold;
		padding-left: 5px;
	}
		.feed_time {
		font-size: 12px;
		font-style: italic;
		color: #999;
	}
    </style>
    <script>
    $( document ).ready(function() {
    	$('#textarea').keyup(function() {
    		$('#textareaspan').hide();
            var tlength = $(this).val().length;
            $(this).val($(this).val().substring(0,140));
            var tlength = $(this).val().length;
            remain = parseInt(tlength);
            $('#textarea').text(remain);
            if(tlength >= 140 ){
            	$('#textareaspan').show();
            }
         });    
	
		$('#subject').keyup(function() {
    		$('#subjectspan').hide();
            var tlength = $(this).val().length;
            $(this).val($(this).val().substring(0,80));
            var tlength = $(this).val().length;
            remain = parseInt(tlength);
            $('#subject').text(remain);
            if(tlength >= 80 ){
            	$('#subjectspan').show();
            }
         }); 
	});
	function updateNews(news_id,mode){
		if(mode=='delete'){
		confirm('Are you sure you want to delete the news?');
		}
		if(mode == 'edit'){
		
		 dialog = $( "#dialog-form" ).dialog({
    		  autoOpen: false,
      		  height: 300,
      		  width: 350,
      		  modal: true,
      			buttons: {
        			"Create an account": mode,
        			Cancel: function() {
          			dialog.dialog( "close" );
        		}
     	 }
   	 });
		}
		 $.ajax({
		url:"ajax_updateNews.php", 
		data:"news_id="+news_id+"&mode="+mode,
		success:function(data) {
			//alert(data);
			if(mode=='delete'){
			window.location.href = 'http://jb-production.com/rss/view/admin.php?mode=update';
			}else{
			$('#update_'+news_id).html(data);
			}
		}
	});
	}
    </script>
  </head>

  <body>

    <div class="container">
      <div class="header">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" ><a href="http://jb-production.com/rss/">Home</a></li>
            <li role="presentation"><a href="http://jb-production.com/rss/view/view.php">View</a></li>
            <li role="presentation" class="active"><a href="http://jb-production.com/rss/view/admin.php">Admin</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">LNews - Admin</h3>
      </div>
      
   		<p>
     	<a href='admin.php?mode=add' class='btn btn-default btn-lg'>Add News</a>
     	<a href='admin.php?mode=update' class='btn btn-default btn-lg'>Update News</a>
     	<a href='admin.php?mode=category' class='btn btn-default btn-lg'>Add Category</a>
     	</p>
     <?php
     
	  	$mode = $_GET['mode'];
	  	if($mode=='add'){
	   	 if($_POST['add']){
      		include('../include/function.php');
      		if($_POST['desc'] == '' || $_POST['fullname'] == '' || $_POST['subject'] == ''){
      			$error = true;
      		}else{
      			if($_FILES["fileToUpload"]['name'] == ''){
      			$error = true;
			 	}else{
      				$name = str_replace(' ', '', $_POST['fullname']);
					$Imagereturn = imageUpload($_FILES["fileToUpload"],$name,1000000);
						foreach($Imagereturn as $returnval){
							if($returnval['process'] == 'fail'){
					 			$ImageError[] = $returnval['error'];
							}else{
								$good_to_process = true;
					 $success = true;
					 $subject = $_POST['subject'];
					 $fullname = $_POST['fullname'];
					 $desc = $_POST['desc'];
					 $category = $_POST['category'];
					 $imagepath = $returnval['path'];
					 $subject = mysqli_real_escape_string($connect,$subject);
					 $desc = mysqli_real_escape_string($connect,$desc);
					 $fullname = mysqli_real_escape_string($connect,$fullname);
					// echo "INSERT INTO news (`subject`,`fullname`, `description`, `image_path`,`datetime`,`action_id`,`category_id`)
					 //				 VALUES ('".$subject."','".$fullname."','".$desc."','".$imagepath."',NOW(),'1','".$category."')";
					 $insertNews = mysqli_query($connect,"INSERT INTO news (`subject`,`fullname`, `description`, `image_path`,`datetime`,`action_id`,`category_id`)
					 				 VALUES ('".$subject."','".$fullname."','".$desc."','".$imagepath."',NOW(),'1','".$category."')");
							}
						}
					}
				}
			}	
	  	if(isset($success)){
      		if($success){
      			echo "<br>";
      			echo "<p class='bg-success' style='padding:10px; font-size:16px; font-weight:bold;'>
      			Successfully added 'News' into the Newsfeed.
      			</p>";
      		}
      	}
      	if(isset($ImageError)){
      		echo "<br>";
      		echo "<p class='bg-danger' style='padding:10px; font-size:12px; font-weight:bold;'> Please review the Error(s) below: <br>";
      			foreach($ImageError as $imageval){
      				echo $imageval."<br>";
      			}
      		echo "</p>";
      	}
      	if(isset($error)){
      		echo "<br>";
      		echo "<p class='bg-danger' style='padding:10px; font-size:16px; font-weight:bold;'	>
      					Error: please fill in all field(s).
      				</p>";
      	}
       echo "<br>";
       echo " In order to Add News on the newsfeed, you must fill in all the fields below. ";
	   echo "<br>";
      ?>
      
    	<form action='admin.php?mode=add' method='post' enctype='multipart/form-data'>
    	    <div class="form-group">
  			<label>Report's Full Name: </label>
  			<input type='text' size='25px' id='fullname' name='fullname' class="form-control">
  			</div>
  			
  			<div class="form-group">
  			<label>Subject: </label>
  			<input type='text' id='subject' name='subject' class="form-control" placeholder='Character limit 60'>
  			<span id='subjectspan' style='display:none; font-size:10px; color:red;'>
  			Reach max character limit: 80
  			</span>
  			</div>
  			
  			<div class="form-group">
  			<label>Description: </label>
  			<textarea id='textarea' class="form-control" name='desc' rows="2" cols="20"></textarea>
  			<span id='textareaspan' style='display:none; font-size:10px; color:red;'>
  			Reach max character limit: 140
  			</span>
  			</div>
  			
  			<div class="form-group">
  			<label>Category: </label>
  			<select name='category'>
  			<?php
  				$result = mysqli_query($connect,"select * from category");
  				while($row = $result->fetch_assoc()){
  					 $id = $row['id'];
  					$category = $row['category'];
  				echo "<option value='".$id."'>".$category."</option>";	
  				}
  			?>
  			</select>
  			</div>
  			
  			<div class="form-group">
  			<label>Image Upload: </label>
  			<input type="file" name="fileToUpload" id="fileToUpload"  class="btn btn-default btn-sm">
  			
  			<span id="helpBlock" class="help-block">Note: Thumbnail Image will only allow JPG, JPEF, and PNG. The max limit is 1000KB</span>
  			 </div>
  			 
  			 <div class="form-group">
  			 <input type='submit' name='add' value='Submit' class="btn btn-primary">
  			 </div>
  	 		</form>
      
      <?php
      }if($mode=='update'){
      	if($_POST['submit']){
    		if($_POST['desc'] == '' || $_POST['subject'] == ''){
      			$error = true;
      		}else{
      		 $subject = $_POST['subject'];
      		 $desc = $_POST['desc'];
      		 $subject = mysqli_real_escape_string($connect,$subject);
			 $desc = mysqli_real_escape_string($connect,$desc);
			 $update = mysqli_query($connect,"UPDATE news set `subject` = '".$subject."' , 
			 						`description` = '".$desc."', `datetime`=NOW() where id = '".$_GET['edit']."'");
			  //PHP Header location didn't work for me. so i did the cheat way.
			 ?>
			 	<script>
			 	window.location = "http://jb-production.com/rss/view/admin.php?mode=update";
			 	</script>
			 <?
      		}
      	if(isset($error)){
      		echo "<br>";
      		echo "<p class='bg-danger' style='padding:10px; font-size:16px; font-weight:bold;'	>
      					Error: please fill in all field(s).
      				</p>";
      		}
      	}
      if(!$_GET['edit']){
	  echo "There are 4 actions that can be perform with 'Update News':";
	  echo "<ul>";
	  echo "<li> <i class='fa fa-pencil'></i> - Edit - will allow to edit the Subject and Description. ";
	  echo "<li> <i class='fa fa-trash'></i> - Delete - will delete the news.  ";
	  echo "<li> <i class='fa fa-arrow-circle-down'></i> - UN-Publish - will not show on the Newsfeed.  ";
	  echo "<li> <i class='fa fa-arrow-circle-up'></i> - Publish - will show on the Newsfeed. ";
	  echo "</ul>";
	 }
	  if($_GET['edit'] ){
	  	$edit_id =  $_GET['edit'];
	  	$result = mysqli_query($connect,"select * from news where id = '".$edit_id."' ");
  		 while($row = $result->fetch_assoc()){
  					 $id = $row['id'];
  					 $subject = $row['subject'];
  					 $description = $row['description'];
  			echo "<form action='admin.php?mode=update&edit=$id' method='post' >";
  			
  			echo '<div class="form-group">';
  			echo '<label>Subject: </label>';
  			echo "<input type='text' id='subject' name='subject' value='".$subject."' class='form-control' placeholder='Character limit 60'>";
  			echo "<span id='subjectspan' style='display:none; font-size:10px; color:red;'>";
  			echo "Reach max character limit: 80";
  			echo "</span>";
  			echo "</div>";
  			
  			echo '<div class="form-group">';
  			echo "<label>Description: </label>";
  			echo "<textarea id='textarea' class='form-control' name='desc' rows='2' cols='20'>".$description."</textarea>";
  			echo "<span id='textareaspan' style='display:none; font-size:10px; color:red;'>";
  			echo "Reach max character limit: 140";
  			echo "</span>";
  			echo "</div>";
  			echo 	'<div class="form-group">';
  			echo	"<input type='submit' name='submit' value='Submit' class='btn btn-primary'>";
  			echo	'</div>';
  			echo "</form>";	
  		}
	  }
	  if(!$_GET['edit']){
	  echo "<div class='mainGrid'>";
		$result = mysqli_query($connect,"select * from news");
  		 while($row = $result->fetch_assoc()){
  					 $id = $row['id'];
  					 $subject = $row['subject'];
  					 $description = $row['description'];
					 $actions = $row['action_id'];
					 if($actions == '1'){
						$stage = 'published';
					 }else{
						$stage = 'un-published';
					 }
				echo "<div class='feed'>";
				echo "<span id='update_$id' style='padding-left:30px; color:green;' ></span>";
				echo "<div class='feed_subject'>";
				echo $subject;
				echo "</div>";
				echo "<div class='feed_text'>";
				echo $description;
				
				echo "<div class='feed_time'>Currently the news is on ".$stage." stage</div>";
				echo "<span style='padding-left:30px; cursor:pointer;'>";
				echo '<a  href="admin.php?mode=update&edit='.$id.'" style="color:blue;"><i class="fa fa-pencil"></i></a>';
				echo '&nbsp;&nbsp;<a onClick=\'updateNews('.$id.',"delete");\' style="color:orange;"><i class="fa fa-trash"></i> </a>
						&nbsp;&nbsp;<a onClick=\'updateNews('.$id.',"unpublish");\' style="color:red;"><i class="fa fa-arrow-circle-down"></i></a>
						&nbsp;&nbsp;<a onClick=\'updateNews('.$id.',"publish");\' style="color:green;"><i class="fa fa-arrow-circle-up"></i></a>';
				echo "</span>";
				
				echo "</div>";
				echo "</div>";
				echo "</form>";
  		    }
      echo "</div>";
	  echo "<br>";
      }
      }
	  
	  if($mode=='category'){
	 	if($_POST['submit']){
	 	
	 		$category = $_POST['category'];
	 		if($categor != ''){
	 		 $category = mysqli_real_escape_string($connect,$category);
	 		$insert = mysqli_query($connect,"INSERT INTO category (`category`) VALUES ('".$category."')");
	 		}
	 	}
	  echo "<form action='admin.php?mode=category' method='post' >";
	  echo "More category is fun! you can create new category and append it to the news.";
	  echo "<br>";
	  echo "<br>";
	  echo 	'<div class="form-group">';
  	  echo 		"<label>New Category </label>";
  	   echo 	"<input type='text' size='25px' id='category' name='category' class='form-control'>";
  	   echo	 '</div>';
	   echo 	'<div class="form-group">';
  		echo	"<input type='submit' name='submit' value='Submit' class='btn btn-primary'>";
  		echo	'</div>';
	
	  echo "<br>";
	  
	  echo "Here is the existing category:";
	  $result = mysqli_query($connect,"select * from category");
  		 echo "<ul>";
		 while($row = $result->fetch_assoc()){
		 echo "<li>".$row['category']."</li>";
		 }
		 echo "</ul>";
	  }
      ?>

    </div> <!-- /container -->

  </body>
</html>
