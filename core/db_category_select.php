<?php
   include("includes/config.php");
   
   $db=connect();
   
   $attr=$_POST['attr'];
   $value=$_POST['value'];
   $id=$_POST['id'];

   if(isset($attr))
   {
   	$query="UPDATE movies SET ".$attr."='".$value."' WHERE id=".$id;
	$db->query($query);
	
	$query="SELECT * FROM categories WHERE id=".$value;
	$categories=$db->query($query);
	$cat=$categories->fetchArray(SQLITE3_ASSOC);
	
	echo $cat['name'];
   }
   else
   {
   	$query="SELECT * FROM categories";
   
   	$categories=$db->query($query);
   
	while($cat=$categories->fetchArray(SQLITE3_ASSOC)){
   			$arr[$cat['id']]=$cat['name'];
		}
	echo json_encode($arr);
   }
   
   disconnect($db);  
   
?>