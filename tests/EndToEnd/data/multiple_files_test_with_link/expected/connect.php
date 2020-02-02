<?php

/*****************************************************
 * Test file containing a single connection and some info functions
 ****************************************************/

$link = mysqli_connect('aserver', 'auser', 'apass');

if(mysqli_error($link)) { echo mysqli_errno($link) .": something whent wrong"; }

echo "client: " . mysqli_get_client_info($link) . PHP_EOL .
    "host: " . mysqli_get_host_info($link) . PHP_EOL .
    "proto: " . mysqli_get_proto_info($link) . PHP_EOL .
    "server: " . mysqli_get_server_info($link) . PHP_EOL .
    "info: " . mysqli_info($link) . PHP_EOL . 
    "connected: " . (mysqli_ping($link) ? 'true' : 'false') . PHP_EOL .
    "status: " . mysqli_stat($link) . PHP_EOL . 
    "thread: " . mysqli_thread_id($link) . PHP_EOL;

mysqli_select_db($link, 'a database');

mysqli_set_charset($link, 'utf8');