<?php
if(!$db = new SQLite3('../db/jquery_workshop.db')) {
    die('Unable to open the database');
}

if(!$db->exec("CREATE TABLE IF NOT EXISTS movies (id INTEGER PRIMARY KEY AUTOINCREMENT,
                                                      title varchar(100) NOT NULL,
                                                      description text NOT NULL,
                                                      trailer_url varchar(300) NOT NULL,
                                                      image varchar(300) NOT NULL)")) {
    throw new Exception( $db->lastErrorMsg() );
}

echo "Database succesfully initialized";
$db->close();
?>