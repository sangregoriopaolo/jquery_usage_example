<?php
include('includes/config.php');

#Connecting to the database
$db = connect();

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
	
	
	<div class="center">
	<a href="add_movie.php">Add new movie</a>
	<form action="list_movies.php" method="get">
		<label for="cat">Select Category:</label>
		<select name="cat">
		<?php
		    //select cateogry from DB
			$query="SELECT * FROM categories";
			$ris=$db->query($query);
			echo "<option value='-1'>all</option>";
			echo "<option disabled='disabled'>-------------</option>";
			while($cat=$ris->fetchArray())
			{
			 if($cat['id']==$_GET['cat'])
				echo "<option value='".$cat['id']."' selected=selected>".$cat['name']."</option>";
			 else
				echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
			}
		?>
		</select>
		<label for="fav">Select Type:</label>
		<select name="fav">
		<?php
			if($_GET['fav']==0)
			{
			echo "<option value='0' selected='selected'>My Films</option>";
			echo "<option value='1'>Favourites</option>";
			}
			else
			{
			echo "<option value='0' >My Films</option>";
			echo "<option value='1' selected='selected'>Favourites</option>";
			}
		?>
		</select>
		<input type="submit" value="update" />
		<?php
		if($_GET['cat']!=-1)
			echo "<a href='delete_category.php?id=".$_GET['cat']."'>Delete this Category</a>";
		 ?>
	</form>
	
	</div>
	
	
	
	
    <table>
        <tr>
            <th class="movie_title">Title</th>
            <th class="movie_category">Category</th>
            <th class="movie_dettails">Dettails/Edit</th>
            <th class="movie_image">Image</th>
			<th class="movie_trailer">Trailer</th>
            <th class="movie_delete">Delete</th>
        </tr>
        <?php 
		#Selecting all the films from the database
		if(!isset($_GET['cat'])||$_GET['cat']==-1)
			$query="SELECT movies.id as movie_id,* FROM movies LEFT JOIN categories ON categories.id = movies.category_id WHERE favourite=".$_GET['fav'];
		else
			$query="SELECT movies.id as movie_id,* FROM movies LEFT JOIN categories ON categories.id = movies.category_id WHERE (category_id=".$_GET['cat']." AND favourite=".$_GET['fav']." )";
		$films = $db->query($query);
		
		while($film = $films->fetchArray()) { ?>
        <tr class="movie_row">
            <td class="movie_title"><?php echo $film['title'] ?></td>
            <td class="movie_category"><?php echo $film['name']; ?></td>
            <td class="movie_dettails"><a href='dettails.php?id=<?php echo $film['movie_id'] ?>'>Dettails/Edit</a></td>
            <td class="movie_image"><a href='image.php?url=<?php echo $film['image'] ?>'>View image</a></td>
			<td class="movie_trailer"><a href='trailer.php?url=<?php echo $film['trailer_url'] ?>'>View trailer</a></td>
            <td class="movie_delete"><a href="delete_movie.php?movie_id=<?php echo $film['movie_id'] ?>">x</a></td>
        </tr>
        <?php } ?>
    </table>
    <?php include('includes/footer.php'); ?>
<?php
# ---- TEMPLATE END ----
#Closing the database connection
disconnect($db);
?>