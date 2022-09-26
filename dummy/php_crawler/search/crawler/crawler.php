<?php
/*-                                                                             
 * Copyright (c) 2005-2006 Vladimir Fedorkov (http://astellar.com/)
 * All rights reserved.                                                         
 *                                                                              
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR AND CONTRIBUTORS ``AS IS'' AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED.  IN NO EVENT SHALL THE AUTHOR OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS
 * OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
 * HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
 * OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF
 * SUCH DAMAGE.
 */

require_once('_config.php');
require_once('_db.php');
require_once('_crawler.php');

set_time_limit (0);

error_reporting  (E_ERROR | E_WARNING | E_PARSE);

$crawl_max_shown_depth = $CRAWL_MAX_DEPTH - 1;

print "PHP-Crawler started...<br>\n";
print "Log format: \"Crawling: [Current depth ({$crawl_max_shown_depth} MAX)] URL Action\"<br>\n";

if ($CRAWL_DB_DISABLE_KEYS) sql_query("/*!40000 ALTER TABLE `phpcrawler_links` DISABLE KEYS */;");

add_head_link(1, $CRAWL_ENTRY_POINT_URL);

mark_old_URLs_to_crawl();

$url_counter = 0;
$url_size = 0;

while($URL_info = get_URL_to_crawl())
{
    // Cooldown
	usleep ($CRAWL_THREAD_SLEEP_TIME);

	$url_counter++;

	$URL = $URL_info["url"];
	$site_URL = $CRAWL_ENTRY_POINT_URL;
	//$site_URL = $URL_info["site_url"];

	//$current_URL = preg_replace("/\/[^\/]+$/i", "", $URL_info["url"]);
	$current_URL = preg_replace("/([^\/])\/[^\/]+$/i", "\\1", $URL_info["url"]);
	//print(" base: " . $current_URL . " ");

	print "Crawling: [" . $URL_info["depth"] . "] {$URL}";

	$page = fetch_URL($URL);
	if ($page === false) 
	{
	    drop_url_from_db($URL_info["id"]);
		print " - FAILED/REMOVED.<br>\n";
		continue;
	}

	$page_size = strlen($page);
	$url_size += $page_size;
	print " " . ($page_size / 1000) . "Kb";

	$page_content = prepare_page($page);
    $page_content_md5 = md5($page_content);
	
	if($page_counter = check_equals($page_content_md5))
	{
	    unset_url_from_db($URL_info["id"]);
		print " - SKIPPED ({$page_counter} equals).<br>\n";
		continue;
	}


	$URLs_draft = get_URLS_from_page($page, $URL_info["depth"] + 1); //array
	$page_title = get_page_title($page);
	$URLs_clean = filter_URLs($URLs_draft, $site_URL, $current_URL); //$base_URL, $current_URL
	$URLs_to_crawl = add_URLs_to_crawl($URL_info["site_id"], $URLs_clean, $URL_info["depth"] + 1);

	print  " +" . $URLs_to_crawl . " urls.<br>\n";

	send_page_to_db($URL_info["id"], $page_title, $page_content, $page_content_md5);

}

if ($CRAWL_DB_DISABLE_KEYS)  sql_query("/*!40000 ALTER TABLE `phpcrawler_links` ENABLE KEYS */;");

print $url_counter . " pages crawled, " . ($url_size/1000) . "Kb processed.<br>\n";

?>