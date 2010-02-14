<?php
include('includes/config.php');
$db = connect();
$id = $_GET['movie_id'];
if($db->exec("DELETE FROM movies WHERE id = $id"))
{
    $response['status'] = 'ok';
}
else
{
    $response['status'] = 'error';
	$response['code'] = $db->lastErrorCode();
	$response['msg'] = $db->lastErrorMsg();
}
disconnect($db);
echo json_encode($response);
?>