<?php
    include("includes/config.php");
	$db=connect();
	
	$id=$_GET['id'];
	$fav=$_GET['favourite'];
	
	$query="UPDATE movies SET favourite=".$fav." WHERE id=".$id.";";
	if($db->query($query))
		$response['status']='ok';
	else{
		$response['status']='error';
		$response['code'] = $db->lastErrorCode();
	    $response['msg'] = $db->lastErrorMsg();
	}
	
	echo json_encode($response);
	
	$db->close();
?>