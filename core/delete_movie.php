<?php
include('includes/config.php');

#Connecting to the database
$db = connect();


$id = $_GET['movie_id'];

if($db->exec("DELETE FROM movies WHERE id = $id"))
{
    header('Location: list_movies.php?deleted=1&cat=-1&fav=0');
}
else
{
    header('Location: list_movies.php?err=2&cat=-1&fav=0');
}

#Closing the database connection
disconnect($db);
?>