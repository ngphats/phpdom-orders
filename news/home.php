<!DOCTYPE html>
<html>
<head>
	<title>HD Computer</title>
	<style type="text/css">
		article {
			border: 1px solid #ddd;
			padding: 10px;
			margin: 5px
		}
	</style>
</head>
<body>

	<?php $news = simplexml_load_file('news.xml'); ?>
	<?php $newsItems = $news->item; ?>
	<section>
		<?php foreach($newsItems as $item) : ?>
			<article>
				<header>
					<h2><?= $item->title ?></h2>
					<i><?= date('d/m/Y',strtotime($item->date)) ?></i>
				</header>
				
				<main>
					<p><?= $item->description ?></p>
					<p><a href="read.php?id=<?= $item['id'] ?>">Detail</a></p>
				</main>
			</article>				
		<?php endforeach ?>
	</section>
</body>
</html>