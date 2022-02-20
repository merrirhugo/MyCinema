<?php

try {

    $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'mergo', '');

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e) {
    echo "Connection Failed : " . $e->getMessage();
}

?>