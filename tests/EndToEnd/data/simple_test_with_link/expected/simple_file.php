<?php

/*****************************************************
 * Test file containing a single connection and the 
 * most common mysql_ functions 
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

$result1 = mysqli_query($link, 'insert into visit (time) VALUES (now())');
if(mysqli_affected_rows($link) == 1) {
    $visit = mysqli_insert_id($link);
}

$result2 = mysqli_query($link, 'select * from a_table WHERE something = '
 . mysqli_real_escape_string($link, 'a"string"') . ' ORDER by id');

if(mysqli_num_rows($result2) >= 10) {

    mysqli_data_seek($result2, 2);
    $second = mysqli_fetch_array($result2, MYSQLI_BOTH);

    mysqli_data_seek($result2, 4);
    $forth = mysqli_fetch_array($result2, MYSQLI_ASSOC);

    mysqli_data_seek($result2, 6);
    $six = mysqli_fetch_array($result2, MYSQLI_NUM);

    $seven = mysqli_fetch_assoc($result2);
    $sevenL = mysqli_fetch_lengths($result2);

    $eight = mysqli_fetch_object($result2, 'class');

    $nine = mysqli_fetch_row($result2);

    mysqli_data_seek($result2, 10);
    mysqli_field_seek($result2, 2);
    mysqli_free_result($result2);
}

mysqli_close($link);
