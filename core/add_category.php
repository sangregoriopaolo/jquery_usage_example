<?php
include('includes/config.php');

#Connecting to the database
$db = connect();

$name=$_POST['name'];
if(isset($name))
{
 $query="INSERT INTO categories ('name') VALUES ('$name')";
 echo $_GET['page'];
 if($db->query($query))
   header('Location: add_movie.php');
  else
   header('Location: list_movies.php?err=1&cat=-1&fav=0');

}

disconnect($db);
include('includes/header.php');
?>
<form action="add_category.php" method="post">
 <label for="name">Category name</label>
 <input type="text" name="name" />
 <br>
 <br>
 <input type="submit" value="Save" />
 <input type="button" value="return" onclick="javascript:history.back();" />
</form>
<?php include ('includes/foote.php'); ?>