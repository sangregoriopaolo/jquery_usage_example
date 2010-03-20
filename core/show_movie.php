<?php
include('includes/config.php');
$db = connect();
$id = $_GET['movie_id'];
$films = $db->query("SELECT movies.id as movie_id,* FROM movies LEFT JOIN categories ON categories.id = movies.category_id WHERE movie_id = $id");
$film = $films->fetchArray(SQLITE3_ASSOC);

$trailer_url = "http://www.youtube.com/v/" . $film['trailer_url'];
?>

<style type="text/css">
    
    #movie_desc p {
        padding: 5px;
        
        font-size: 120%;
        font-style: italic;
    }

	#movie_desc .title{
		font-size: 160%;
		clear: left;
		margin: auto;
		padding: 5px;
		font-weight: normal;
		text-align: center;
	}
	
	.divisor{
		width: 98%;
		border: 1px dotted #ccc;
		margin: 0px;
		margin-top: 7px;
		margin-bottom: 7px;
		clear: both;
	}

    .toggle .toggle_link,
    .toggle .toggle_link:hover,
    .toggle .toggle_link:visited {
        font-size:12px;
        color:#000000;
        text-decoration:none;
    }
    .toggle {
        text-align:center;
        padding-bottom:10px;
        padding-top:10px;
        display:block;
    }
    
    #movie_desc .edit{
    	background: transaperent;
    	width: 90%;
    }
	
	#movie_desc .description{
		padding: 5px;
		position: relative;
		vertical-align:super;
	}
	
	#movie_desc .image{
	 float: right;
	 position: relative;
	 display: block;
	 marign-left: 5px;
	 min-width: 200px;
	 height: 220px;
	
	}
	
	#movie_desc label{
		font-size: 90%;
		color: #c0c0c0;
		padding: 2px;
		display: block;
		widht: 100%;
		text-align: center;
	}
	
	#movie_desc .image_url{
		display: block;
		width: 98%;
		font-size: 100%;
		text-align: right;
		padding: 5px 0 5px 0;
	}
	
	#movie_desc .edit_url{
		cursor: pointer;
	}
	
	#movie_desc .new_cat{
	float: left;
	margin: 4px 5px 5px 5px;
	color: #333;
	font-size: 11px;
	font-weight: bold;
	line-height: 20px;
	display: block;
	width:100px;
	height: 21px;
	text-align: center;
	background: url("./img/new-category.png") 0 0 transparent;
	}

	#movie_desc .new_cat:hover{
	color: #fff;
	background: url("./img/new-category.png") 0 25px transparent;
	cursor: pointer;
	}
</style>

<script type="text/javascript" src="./js/jquery.jeditable.js"></script>
<script type="text/javascript">

    function toggle_trailer() {
        jQuery('#trailer_off').slideToggle();
        jQuery('#trailer_on').slideToggle();
        return false;
    }

    jQuery(document).ready(function() {
         swfobject.embedSWF("<?php echo $trailer_url; ?>",
             "trailer_container",
             "600",
             "385",
             "9.0.0",
             false,
             {},
             {wmode:"opaque"}
         );

         $(".edit_text").editable("db_update.php",{
			submit: "Ok",
			cancel: "Cancel",
			indicator: "Updating...",
			tooltip: "Click to edit",
			type: "text",
			cssclass: "edit",
			height: "35",
			id: "attr",
			submitdata: {id: $("#movie_id").attr("value")},
         });

         $(".edit_select").editable("db_category_select.php",{
			submit: "Ok",
			cancel: "Cancel",
			indicator: "Updating...",
			tooltip: "Click to edit",
			type: "select",
			cssclass: "edit",
			height: "35",
			id: "attr",
			submitdata: {id: $("#movie_id").attr("value")},
			loadurl: "db_category_select.php",
         });

         $(".edit_area").editable("db_update.php",{
 			submit: "Ok",
 			cancel: "Cancel",
 			indicator: "Updating...",
 			tooltip: "Click to edit",
 			type: "textarea",
 			cssclass: "edit",
 			height: "35",
 			id: "attr",
 			submitdata: {id: $("#movie_id").attr("value")},
 			rows: "10",
 			cols: "50",
          });

         $(".edit_url").click(function(){
			$(".image_url").slideToggle();
         });

     	$(".new_cat").click(function() {
    	    cat_name = window.prompt('Category name:', 'New category');
    	    if((cat_name == '') || (cat_name == null))
    	        return;

    	    data = {
    	        cat_name: cat_name
    	    };
    	    jQuery.ajax({
                            type: 'POST',
                            url: 'db_add_category.php',
                            data: data,
                            dataType: 'json',
                            success: function(data, text_status, XHR) {
                                if(data.status != 'ok') {
                                    Ajax_error('Unable to add new the category');   
                                }
                            }
    	                });
    	});
     });
</script>

<div id="movie_desc">
	
	<input type="hidden" id="movie_id" value="<?php echo $film['movie_id'];?>"></input>
	<p class="title edit_text" id="title"><?php echo $film['title'];?></p>
	
	<div class="divisor"></div>
	
	<span id="image" class="image_url edit_text" style="display: none;"><?php echo $film['image']?></span>
	<div class="image">
		<label class="edit_url" >Image (Click to show URL)</label>
		<img src="<?php echo $film['image']; ?>" height="200" >
	</div>

	<label>Description</label>
	<span class="description edit_area" id="description"><?php echo $film['description'];?></span> 
	
	<div class="divisor"></div>
	
	<p style="float: left;">Director: </p><p id="director" class="edit_text"><?php echo $film['director'];?></p>
	<p style="float: left;">Producer: </p><p id="producer" class="edit_text"><?php echo $film['producer'];?></p>
	<p style="float: left;">Category: </p><p id="category_id" class="edit_select"><?php echo $film['name']?></p>
	<span class="new_cat">New Category</span>
	
	<div class="divisor"></div>
	
	<div class="trailer_container">
    <span id="trailer_off" class="toggle"><a href="#" class="toggle_link" onclick="toggle_trailer();">Show trailer</a></span>
    <span id="trailer_on" style="display:none">
        <div id="trailer_container">
        	<h1>Get Adobe Flash Player</h1>
			<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
        </div>
        <span class="toggle"><a href="#" class="toggle_link" onclick="toggle_trailer();">Hide trailer</a></span>
    </span>
    <label style="font-size: 100%;">Trailer Code:</label><p style="color:#c0c0c0; text-align: center;" class="edit_text" id="trailer_url"><?php echo $film['trailer_url'];?></p>
    
</div>
	 
</div>