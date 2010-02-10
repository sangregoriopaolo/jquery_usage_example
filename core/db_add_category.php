<?php
include('includes/config.php');
$db = connect();
$cat_name = $db->escapeString($_POST['cat_name']);

if($db->exec("INSERT INTO categories (name) VALUES ('$cat_name')")) {
    $response['status'] = 'ok';
    $response['new_id'] = $db->lastInsertRowID();
    $response['new_name'] = $cat_name;
}
else
{
    $response['status'] = 'error';
	$response['code'] = $db->lastErrorCode();
	$response['msg'] = $db->lastErrorMsg();
}
echo json_encode($response);
disconnect($db);
?>