// Database Structure 
CREATE TABLE 'webpage_details' (
 'link' text NOT NULL,
 'title' text NOT NULL,
 'description' text NOT NULL,
 'internal_link' text NOT NULL,
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1

<?php
 $main_url="http://samplesite.com";
 $str = file_get_contents($main_url);
 
 // Gets Webpage Title
 if(strlen($str)>0)
 {
  $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
  preg_match("/\<title\>(.*)\<\/title\>/i" ,$str ,$title); // ignore case
  $title=$title[1];
 }
	
 // Gets Webpage Description
 $b =$main_url;
 @$url = parse_url( $b );
 @$tags = get_meta_tags($url['scheme'].'://'.$url['host'] );
 $description=$tags['description'];
	
 // Gets Webpage Internal Links
 $doc = new DOMDocument; 
 @$doc->loadHTML($str); 
 
 $items = $doc->getElementsByTagName('a'); 
 foreach($items as $value) 
 { 
  $attrs = $value->attributes; 
  $sec_url[]=$attrs->getNamedItem('href')->nodeValue;
 }
 $all_links=implode(",",$sec_url);
 
 // Store Data In Database
 $host="localhost";
 $username="root";
 $password="";
 $databasename="sample";
 $connect=mysql_connect($host,$username,$password);
 $db=mysql_select_db($databasename);

 mysql_query("insert into webpage_details values('$main_url','$title','$description','$all_links')");

?>