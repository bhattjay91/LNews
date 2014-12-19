<?php
/*
This PHP file is the Fron-end for the LNews site
 
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
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	 <link href="../css/perfect-scrollbar.min.css" rel="stylesheet">
     <script src="../js/perfect-scrollbar.min.js"></script>
  <script>
  $(document).ready(function(){
 
  	 $.ajax({
   				 url:"ajax_news.php",  
    			 success:function(data) {
				
					$('.mainGrid').html(data);
					setTimeout(function() {
					$('.mainGrid').perfectScrollbar();
					},50);
    			 }
  			});
	});
var limits = 0;
function getRespondBack(counter){

	var time = counter;
		if(time < 1){
			return; 
		}
		if(time % 5==0){
			 $.ajax({
   				 url:"ajax_news.php",  
    			 success:function(data) {
					$('.mainGrid').html(data);
					setTimeout(function() {
					$('.mainGrid').perfectScrollbar();
					},50);
    			 }
  			});
		}
	setTimeout(function() {
		if(counter == 1){
	
		}
	getRespondBack(time+1);
	
	},1000);
	
}
getRespondBack(1);

</script>
  <style>
  .footer {
position: absolute;
bottom: 0;
width: 100%;
height: 60px;
background-color: #f5f5f5;
}
  	.mainGrid{
  		position:fixed;
   		top: 35%;
    	left: 40%;
    	width:50%;
    	height: 80%;
  		padding: 20px;
    	margin-top: -9em; /*set to a negative number 1/2 of your height*/
    	margin-left: -15em; /*set to a negative number 1/2 of your width*/
    	border-radius: 15px;
    	overflow: hidden;
    	
  	}
  	.feed_img img{
		float: left;
		height: 80px;
		width: 80px;
		border: solid 1px #eee;
		padding: 5px;
		cursor: pointer;
	}
	.feed_text {
		margin-left: 70px;
		min-height: 50px;
		word-wrap: break-word;
		overflow: hidden;
		padding: 5px;
		display: block;
		font-size: 12px;
		font-family: Verdana, Geneva, sans-serif;
	}
	.feed_subject{
		font-size: 14px;
		font-weight: bold;
	}
	.feed_hash{
		font-size: 10px;
	}
	.feed_time {
		font-size: 12px;
		font-style: italic;
		color: #999;
	}
	.feed_body{
		min-height: 70px;
		margin-bottom: 10px;
		
	}
	.feed_vote{
	font-size: 12px;
	padding-right: 10px;
	cursor:pointer;
	}
  </style>
  </head>

  <body>

    <div class="container">
      <div class="header">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" ><a href="http://jb-production.com/rss">Home</a></li>
            <li role="presentation" class="active"><a href="http://jb-production.com/rss/view/view.php">View</a></li>
            <li role="presentation"><a href="http://jb-production.com/rss/view/admin.php">Admin</a></li>
          </ul>
        </nav>
     
        <h3 class="text-muted">LNews - Newsfeed</h3>
      
      
<br>

<!--AJAX will output the content into the DIV below -->
<div class="mainGrid"></div>
</div>
</div>
<footer class="footer">
      <div class="container">
        <p class="text-muted">LNews will feed news directly to the page without refreshing the browser. Relax and Watch the News.</p>
      </div>
</footer>
	
  </body>
</html>
