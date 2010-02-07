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

        form textarea {
            width: 305px;
        }
    </style>
		
		<script type="text/javascript">
		  
			$("#f_new_movie").submit(function(event){
			   event.preventDefault();
				 var data=$(this).serialize();
				 $.post($(this).attr("action"),data,function(data,msg){
				   overlay.close();
				 },'json');
			});
			
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