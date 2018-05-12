<?php 
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$xmlFile = "post-".$id.".xml";
	if (!file_exists("posts/$xmlFile")) {
		header("location:home.php");
	}
	$news = simplexml_load_file("posts/".$xmlFile);

	echo $news->title . '<br/>';
	echo "<i>$news->date</i>" . '<br/>';
	echo $news->description . '<br/>';

} else {
	header("location: home.php");
}
?>
