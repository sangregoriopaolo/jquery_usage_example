<?php
include ('includes/config.php');

$db = connect();
$categories = $db->query("SELECT * FROM categories");
?>

<script type="text/javascript">
	$("#f_new_movie").submit(function(event) {
	    event.preventDefault();
		 var data=$(this).serialize();
		 $.post($(this).attr("action"),data,function(data,msg){
			if(data.status=='ok'){
				//$.reload();
				Overlay.close();
			}else
			Ajax_error(data.code+" : "+data.msg);
		 },'json');
	});
	
	    /* handle the user selections */
	    var ck_select = function(){
				$(".checklist").addClass("selected");
				$(".checklist").find(":checkbox").attr("checked", "checked");
			return false;
		};
	 
	    var ck_deselect = function(){
				$(".checklist").removeClass("selected");
				$(".checklist").find(":checkbox").removeAttr("checked");
				return false;
		};
	
	function add_category() {
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
                            if(data.status == 'ok') {
                                update_and_select_category(data.new_id, data.new_name);
                            }
                            else {
                            	Ajax_error('Unable to add new the category');
                            }
                        }
	                });
	}
	
	function update_and_select_category(to_add_id, to_add_name) {
	    jQuery("#movie_category").append(jQuery('<option></option>').val(to_add_id).html(to_add_name)).val(to_add_id);
	}
</script>

<style type="text/css">
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
		width: 100%;
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

</style>
	
	

<form id="f_new_movie" method="post" action="db_add_movie.php">
	<h2 class="title">New movie</h2>
	<div class="divisor"></div>
	<ul>
		<li class="leftSide">
			<label class="desc" for="movie_title">Title</label>
			<input class="fieldText" type="text" name="movie_title" id="movie_title" autocomplete="off"/>
		</li>
		<li class="rightSide">
			<label class="desc" for="movie_director">Director</label>
			<input class="fieldText" type="text" name="movie_director" id="movie_director" autocomplete="off"/>
		</li>
		<li class="leftSide">
			<label class="desc" for="movie_category">Category</label>
			<select name="movie_category" id="movie_category" class="fieldSelect">
                <?php
                while($category = $categories->fetchArray(SQLITE3_ASSOC)) {
                    echo "<option value='".$category['id']."'>".$category['name'].'</option>';
                }
                ?>
			</select>
			<a class="add" href="#" onclick="add_category(); return false;"></a>
		</li>
		<li class="rightSide">
			<label class="desc" for="movie_producer">Producer</label>
			<input type="text" class="fieldText" name="movie_producer" autocomplete="off"/>
		</li>
		<li class="leftSide">
			<div class="checklist">
				<input name="favourite" type="checkbox" />
					<label for="favourite">Is your favourite movie?</label>
	                <a class="checkbox-select" href="#" onclick="ck_select();">Select</a>
                    <a class="checkbox-deselect" href="#" onclick="ck_deselect();">Cancel</a>
			</div>
		</li>
		<li class="rightSide">
			<label class="desc" for="movie_description">Description</label>
			<textarea class="fieldArea" name="movie_description"></textarea>
		</li>
		<li class="leftSide">
			<label class="desc" for="movie_trailer_url">Trailer YouTube Code</label>
            <input class="fieldText" type="text" name="movie_trailer_url" autocomplete="off"/>
		</li>
		<li class="rightSide">
			<label class="desc" for="movie_image_url">Image URL</label>
            <input class="fieldText" type="text" name="movie_image_url" autocomplete="off"/>
		</li>
		<li class="l_sub">
			<input type="submit" value="Save" class="b_sub" />
		</li>
	</ul>
</form>

<?php
disconnect($db);
?>