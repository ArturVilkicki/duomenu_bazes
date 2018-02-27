<?php
require ("../kint/build/kint.php");
$data = simplexml_load_file('catalog.xml'); 

$mysqli = new mysqli("localhost", "root", "", "book");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$egzistingGenres = [];
foreach ($data->book as $item) {
    if (!array_key_exists((string)$item->genre, $egzistingGenres)) {
        $mysqli->query("INSERT INTO genres (`name`) VALUES ('".(string)$item->genre."')" );
        $egzistingGenres[(string)$item->genre] = $mysqli->insert_id;
    }
    
    $mysqli->query("INSERT INTO books (book_id, genre_id, author, title, price, description, publish_date)"
            . "VALUES ('".(string)$item->attributes()->id."', "
            . $egzistingGenres[(string)$item->genre].", "
            . "'".mysqli_real_escape_string($mysqli, (string)$item->author)."', "
            . "'".mysqli_real_escape_string($mysqli, (string)$item->title)."', "
            . (float)$item->price.", "
            . "'".mysqli_real_escape_string($mysqli, (string)$item->description)."', "
            . "'".(string)$item->publish_date."')");
}

$mysqli->close();
?>