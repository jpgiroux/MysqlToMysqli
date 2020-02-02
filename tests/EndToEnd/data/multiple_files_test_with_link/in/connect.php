<?php

/*****************************************************
 * Test file containing a single connection and some info functions
 ****************************************************/

$link = mysql_connect('aserver', 'auser', 'apass');

if(mysql_error($link)) { echo mysql_errno($link) .": something whent wrong"; }

echo "client: " . mysql_get_client_info($link) . PHP_EOL .
    "host: " . mysql_get_host_info($link) . PHP_EOL .
    "proto: " . mysql_get_proto_info($link) . PHP_EOL .
    "server: " . mysql_get_server_info($link) . PHP_EOL .
    "info: " . mysql_info($link) . PHP_EOL . 
    "connected: " . (mysql_ping($link) ? 'true' : 'false') . PHP_EOL .
    "status: " . mysql_stat($link) . PHP_EOL . 
    "thread: " . mysql_thread_id($link) . PHP_EOL;

mysql_select_db('a database', $link);

mysql_set_charset('utf8', $link);