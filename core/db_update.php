<?php
include ('./includes/config.php');
$db=connect();
$attr=$_POST['attr'];
$value=$_POST['value'];
$id=$_POST['id'];

$query="UPDATE movies SET ".$attr."='".$value."' WHERE id=".$id;
$db->query($query);

disconnect($db);
echo $value;
?>