<?php
   include("includes/config.php");
   
   $db=connect();
   
   $query="SELECT * FROM categories";
   
   if($categories=$db->query($query)){
   	$i=0;
	$response['status']='ok';
	while($cat=$categories->fetchArray(SQLITE3_ASSOC)){
   		$arr[$i]['id']=$cat['id'];
		$arr[$i]['name']=$cat['name'];
   		$i++;
	}
	$response['num']=$i;
	$response['cat']=$arr;
   }else{
   	$response['status']='error';
	$response['msg']=$db->lastErrorMsg();
	$response['code']=$db->lastErrorCode();;
   }
   
   echo json_encode($response);
?>