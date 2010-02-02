<?php
function connect()
{
    if(!$db = new SQLite3('db/jquery_workshop.db')) {
        die('Unable to open the database');
    }
    return $db;
}

function disconnect($db)
{
    $db->close();
}
?>