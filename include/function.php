<?php
function imageUpload($fileupload,$name,$maxSize){
	
			$target_dir = "../uploads/";
			$target_file = $target_dir . basename($fileupload["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file);
			// Check if image file is a actual image or fake image
			
			if(isset($_POST["submit"])) {
					$check = getimagesize($fileupload["tmp_name"]);
					
				if($check !== false) {
						$uploadOk = 1;
					} else {
						$return[] = array('process'=>'fail','error'=>'Image File was not a image. Please select Image');
						$uploadOk = 0;
					}
				}
				// Check if file already exists
				if (file_exists($target_file)) {
					$return[] = array('process'=>'fail','error'=>'Image already exits, please choose different file.');
					$uploadOk = 0;
				}
				// Check file size
				if ($fileupload["size"] > $maxSize) {
					$return[] = array('process'=>'fail','error'=> 'Image file is too large, the max limit is 300kb');
					$uploadOk = 0;
				}
				// Allow certain file formats
				$ext = array("jpg", "png", "jpeg", "JPG","PNG","JPEFG");
				if(!in_array($imageFileType['extension'],$ext)) {
					$return[] = array('process'=>'fail','error'=> 'Only JPG, JPEG, & PNG  files are allowed.');
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					return $return;
				} else {
					$newTargetile = $imageFileType['filename'].'_'.$name.'.'.$imageFileType['extension'];
				
					
					if (move_uploaded_file($fileupload["tmp_name"],$target_dir.$newTargetile)) {
					
						
						$return[] = array('process'=>'works', 'path'=>$target_dir.$newTargetile);
						return $return;
					} else {
						$return[] = array('process'=>'fail','error'=>  'Error: Sorry, something went wrong. Please Try again');
						return $return;
					}
				
				}
			
}
?>