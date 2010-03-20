<?php
include('includes/config.php');

#Connecting to the database
$db = connect();

#Selecting all the films from the database
$query="SELECT movies.id as movie_id,* FROM movies LEFT JOIN categories ON categories.id = movies.category_id";
$films = $db->query($query);


# ---- TEMPLATE START ----
?>
    <?php include('includes/header.php'); ?>
    <?php if($_GET['err'] == 1) { ?>
        <div id="error">Unable to perform the requested action</div>
    <?php } ?>
    <?php if($_GET['saved']) { ?>
        <div id="success">Movie successfully added</div>
    <?php } ?>
    <?php if($_GET['deleted']) { ?>
        <div id="success">Movie successfully deleted</div>
    <?php } ?>
    <table>
        <tr>
            <th class="movie_title">Title</th>
            <th class="movie_description">Description</th>
            <th class="movie_trailer">Category</th>
            <th class="movie_image">Image</th>
            <th class="movie_image"></th>
        </tr>
        <?php while($film = $films->fetchArray()) { ?>
        <tr class="movie_row">
            <td class="movie_title"><?php echo $film['title'] ?></td>
            <td class="movie_description"><?php echo $film['description'] ?></td>
            <td class="movie_trailer"><?php echo $film['name'] ?></td>
            <td class="movie_image"><?php echo $film['image'] ?></td>
            <td class="movie_delete"><a href="delete_movie.php?movie_id=<?php echo $film['id'] ?>">x</a></td>
        </tr>
        <?php } ?>
    </table>
    <a href="add_movie.php">Add new movie</a>
    <?php include('includes/footer.php'); ?>
<?php
# ---- TEMPLATE END ----
#Closing the database connection
disconnect($db);
?>