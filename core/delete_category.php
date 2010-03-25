<?php
    include("includes/config.php");
	
	$db=connect();
	
	$id=$_GET['id'];
	
	
	$query="DELETE FROM movies WHERE category_id=".$id;
	if(!$db->query($query))
	 {
	 	header("Location: list_movies.php?cat=-1&fav=0&err=1");
	 }	
	
	$query="DELETE FROM categories WHERE id=".$id;
	
	if($db->query($query))
	  header("Location: list_movies.php?cat=-1&fav=0");
	else
	 {
	 	header("Location: list_movies.php?cat=-1&fav=0&err=1");
	 }
	 
	$db->close();
?>