<?php 
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$news = simplexml_load_file('news.xml');
	$newsItem = $news->item;

	foreach ($newsItem as $key => $value) {
		if ($value['id'] == $id) {

			echo $value->title . '<br/>';
			echo "<i>$value->date</i>" . '<br/>';
			echo $value->description . '<br/>';
			
			break;
		}
	}
} else {
	header("location: home.php");
}
?>
