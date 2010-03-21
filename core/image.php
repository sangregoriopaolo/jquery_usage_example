<?php
include('includes/config.php');

#Connecting to the database
$db = connect();

$url=$_GET['url'];

disconnect($db);

?>
<img src='<?php echo $url;?>' />
<br>
<a href="list_movies.php?cat=-1&fav=0">Return</a>