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

if (empty($GLOBALS["www_has_crawl_config"])) {
// We both know about reqire_once(), I just keep old style.
$GLOBALS["www_has_crawl_config"] = 1;
  
// *** MySQL database config. Please change these lines according your host
$mysql_host   = "localhost";
$mysql_db     = "changeme";
$mysql_user   = "changeme";
$mysql_pass   = "changeme";

$CRAWL_ENTRY_POINT_URL = "http://changeme";	// website to crawl MUST begins with http:// prefix

$CRAWL_LOCALE = "en_US"; // read more about Locate http://php.rinet.ru/manual/en/function.setlocale.php
//$CRAWL_LOCALE = "ru_RU"; 

$CRAWL_MAX_DEPTH = 2;			// PHP Crawler uses recursive retrieving. Specify recursion maximum depth level.
$CRAWL_PAGE_EXPIRE_DAYS = 10;	// Page reindex period

// **** MISC SETTINGS ****

// disable keys while crawling (might save some time)
$CRAWL_DB_DISABLE_KEYS = false;

// skip crawing long URLs
$CRAWL_URL_MAX_LEN = 1024;

// index only fist CONFIG_URL_MAX_CONTENT bytes of page content
$CRAWL_URL_MAX_CONTENT = 150 * 1024;

// HACK. cooldown time after http request.
$CRAWL_THREAD_SLEEP_TIME = 100000; //mk_sec

// **** SEARCH CONFIG ****

$CRAWL_SEARCH_TEXT_SURROUNDING_LENGHT = 70; //chars
$CRAWL_SEARCH_MAX_RES_WORD_COUNT = 2; // larger value produces larger search page

// *** INIT ****
setlocale (LC_ALL, $CRAWL_LOCALE);

}

?>
