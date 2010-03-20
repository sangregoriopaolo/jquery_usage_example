<?php
include('includes/config.php');

#Connecting to the database
$db = connect();

#Get the action
$action = (isset($_POST['action']) ? $_POST['action'] : 'new');

if($action == 'Save') {
    $title = $db->escapeString($_POST['movie_title']);
    $description = $db->escapeString($_POST['movie_description']);
    $trailer_url = $db->escapeString($_POST['movie_trailer_url']);
    $image_url = $db->escapeString($_POST['movie_image_url']);
	$director = $db->escapeString($_POST['director']);
	$producer = $db->escapeString($_POST['producer']);
	$cat = $db->escapeString($_POST['category']);
    
    if($db->exec("INSERT INTO movies (title, description, trailer_url, image,director,producer,category_id) VALUES ('$title', '$description', '$trailer_url', '$image_url','$director','$producer',$cat)"))
    {
        header('Location: list_movies.php?saved=1');
    }
    else
    {
        header('Location: list_movies.php?err=1');
    }
}
else
{
//new film
	$query="SELECT * FROM categories";
	if(!$ris=$db->query($query))
    {
        header('Location: list_movies.php?err=1');
    }
}

# ---- TEMPLATE START ----
?>
    <?php include('includes/header.php'); ?>
    <style>
        ul {
            width: 305px;
        }
        li {
            list-style: none;
            padding-bottom: 20px;
        }
        #submit_container {
            text-align: right;
        }
        input[type=text] {
            width: 300px;
        }

        textarea {
            width: 305px;
        }
    </style>
    <h2>New movie</h2>
    <form action="add_movie.php" method="POST">
        <ul>
            <li>
                <label for="movie_title">Title</label><br>
                <input type="text" name="movie_title" />
            </li>
	        <li>
                <label for="director">Director</label><br>
                <input type="text" name="director" />
            </li>
	        <li>
                <label for="producer">Producer</label><br>
                <input type="text" name="producer" />
            </li>
            <li>
                <label for="movie_description">Description</label><br>
                <textarea name="movie_description" rows="10"></textarea>
            </li>
			<li>
                <label for="category">Category</label><br>
                <select name="category" >
					<?php 
					while($cat=$ris->fetchArray())
					{
					 echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
					}
					?>
				</select>
            </li>
            <li>
                <label for="movie_trailer_url">Trailer URL</label><br>
                <input type="text" name="movie_trailer_url" />
            </li>
            <li>
                <label for="movie_image_url">Image URL</label><br>
                <input type="text" name="movie_image_url" />
            </li>
            <li id="submit_container">
                <input type="submit" name="action" value="Save" />
            </li>
        </ul>
    </form>
    <?php include('includes/footer.php'); ?>
<?php
# ---- TEMPLATE END ----
#Closing the database connection
disconnect($db);
?>