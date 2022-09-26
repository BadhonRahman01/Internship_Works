<?php

// *** SQL WRAPPER - MYSQL ***
if (empty($GLOBALS["www_has_db"]))
{

$GLOBALS["www_has_db"] = 1;


function sql_escape($arg)
{
	return addslashes($arg);
}

function sql_open()
{
	global $mysql_host, $mysql_db, $mysql_user, $mysql_pass,
		$M_SYS_SQL_SERVER, $M_SYS_SQL_DB, $M_SYS_REASON;
		
	if (!@mysql_connect($mysql_host, $mysql_user, $mysql_pass)) {
		$msg = mysql_error();
		die("Cannot connect to database server (Reason: $msg)");
	}
	if (!@mysql_select_db($mysql_db)) {
		$msg = mysql_error();
		die("Cannot select db (Reason: $msg)");
	}
	return true;
}

function sql_exec_va($args)
{
	global $sql_query;

	$query = $args[0];
	$i = 1;
	$n = count($args);

	$a = explode("%", $query);
	$r = "";
	if (!empty($a)) foreach ($a as $p) {
		$c = $p[0];
		if ($c != "s" && $c != "u" && $c != "d" && $c != "f") {
			$r .= "%";
			if ($c == "P") $p = substr($p, 1);
			$r .= $p;
			continue;
		}
		if ($i >= $n) die("FATAL: not enough arguments to SQL query ($query_code: $query)");
		$arg = $args[$i++];
		switch ($c) {
			case "s": $r .= "'" . sql_escape($arg) . "'"; break;
			case "u": $r .= $arg; break;
			case "d": $r .= (int)$arg; break;
			case "f": $r .= (float)$arg; break;
		}
		$r .= substr($p, 1);
	}
	$query = substr($r, 1);

	$sql_query = $query;
	return @mysql_query($query);
}

function sql_query_va($args)
{
	global $sql_query;

	if (!($r = sql_exec_va($args))) {
		$msg = mysql_error();
		die("Query failed (query: $sql_query, reason: $msg)");
	}
	return $r;
}

function sql_query($query)
{
	$args = func_get_args();
	return sql_query_va($args);
}

function sql_exec($query)
{
	$args = func_get_args();
	return sql_exec_va($args);
}

function sql_row($result)
{
	return mysql_fetch_row($result);
}


function sql_rows($result)
{
	return mysql_num_rows($result);
}

function sql_fetch($query)
{
	$args = func_get_args();
	$r = sql_query_va($args);
	$a = sql_row($r);
	return $a[0];
}

function sql_row_hash($result)
{
	return mysql_fetch_array($result);
}

function sql_fetch_hash($query)
{
	$args = func_get_args();
	$r = sql_query_va($args);
	return sql_row_hash($r);
}

function sql_insert($query)
{
	$args = func_get_args();
	sql_query_va($args);
	return sql_insert_id();
}

function sql_insert_id()
{
	return mysql_insert_id();
}

function sql_free($r)
{
	return mysql_free_result($r);
}
}

?>