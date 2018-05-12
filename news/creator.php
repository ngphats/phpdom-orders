<?php 
header( 'content-type: text/html; charset=utf-8' );
$connect = mysqli_connect("localhost","root","mysql","hdcomputer.dev") or die("Connection error");
mysqli_query($connect, "SET NAMES 'utf8'");

$sql = "SELECT * FROM `tbl_post` WHERE post_type = 'article'";
$query = mysqli_query($connect,$sql);


// new Dom
$dom = new DOMDocument('1.0','utf-8');
$news = $dom->createElement('news');
$dom->appendChild($news);

while ($row = mysqli_fetch_assoc($query)) :
	$item = $dom->createElement('item');
	$news->appendChild($item);

	// id
	$id = $dom->createAttribute('id');
	$id->value = $row['id'];
	$item->appendChild($id);

	// title
	$title = $dom->createElement('title');
	$item->appendChild($title);
	$titleName = $dom->createCDATASection($row['name']);
	$title->appendChild($titleName);

	// description
	$description = $dom->createElement('description');
	$item->appendChild($description);
	$descriptionContain = $dom->createCDATASection($row['description']); 
	$description->appendChild($descriptionContain);

	// image
	$image = $dom->createElement('image',$row['image']);
	$item->appendChild($image);

	// date created
	$date = $dom->createElement('date',$row['date_added']);	
	$item->appendChild($date);
endwhile;

$dom->save('news.xml');
echo 'created!';
