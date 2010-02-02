<?php
include('includes/config.php');

#Connecting to the database
$db = connect();


$id = $_GET['movie_id'];

if($db->exec("DELETE FROM movies WHERE id = $id"))
{
    header('Location: list_movies.php?deleted=1');
}
else
{
    header('Location: list_movies.php?err=2');
}

#Closing the database connection
disconnect($db);
?>