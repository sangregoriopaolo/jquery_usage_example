<?php
    include("includes/config.php");
	
	$db=connect();
	
	$id=$_POST['id'];
	
	
	$query="DELETE FROM movies WHERE category_id=".$id;
	if($db->query($query))
	  $response['status']='ok';
	else
	 {
	 	$response['status']='error';
		$response['code'] = $db->lastErrorCode();
		$response['msg'] = $db->lastErrorMsg();
		echo json_encode($response);
		die();
	 }	
	
	$query="DELETE FROM categories WHERE id=".$id;
	
	if($db->query($query))
	  $response['status']='ok';
	else
	 {
	 	$response['status']='error';
		$response['code'] = $db->lastErrorCode();
		$response['msg'] = $db->lastErrorMsg();
	 }
	 
	 echo json_encode($response);
	 
	$db->close();
?>