
<?php
include('includes/config.php');

#Connecting to the database
$db = connect();

#Selecting all the films from the database
$films = $db->query('SELECT movies.id as movie_id, * FROM movies LEFT JOIN categories ON categories.id = movies.category_id');

# ---- TEMPLATE START ----
?>
    <?php include('includes/header.php'); ?>
		<link rel="stylesheet" href="css/overlay-apple.css" type="text/css" media="screen">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/jquery-tools.js"></script>
		<script type="text/javascript" src="js/list_movies.js"></script>

    <?php if($_GET['err'] == 1) { ?>
        <div id="error">Unable to perform the requested action</div>
    <?php } ?>
    <?php if($_GET['saved']) { ?>
        <div id="success">Movie successfully added</div>
    <?php } ?>
    <?php if($_GET['deleted']) { ?>
        <div id="success">Movie successfully deleted</div>
    <?php } ?>
	
	<!--cestino per il trscinamento dei film-->
		<div class="trash">
		  <span>trascina qui i film che vuoi acquistare</span>
		  <span>Film acquistati:</span><span class="count">0</span>
		</div>
	
	<!--tabella principale-->	
    <div class="movie_table">
        <ul class="movie_thead">
            <li class="movie_title">Title</li>
            <li class="movie_description">Description</li>
            <li class="movie_category">Category</li>
            <li class="movie_trailer">Trailer</li>
            <li class="movie_image">Image</li>
        </ul>
        <?php while($film = $films->fetchArray(SQLITE3_ASSOC)) { ?>
        <ul class="movie_drag">
            <li class="movie_title"><?php echo $film['title'] ?></li>
            <li class="movie_description"><?php echo $film['description'] ?></li>
            <li class="movie_category"><?php echo $film['name'] ?></li>
            <li class="movie_trailer"><?php echo $film['trailer_url'] ?></li>
            <li class="movie_image"><?php echo $film['image'] ?></li>
            <li class="movie_del"><a href="delete_movie.php?movie_id=<?php echo $film['movie_id'] ?>">x</a></li>
        </ul>
        <?php } ?>
    </div>
    <a id="new_movie" href="add_movie.php" rel="#overlay">Add new movie</a>
	
	<!-- overlayed element --> 
    <div class="apple_overlay" id="overlay"> 
 
      <!-- the external content is loaded inside this tag --> 
      <div class="contentWrap"></div> 
 
    </div>
	
	<!--error ajax overlay -->
	<div id="ajax_error">
		<div>
			<h2>Errore</h2>
			<p id="errror_desc">errrore imprevisto</p>
			<button class="close">Chiudi</button>
		</div>
  </div>
   
	<!--ajax loading image-->
	<img src='./img/ajax-loader.gif' class="ajax-loader" />
	
    <?php include('includes/footer.php'); ?>
<?php
# ---- TEMPLATE END ----
#Closing the database connection
disconnect($db);
?>