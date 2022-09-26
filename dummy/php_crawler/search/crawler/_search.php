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

if(empty($GLOBALS["www_has_phpcrawler"]))
{
// ***** SREARCH ******

$GLOBALS["www_has_phpcrawler"] = 1;

function search_format_content($content, $q)
{
	global	$CRAWL_SEARCH_TEXT_SURROUNDING_LENGHT, 
			$CRAWL_SEARCH_MAX_RES_WORD_COUNT;


	$CRAWL_SEARCH_STRICT_RESULTS = false;

    // we shall use smaller alias ;-)
	$SL = $CRAWL_SEARCH_TEXT_SURROUNDING_LENGHT;

	if (empty($SL)) die("Empty CRAWL_SEARCH_TEXT_SURROUNDING_LENGHT");

   	// remove some spaces from content
   	$content = preg_replace("/(&nbsp;)+/i", " ", $content);
   	$content = preg_replace("/\s[\s]+/ims", " ", $content);


	// === Creating chunks
	$chunks = array();
	$chunk_counter = 0;
	$words = preg_split ("/\s+/i", $q);
	foreach ($words as $dummy_id => $word)
	{
	     if (empty($word)) continue;
		 if (strlen($word) < 3) continue;
		 $word_counter = 0;
		 if ($CRAWL_SEARCH_STRICT_RESULTS)
		 {
		     /* Uncomment this to speed-up search
			     $found = preg_match_all("/\s+" . $word . "\s+(.{0," . $SL . "})/ims", $content, $matches, PREG_SET_ORDER);
             */
		     $found = preg_match_all("/(.{0," . $SL . "})\s+" . $word . "\s+(.{0," . $SL . "})/ims", $content, $matches, PREG_SET_ORDER);
		 } else {
             /* Uncomment this to speed-up search
			     $found = preg_match_all("/" . $word . "(.{0," . $SL . "})/ims", $content, $matches, PREG_SET_ORDER);
             */
		     $found = preg_match_all("/(.{0," . $SL . "})" . $word . "(.{0," . $SL . "})/ims", $content, $matches, PREG_SET_ORDER);
		 }
         if ($found == 0 || $found === false) continue;
	     foreach($matches as $dummy => $match)
	     {
	        $chunks[$chunk_counter] = $match[0];
	     	$chunk_counter++;
			$word_counter++;
			if ($word_counter >= $CRAWL_SEARCH_MAX_RES_WORD_COUNT) break;
	     }
	}

    // if no matches found
	if (count($chunks) == 0) 
	{	
		return substr($content, 0, $CONFIG_TEXT_SURROUNDING_LENGHT * 2);
	}

	// setting up positions
    $postitions = array();
    $chunk_counter = 0;
	foreach ($chunks as $dummy_id => $chunk)
	{
	     if (empty($word)) continue;
		 $chunk_pos = strpos($content, $chunk);
		 //$chunk_pos = strpos($content, $word, 0);
         //$word_pos = preg_match("/{$word}/ims", $content, $matches);	
		 if ($chunk_pos === false) continue;
		 $positions[$chunk] = $chunk_pos; 
	}
	asort($positions, SORT_NUMERIC);

    //computing text marks
    $marks = array();
    $chunk_counter = 0;
    $last_chunk_end = 0;
    $content_len = strlen($content);
    foreach($positions as $chunk => $text_pos)
    {

        $chunk_len = strlen($chunk);
        if ($chunk_len < 3) continue;
        if ($text_pos === false) continue;

        // *** check chunks overlapping
        if(($text_pos) < $last_chunk_end) 
		{
			$marks[$chunk_counter]["end"] = (($text_pos + $chunk_len) > $content_len) ? $content_len : $text_pos + $chunk_len;
		} else {
			$marks[$chunk_counter]["from"] = (($text_pos) < 0) ? 0 : $text_pos;
			$marks[$chunk_counter]["end"] = (($text_pos + $chunk_len) > $content_len) ? $content_len : $text_pos + $chunk_len;
			$chunk_counter++;
		}

    }   

    // *** making content
    $shown_result = "";
    foreach($marks as $chuck_id => $mark)
    {
    	//var_dump($mark); die("stop");
    	$text_chunk  = substr ( $content, $mark["from"], $mark["end"] - $mark["from"]);
    	$text_chunk  = preg_replace("/^[^\s]*\s/i", "", $text_chunk);
    	$text_chunk  = preg_replace("/\s[\S]*$/is", "", $text_chunk);
    	$shown_result .= "..." . $text_chunk . "...  ";
    }

	foreach ($words as $dummy_id => $word)
	{
	    if (strlen($word) < 3) continue;
		if ($CRAWL_SEARCH_STRICT_RESULTS)
		{
	        $shown_result = preg_replace ("/\s+{$word}\s+/ims", "<b>\\0</b>", $shown_result);
		} else {
	        $shown_result = preg_replace ("/{$word}/ims", "<b>\\0</b>", $shown_result);
		}
	}
	return $shown_result;
    
}

// *** INIT SQL ***
$sql_content_q = "
SELECT 
	*  
FROM 
	phpcrawler_links l 
WHERE 
	MATCH (l.content) AGAINST (%s) 
GROUP BY l.id 
LIMIT %d, %d";

$sql_content_q_count = "
SELECT 
	count(distinct l.id) as cnt 
FROM 
	phpcrawler_links l 
WHERE 
	MATCH (l.content) AGAINST (%s)";

}

sql_open();

?>