<?php
require ("../kint/build/kint.php");
$mysqli = new mysqli("localhost", "root", "", "book");
if(empty($_GET['field'])){
	$sql = 'SELECT book_id,author,title,genre,price,publish_date,description FROM book';
}else {
	$sql = 'SELECT book_id,author,title,genre,price,publish_date,description '
	. 'FROM book '
	. 'ORDER BY ' . $_GET['field'];
}

$res = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sortinimas,filtering</title>
</head>
<body>
	<table border="1">
		<tr>
			<th><a href="?field=book_id">Book id</a></th>
			<th><a href="?field=author">Author:</a></th>
			<th><a href="?field=title">Title:</a></th>
			<th><a href="?field=genre">Genre:</a></th>
			<th><a href="?field=price">Price:</a></th>
			<th><a href="?field=publish_date">Publish date:</a></th>
			<th><a href="?field=description">Description:</a></th>
		</tr>
		<?php while ($row = $res->fetch_array(MYSQLI_ASSOC)): ?>
		<tr>
			<td><?php echo $row["book_id"];?></td>
			<td><?php echo $row["author"];?></td>
			<td><?php echo $row["title"];?></td>
			<td><?php echo $row["genre"];?></td>
			<td><?php echo $row["price"];?></td>
			<td><?php echo $row["publish_date"];?></td>
			<td><?php echo $row["description"];?></td>
		</tr>
	<?php endwhile;?>
	</table>
	
</body>
</html>