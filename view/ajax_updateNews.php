<?php
include('../include/connect.php');
$news_id = $_GET['news_id'];
$mode = $_GET['mode'];
if($mode == 'delete'){
$delete = mysqli_query($connect,"DELETE FROM news where id = $news_id");
echo "successfull deleted";
}
if($mode == 'unpublish'){
$update = mysqli_query($connect,"UPDATE news set `action_id` = '0' where id=$news_id");
echo "successfull unpublish";
}
if($mode == 'publish'){
$update = mysqli_query($connect,"UPDATE news set `action_id` = '1' where id=$news_id");
echo "successfull publish";
}
?>