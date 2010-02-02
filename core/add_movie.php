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
    
    if($db->exec("INSERT INTO movies (title, description, trailer_url, image) VALUES ('$title', '$description', '$trailer_url', '$image_url')"))
    {
        header('Location: list_movies.php?saved=1');
    }
    else
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
                <label for="movie_description">Description</label><br>
                <textarea name="movie_description" rows="10"></textarea>
            </li>
            <li>
                <label for="movie_description">Trailer URL</label><br>
                <input type="text" name="movie_trailer_url" />
            </li>
            <li>
                <label for="movie_description">Image URL</label><br>
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