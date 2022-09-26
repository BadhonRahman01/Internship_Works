<<?php 

$website_to_crawl= "http://www.learningaboutelectronics.com";
$all_links= array();


function get_links($url)

{
global $all_links;
$contents= @file_get_contents($url);
$regexp= "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
preg_match_all("/$regexp/siU", $contents, $matches);
$path_of_url= parse_url($url, PHP_URL_HOST);

if (strpos($website_to_crawl, "https://") == true)
{
$type= "https://";
}
else
{
$type= "http://";
}


$links_in_array= $matches[2];

foreach ($links_in_array as $link)

{

if (strpos($link, "#") !== false)
{
$link= substr($link,0, strpos($link, "#"));
}

if (substr($link, 0, 1) == ".")
{
$link= substr($link,1);
}

if (substr($link, 0, 7) == "http://") {
$link= $link;
}

else if (substr($link, 0, 8) == "https://") {
$link= $link;
}

else if (substr($link, 0, 2) == "//") {
$link= substr($link,2);
}


 
else if (substr($link, 0, 1) == "#") {
$link= $url;
}
else if (substr($link, 0, 7) == "mailto:") {
$link= "[" . $link . "]";
}
else if (substr($link, 0, 1) != "/") {
	$link= "$type" .$path_of_url. "/" . $link;
}
else 
{
$link= "$type" .$path_of_url.$link;
}


if (!in_array($link,$all_links))
{
array_push($all_links, $link);
}



}//ends foreach 

}//ends function get_links

get_links($website_to_crawl);

foreach ($all_links as $currentlink)
{
get_links($currentlink);
}

foreach ($all_links as $currentlink)
{

get_links($currentlink);
}

foreach ($all_links as $currentlink)
{
if ((strpos($currentlink, "www.learningaboutelectronics.com") !== FALSE) && (strpos($currentlink, "http", 4) == FALSE))
{
echo $currentlink . "<br>";
$linkscount[] += $currentlink;
}
}

$count= count($linkscount);

echo "<br><br>There are $count links found by the crawler";

?>
