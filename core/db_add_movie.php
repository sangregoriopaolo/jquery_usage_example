<?php
    include ('includes/config.php');
    $db = connect();

    $title = $db->escapeString($_POST['movie_title']);
    $description = $db->escapeString($_POST['movie_description']);
    $trailer_url = $db->escapeString($_POST['movie_trailer_url']);
    $image_url = $db->escapeString($_POST['movie_image_url']);
    $category_id = (isset($_POST['movie_category']) ? $db->escapeString($_POST['movie_category']) : 'NULL');
	$director=$db->escapeString($_POST['movie_director']);
	$producer=$db->escapeString($_POST['movie_producer']);
	$favourite=$db->escapeString($_POST['favourite']);
	
	if($favourite=='on')
	 $favourite=1;
	else
	 $favourite=0;
	
	if($db->exec("INSERT INTO movies (title, description, trailer_url, image, category_id, director, producer, favourite) VALUES ('$title', '$description', '$trailer_url', '$image_url', '$category_id','$director','$producer','$favourite')"))
	{
        $status['status'] = 'ok';
	}
	else
	{
        $status['status'] = 'error';
        $status['code'] = $db->lastErrorCode();
        $status['msg'] = $db->lastErrorMsg();
	}
    echo json_encode($status);
    disconnect($db);
?>