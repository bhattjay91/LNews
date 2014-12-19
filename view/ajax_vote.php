<?php
include('../include/connect.php');
$news_id = $_GET['news_id'];
$mode = $_GET['mode'];
if($mode == 'down'){
	$check = mysqli_query($connect,"select * from vote where news_id = '".$news_id."'");
	$checkCount = mysqli_num_rows($check);
	if($checkCount > 0){
	//update the vote table
	$down = $check->fetch_assoc();
	$downs = $down['down'];

	$update = mysqli_query($connect,"UPDATE vote set `down` = $downs+1 where news_id = '".$news_id."'");
	echo $downs+1;
	}else{
	$insert = mysqli_query($connect,"INSERT INTO vote (`news_id`,`up`,`down`) VALUES ('".$news_id."','0','1')");
	echo "1";
	}
}else if($mode == 'up'){
	$check = mysqli_query($connect,"select * from vote where news_id = '".$news_id."'");
	$checkCount = mysqli_num_rows($check);
	if($checkCount > 0){
	//update the vote table
	$up = $check->fetch_assoc();
	$ups = $up['up'];

	$update = mysqli_query($connect,"UPDATE vote set `up` = $ups+1 where news_id = '".$news_id."'");
	echo $ups+1;
	}else{
	$insert = mysqli_query($connect,"INSERT INTO vote (`news_id`,`up`,`down`) VALUES ('".$news_id."','1','0')");
	echo "1";
	}
}

?>