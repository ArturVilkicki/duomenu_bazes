<?php
require ("../kint/build/kint.php");
$data = simplexml_load_file('catalog.xml'); 

$mysqli = new mysqli("localhost", "root", "", "book");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

foreach ($data->book as $item) {
	$mysqli->query("INSERT INTO book (book_id, author, title, genre, price, publish_date, description )"
            . "VALUES ('".(string)$item->attributes()->id."', "
            . "'".mysqli_real_escape_string($mysqli, (string)$item->author)."', "
            . "'".mysqli_real_escape_string($mysqli, (string)$item->title)."', "
            . "'".mysqli_real_escape_string($mysqli, (string)$item->genre)."', "
            . (float)$item->price.", "
            . "'".(string)$item->publish_date."',"
            . "'".mysqli_real_escape_string($mysqli, (string)$item->description)."') ");
	/*
	d("INSERT INTO book (book_id, author, title, genre, price, publish_date, description )"
            . "VALUES ('".(string)$item->attributes()->id."', "
            . "'".mysqli_real_escape_string($mysqli, (string)$item->author)."', "
            . "'".mysqli_real_escape_string($mysqli, (string)$item->title)."', "
            . "'".mysqli_real_escape_string($mysqli, (string)$item->genre)."', "
            . (float)$item->Price.", "
            . "'".(string)$item->publish_date."',"
            . "'".mysqli_real_escape_string($mysqli, (string)$item->description)."') ");
            */
}
$mysqli->close();

?>