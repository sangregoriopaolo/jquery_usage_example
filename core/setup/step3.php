<?php
if(!$db = new SQLite3('../db/jquery_workshop.db')) {
    die('Unable to open the database');
}

if(!$db->exec("ALTER TABLE movies ADD COLUMN director varchar(100)")){
    throw new Exception( $db->lastErrorMsg() );	
}

if(!$db->exec("ALTER TABLE movies ADD COLUMN producer varchar(100)")){
    throw new Exception( $db->lastErrorMsg() );	
}

echo "Database succesfully updated";
$db->close();
?>