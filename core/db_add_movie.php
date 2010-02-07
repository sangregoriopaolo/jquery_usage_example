<?php
 include ('includes/config.php');
 $db=connect();
 
  $title = $db->escapeString($_POST['movie_title']);
  $description = $db->escapeString($_POST['movie_description']);
  $trailer_url = $db->escapeString($_POST['movie_trailer_url']);
  $image_url = $db->escapeString($_POST['movie_image_url']);
	
	if($db->exec("INSERT INTO movies (title, description, trailer_url, image) VALUES ('$title', '$description', '$trailer_url', '$image_url')"))
	{
	 $status['status']='ok';
	}
	else
	{
	 $status['status']='error';
	 $ststus['code']=$db->lastErrorCode();
	 $status['msg']=$db->lasteErrorMsg();
	}
 echo json_encode($status);
?>