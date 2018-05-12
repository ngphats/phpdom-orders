<?php

$dom = new DOMDocument('1.0', 'utf-8');

$element = $dom->createElement('test');

$dom->appendChild($element);

$title = $dom->createElement('title','Hello world!');
$element->appendChild($title);

$body = $dom->createElement('body');
$element->appendChild($body);

$main = $dom->createElement('main');
$body->appendChild($main);

$artical = $dom->createElement('article','Article 1');
$main->appendChild($artical);

$nameAtt = $dom->createAttribute("id");
$nameAtt->value = "THRX82";
$artical->appendChild($nameAtt);

$content = $dom->createElement('content');
$body->appendChild($content);

$cdata = $dom->createCDATASection('cdata content');
$content->appendChild($cdata);

$article2 = $dom->createElement('article', 'Article 2');
$main->appendChild($article2);

$dom->save('test.xml');

echo 'done!';
