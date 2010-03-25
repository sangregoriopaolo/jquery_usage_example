<?php
include('./includes/config.php');

 $db=connect();
 
 $id=$_GET['id'];
 
 if(!isset($id))
 {
 $id=$_POST['id'];
 
    $title = $db->escapeString($_POST['movie_title']);
    $description = $db->escapeString($_POST['movie_description']);
    $trailer_url = $db->escapeString($_POST['movie_trailer_url']);
    $image_url = $db->escapeString($_POST['movie_image_url']);
	$director = $db->escapeString($_POST['director']);
	$producer = $db->escapeString($_POST['producer']);
	$cat = $db->escapeString($_POST['category']);
	
	if($_POST['fav']=='on')
	 $fav=1;
	else
	 $fav=0;
 //save update
 $query="UPDATE movies SET title='$title', description='$description', trailer_url='$trailer_url', image='$image',director='$director',producer='$producer',category_id='$cat',favourite='$fav' WHERE id=".$id;
 $db->query($query);
 
  header('Location: list_movies.php?cat=-1&fav=0');
 }
 
 //edit form
 $query="SELECT * FROM movies WHERE id='".$id."'";
 $ris=$db->query($query);

 include("./includes/header.php");
 
 $film=$ris->fetchArray();
 
 ?>
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
    <h2>Edit movie</h2>
  <form action="dettails.php" method="POST">
        <ul>
            <li>
			    <input type="hidden" name="id" value="<?php echo $film['id']; ?>" />
                <label for="movie_title">Title</label><br>
                <input type="text" name="movie_title" value="<?php echo $film['title'];?>"/>
            </li>
	        <li>
                <label for="director">Director</label><br>
                <input type="text" name="director" value="<?php echo $film['director'];?>"/>
            </li>
	        <li>
                <label for="producer">Producer</label><br>
                <input type="text" name="producer" value="<?php echo $film['producer'];?>"/>
            </li>
            <li>
                <label for="movie_description">Description</label><br>
                <textarea name="movie_description" rows="10"><?php echo $film['description'];?></textarea>
            </li>
			<li>
                <label for="category">Category</label><br>
                <select name="category" >
					<?php 
					$query="SELECT * FROM categories";
					$ris=$db->query($query);
					while($cat=$ris->fetchArray())
					{
					 if($cat['id']==$film['category_id'])
					  echo "<option value='".$cat['id']."' selected='selected'>".$cat['name']."</option>";
					 else
					  echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
					}
					?>
				</select>
				<!--<a href="add_category.php?page=dettails.php?id=<?php echo $id?>">Add Category</a>-->
            </li>
			<li>
			  <label for='fav'>Favourite</label>
			  <?php
			  if($film['favourite']==1)
				echo '<input type="checkbox" name="fav" checked="checked"/>Favourite?';
			  else
				echo '<input type="checkbox" name="fav" />Favourite?';
			  ?>
			</li>
            <li>
                <label for="movie_trailer_url">Trailer URL</label><br>
                <input type="text" name="movie_trailer_url" value="<?php echo $film['trailer_url'];?>"/>
            </li>
            <li>
                <label for="movie_image_url">Image URL</label><br>
                <input type="text" name="movie_image_url" value="<?php echo $film['image'];?>"/>
            </li>
            <li id="submit_container">
                <input type="submit" name="action" value="Save" />
            </li>
        </ul>
    </form>

<?php 
include('./includes/footer.php');	
 
 disconnect($db);
?>