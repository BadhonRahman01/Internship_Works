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

 $q = $_GET["q"];

?>

<!--this is real html, trust me-->
<html><head><title>Search</title>
<script>
<!--
function setfocus(){document.s.q.focus();}
// -->
</script>
<style type="text/css">
<!--
.text {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px}
.text_small {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px}
.text_large_white {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color: #FFFFFF; font-weight: bold}
-->
</style>
</head>

<body text="#000000" bgcolor="#FFFFFF" OnLoad="setfocus()">
 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <form name="s" method="get" action="search.php">
  <tr>
      <td bgcolor="#0075E8" height="60" valign="middle" align="center"> 
        <table border="0" cellspacing="10" cellpadding="0">
          <tr valign="middle"> 
            <td align="center" class="text_large_white">Search</td>
            <td> 
              <input type="text" name="q" class="text" value="<?=$q;?>">
          </td>
            <td align="right"> 
              <input type="submit" name="Submit" value="Go!" class="text">
          </td>
        </tr>
      </table>
    </td>
  </tr>
  </form>
  <!-- /header -->
  <tr  valign="top"> 
    <td align="center" valign="top"> 
      <table width="100%" border="0" cellspacing="10" cellpadding="0">

<?php
/*
require_once($_SERVER["DOCUMENT_ROOT"] . "/crawler/_config.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/crawler/_db.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/crawler/_search.php");
*/

require_once("./crawler/_config.php");
require_once("./crawler/_db.php");
require_once("./crawler/_search.php");

/*
 === USED VARIABLES:
 $p = current page
 $rpp = rows per page
 $q = search query

*/


$p = (int)$p;
$rpp = 20;

$records = false;
$r = false;

function draw_pager($records, $p, $rpp, $q)
{
	// ==== PAGER ====
	$total = ceil($records/$rpp);
	print "<hr>\n";

	if ($records == 0) return false;
	print "pages: |\n";
	
	$pager = $page;
	if (($p - 1) >= 0) { $p_prev = $p - 1; ?> <a href="search.php?q=<?=$q;?>&p=<?=$p_prev;?>" class="text">&lt;&lt; prev</a> | <?php }
	
	for($i = 0; $i < $total; $i++) 
	{
		$p_show = $i + 1;
		if ($i == $p) {
			?><span class="text"><b><?=$p_show;?></b></span> | <?php
		} else {
		    ?><a href="search.php?q=<?=$q;?>&p=<?=$i;?>" class="text"><?=$p_show;?></a> | <?php
		}
	}
	
	if (($p + 1) < $total) { $p_next = $p + 1; ?> <a href="search.php?q=<?=$q;?>&p=<?=$p_next;?>" class="text">&gt;&gt; next</a> | <?php }
	
	// **** /PAGER **** 
	
}

// content search
if ($q_plus == 1) $q = urldecode($q);
$records = sql_fetch($sql_content_q_count, $q);
$r = sql_query($sql_content_q, $q, $p * $rpp, $rpp);
$q_encoded = urlencode($q);


?><!-- **** PAGER 1 ***** -->
<tr><td align="left" class="text" valign="top"><?php draw_pager($records, $p, $rpp, $q_encoded); ?></td></tr>
<?php

if ($records  > 0) // sql_rows($r)
while ($a = sql_row_hash($r))
{
	if (!empty($a["content"])) 
	{
	    $a["fmt_result"] = search_format_content($a["content"], $q);
	    if (empty($a["url_title"])) $a["url_title"] = $a["url"];

?><!-- SEARCH RESULTS -->
<tr> 
  <td class="text" align="left" bgcolor="#FFFFFF"><b>&#149; <a href="<?=$a["url"];?>" class="tx_blue"><?=$a["url_title"];?></a></b> &#151; <?=$a["fmt_result"];?></td>
</tr>
<!-- //SEARCH RESULTS --><?php

	}
} else {
?><!-- NOTHING FOUND -->
<tr> 
  <td class="text" align="center"><b>Nothing found</b></td>
</tr>
<!-- //NOTHING FOUND --><?php
}

?><!-- **** PAGER 2 ***** -->
<tr><td align="left" class="text" valign="top"><?php draw_pager($records, $p, $rpp, $q_encoded); ?></td></tr>

<tr> 
<td align="right" class="text_small" valign="top">Powered by <a href="http://astellar.com/opensource/php-crawler/" target="_blank">PHP Crawler</a></td>
</tr>
</table>
<!-- footer -->
</td>
</tr>
<tr><td align="center">&nbsp;</td></tr>
</table>
</body>
</html>