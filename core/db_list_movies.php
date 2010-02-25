<?php
    include("./includes/config.php");
	
	$db=connect();
	
	$favourite=$_GET['favourite'];
	$category=$_GET['category'];
	
	if($category!=-1)
	 $query="SELECT movies.id as movie_id,* FROM movies LEFT JOIN categories ON categories.id = movies.category_id WHERE (category_id=".$category." AND favourite=".$favourite.")";
	else
	 $query="SELECT movies.id as movie_id,* FROM movies LEFT JOIN categories ON categories.id = movies.category_id WHERE favourite=".$favourite." ;";
	if($films=$db->query($query))
	{ ?>
	  <div class="movie_table">
        <!--table header-->
		<ul class="movie_thead">
          <li class="movie_thead_li">Title</li>
          <li class="movie_thead_li">Category</li>
          <li class="movie_thead_li">Trailer</li>
          <li class="movie_thead_li">Image</li>
		  <li class="movie_thead_del">Delete</li>
        </ul>
	 <?php
	  while( $film = $films->fetchArray(SQLITE3_ASSOC) )
	  { ?>
	  	<ul class="movie_drag" id="movie_<?php echo $film['movie_id']; ?>">
	  		<li style="display: none;" class="movie_id"><?php echo $film['movie_id'];?></li>
            <li class="movie_drag_li movie_title"><?php echo $film['title']; ?></li>
            <li class="movie_drag_li movie_category"><?php echo $film['name']; ?></li>
            <li class="movie_drag_li movie_trailer"><span rel="<?php echo $film['trailer_url']; ?>">View trailer</span></li>
            <li class="movie_drag_li movie_image" ref="<?php echo $film['image']; ?>"><span >View image</span></li>
            <li class="movie_drag_del" onclick="delete_movie(<?php echo $film['movie_id']; ?>)"></li>
        </ul>
	 <?php
	  }
	}
	else
	  echo "errore";
?>