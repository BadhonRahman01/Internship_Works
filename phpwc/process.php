<?php

require 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;


$url = $_POST['url'];

$https = explode(":",$url);


$h =$https[0];





if($h == 'https'){
//echo "$com";
$domain = explode("//",$url);
$d = $domain[1];
echo $d;

$html = file_get_contents($url); 

$crawler = new Crawler($html);

$page_title = $crawler->filter('title')->text();
$p_tags = $crawler->filter('p')->count();
$page_heading = $crawler->filter('h1')->count();

//$com === 'com' || $com === 'org' || $com === 'co'

    echo '<br /><br />';
echo "Crawl URL:".$url;
    echo '<br /><br />';
echo "Domain Name:".$d;
echo '<br /><br />';
echo "Page Title:".$page_title;
echo '<br /><br />';
echo "Total p Tags:".$p_tags;
echo '<br /><br />';
echo "Total page heading:".$page_heading;
echo '<br /><br />';
}else{
    echo "Your 'url' is not valid";
}



 
?>