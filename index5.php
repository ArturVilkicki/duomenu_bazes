<?php
require ("../kint/build/kint.php"); 
session_start();
//paspaudem ant laukelio
if (!empty($_GET['field'])) {
    //paspaudem ant to pacio laukelio
    if (!empty($_SESSION['field']) && $_SESSION['field'] == $_GET['field']) {
        //pries tai buvo ASC
        if ($_SESSION['sort'] == 'ASC') {
            $_SESSION['sort'] = 'DESC';
        //pries tai buvo DESC
        } else {
            $_SESSION['sort'] = 'ASC';
        }
    //paspaudem ant laukelio pirma karta 
    //arba paspaudem ant kito laukelio 
    } else {
        $_SESSION['field'] = $_GET['field'];
        $_SESSION['sort'] = 'ASC';
    }
} 

$mysqli = new mysqli("localhost", "root", "", "book");
if (empty($_SESSION['field']) || empty($_SESSION['sort'])) {
    $sql = 'SELECT author, title, price, description, publish_date, `name` '
            . 'FROM books JOIN genres ON books.genre_id = genres.id';
} else {
    $sql = 'SELECT author, title, price, description, publish_date, `name` '
            . 'FROM books '
            . 'JOIN genres ON books.genre_id = genres.id '
            . 'ORDER BY ' . $_SESSION['field']." ".$_SESSION['sort'];
}
$res = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
<table>
    <thead>
        <tr>
            <th><a href="?field=author">Author</a></th>
            <th><a href="?field=name">Genre</a></th>
            <th><a href="?field=title">Title</a></th>
            <th><a href="?field=price">Price</a></th>
            <th><a href="?field=description">Description</a></th>
            <th><a href="?field=publish_date">Publish date</a></th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $res->fetch_array(MYSQLI_ASSOC)): ?>
        <tr>
            <td><?php echo $row["author"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["title"]; ?></td>
            <td><?php echo $row["price"]; ?></td>
            <td><?php echo $row["description"]; ?></td>
            <td><?php echo $row["publish_date"]; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>

