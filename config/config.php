<?php
$config = array(
    "full_name" => 'Kostvetaren',
    "database_connection" => new PDO("mysql:host=localhost;dbname=kostvetaren", "root", "", array(
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    )),
    
);
?>