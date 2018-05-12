<?php 
header( 'content-type: text/html; charset=utf-8' );
$connect = mysqli_connect("localhost","root","mysql","hdcomputer.dev") or die("Connection error");
mysqli_query($connect, "SET NAMES 'utf8'");

$sql = "SELECT * FROM `tbl_post` WHERE post_type = 'article'";
$query = mysqli_query($connect,$sql);

while ($row = mysqli_fetch_assoc($query)) :

	// new Dom
	$dom = new DOMDocument('1.0','utf-8');
	$article = $dom->createElement('article');
	$dom->appendChild($article);

	// id
	$id = $dom->createAttribute('id');
	$id->value = $row['id'];
	$article->appendChild($id);

	// title
	$title = $dom->createElement('title');
	$article->appendChild($title);
	$titleName = $dom->createCDATASection($row['name']);
	$title->appendChild($titleName);

	// description
	$description = $dom->createElement('description');
	$article->appendChild($description);
	$descriptionContain = $dom->createCDATASection($row['description']); 
	$description->appendChild($descriptionContain);

	// image
	$image = $dom->createElement('image',$row['image']);
	$article->appendChild($image);

	// date created
	$date = $dom->createElement('date',$row['date_added']);	
	$article->appendChild($date);

	$xmlName = "post-".$row['id'].".xml";

	$dom->save("posts/$xmlName");

endwhile;

echo 'created!';
