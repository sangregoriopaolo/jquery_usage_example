<?php
include('includes/config.php');
$db = connect();
$id = $_GET['movie_id'];
$films = $db->query("SELECT movies.id as movie_id,* FROM movies LEFT JOIN categories ON categories.id = movies.category_id WHERE movie_id = $id");
$film = $films->fetchArray(SQLITE3_ASSOC);

$trailer_url = "http://www.youtube.com/v/" . $film['trailer_url'];
?>

<style type="text/css">
    
    p {
        padding-top:5px;
        padding-bottom:5px;
    }
    
	#f_new_movie{
		width: 600px;
		position: relative;
		background: transparent;
		font-size: 125%;
	}

	.title{
		font-size: 160%;
		clear: left;
		margin: 0 0 5px 4px;
		font-weight: normal;
	}
	
	.divisor{
		width: 98%;
		border: 1px dotted #ccc;
		margin: 2px;
	}
	
	#f_new_movie ul{
		position: relative;
		width: 100%;
	}
	
	#f_new_movie ul .leftSide{
		float: left;
		clear: left;
		display: block;
		width: 46%;
		padding: 5px 2px 5px 2px;
	}
	
	#f_new_movie ul .rightSide{
		float: right;
		clear: none;
		display: block;
		width: 46%;
		padding: 5px 2px 5px 2px;
	}
	
	.desc{
		position: relative;
		display: block;
		font-weight: bold;
		font-size: 90%;
		color: #222;
		line-height: 150%;
		padding: 0 0 2px 4px;
	}
	
	.fieldText{
		width: 100%;
		position: relative;
		display: block;
		background: #a0dc4f;
		color: #fff;
		border: 0px;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		font-size: 100%;
		padding: 3px 2px 3px 4px;
		margin: 0 0 0 2px;
	}
	
	.fieldSelect{
		width: 88%;
		position: relative;
		display: block;
		background: #a0dc4f;
		color: #fff;
		border: 0px;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		font-size: 100%;
		padding: 3px 5px 3px 4px;
		margin: 0 0 0 2px;
		float: left;
	}
	
	.add{
		float:right;
		clear: none;
		display: block;
		width: 24px;
		height: 24px;
		background: url("./img/add.png") 0 0 no-repeat;
		margin-top: 2px;
	}
	
	.fieldArea{
		width: 100%;
		position: relative;
		display: block;
		background: #a0dc4f;
		color: #fff;
		border: 0px;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		font-size: 100%;
		padding: 3px 2px 3px 4px;
		margin: 0 0 0 2px;
		height: 9em;
	}
	
	.checklist {
	    /*float: left;
	    margin-right: 10px;*/
		margin: auto;
	    background: url(img/checkboxbg.gif) no-repeat 0 0;
	    width: 105px;
	    height: 150px;
	    position: relative;
	    font: normal 11px/1.3 "Lucida Grande","Lucida","Arial",Sans-serif;
	}
	
	.selected {
	background-position: -105px 0;
	}

	.selected .checkbox-select {
		display: none;
	}

	.checkbox-select {
		display: block;
		float: left;
		position: absolute;
		top: 118px;
		left: 10px;
		width: 85px;
		height: 23px;
		background: url(img/select.gif) no-repeat 0 0;
		text-indent: -9999px;
	}

	.checklist  input {
		display: none;
	}

	a.checkbox-deselect {
		display: none;
		color: white;
		font-weight: bold;
		text-decoration: none;
		position: absolute;
		top: 120px;
		right: 10px;
	}

	.selected a.checkbox-deselect {
		display: block;
	}

	.checklist label {
		display: block;
		text-align: center;
		padding: 8px;
	}
	
	#f_new_movie ul  .l_sub{
		width: 100%;
		display: block;
		clear: both;
		padding-top: 20px;
		margin: 2px;
	}
	
	.b_sub{
		margin:auto;
		display: block;
		width: 100px;
		height: 30px;
		border: 0px;
		background: #3fa2c6;
		color: #fff;
		font-weight: bold;
		line-height: 25px;
		font-size: 120%;
		-moz-border-radius: 8px;
		-webkit-border-radius: 8px;
		cursor: pointer;
	}
	
	#image_container {
	    text-align: center;
	}
	
	#description_container {
	    padding: 5px;
	    width:580px;
	    background: #DEDEDE;
	    border: 1px dashed;
	    margin-top: 10px;
	    margin-bottom: 10px;
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

</style>

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
     });
</script>

<h2 class="title"><?php echo $film['title'] ?></h2>
<div class="divisor"></div>
<div id="image_container">
    <img src="<?php echo $film['image']; ?>" height="200">
</div>
<h2 class="title">Trailer</h2>
<div class="divisor"></div>
<div class="trailer_container">
    <span id="trailer_off" class="toggle"><a href="#" class="toggle_link" onclick="toggle_trailer();">Show trailer</a></span>
    <span id="trailer_on" style="display:none">
        <div id="trailer_container"></div>
        <span class="toggle"><a href="#" class="toggle_link" onclick="toggle_trailer();">Hide trailer</a></span>
    </span>
</div>
<h2 class="title">Description</h2>
<div class="divisor"></div>
<div id="description_container">
    <p><strong>Director</strong>
    <?php echo $film['director']; ?></p>
    <p><strong>Producer</strong>
    <?php echo $film['producer']; ?></p>
    <?php echo $film['description']; ?>
</div>