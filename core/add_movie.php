<?php
include ('includes/config.php');

$db = connect();
$categories = $db->query("SELECT * FROM categories");
?>
<style>
    form ul {
        width: 305px;
    }
    form li {
        list-style: none;
        padding-bottom: 20px;
    }
    form #submit_container {
        text-align: right;
    }
    form input[type=text] {
        width: 300px;
    }
    form select {
        width: 250px;
    }
    form textarea {
        width: 305px;
    }
</style>

<script type="text/javascript">

	$("#f_new_movie").submit(function(event) {
	    event.preventDefault();
		 var data=$(this).serialize();
		 $.post($(this).attr("action"),data,function(data,msg){
		   overlay.close();
		 },'json');
	});
	
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
                                alert('Unable to add new the category');
                                alert(data.msg);
                            }
                        }
	                });
	}
	
	function update_and_select_category(to_add_id, to_add_name) {
	    jQuery("#movie_category").append(jQuery('<option></option>').val(to_add_id).html(to_add_name))
	                             .val(to_add_id);
	}
	
</script>
	
	
<h2>New movie</h2>
<form action="db_add_movie.php" method="POST" id="f_new_movie">
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
            <label for="movie_category">Category</label><br>
            <select name="movie_category" id="movie_category">
                <option value=""></option>
                <?php
                while($category = $categories->fetchArray(SQLITE3_ASSOC)) {
                    echo "<option value='".$category['id']."'>".$category['name'].'</option>';
                }
                ?>
            </select>
            (<a href="#" onclick="add_category(); return false;">Add new</a>)
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
<?php
disconnect($db);
?>