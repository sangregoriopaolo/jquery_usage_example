<?php
include('includes/config.php');

#Connecting to the database
$db = connect();

$name=$_POST['name'];
if(isset($name))
{
 $query="INSERT INTO categories ('name') VALUES ('$name')";
 if($db->query($query))
   header('Location: add_movie.php');
  else
   header('Location: list_movies.php?err=1');

}

disconnect($db);
include('include/header.php');
?>
<form action="add_category.php" method="post">
 <label for="name">Category name</label>
 <input type="text" name="name" />
 <br>
 <input type="submit" value="Save" />
</form>