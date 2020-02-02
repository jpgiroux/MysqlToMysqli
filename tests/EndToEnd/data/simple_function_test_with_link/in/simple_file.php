<?php

/*****************************************************
 * Test file containing most common mysql_ functions
 * wrapped into functions 
 ****************************************************/

function connect() {
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

    return $link;
}

function doThingOne() {
    $link = connect();
    $result1 = mysql_query('insert into visit (time) VALUES (now())', $link);
    if(mysql_affected_rows() == 1) {
        $visit = mysql_insert_id();
    }
}

function doThingTwo() {
    $link = connect();

    $result2 = mysql_query('select * from a_table WHERE something = '
    . mysql_real_escape_string('a"string"') . ' ORDER by id',  $link);

    if(mysql_num_rows($result2) >= 10) {

        mysql_data_seek($result2, 2);
        $second = mysql_fetch_array($result2, MYSQL_BOTH);

        mysql_data_seek($result2, 4);
        $forth = mysql_fetch_array($result2, MYSQL_ASSOC);

        mysql_data_seek($result2, 6);
        $six = mysql_fetch_array($result2, MYSQL_NUM);

        $seven = mysql_fetch_assoc($result2);
        $sevenL = mysql_fetch_lengths($result2);

        $eight = mysql_fetch_object($result2, 'class');

        $nine = mysql_fetch_row($result2);

        mysql_data_seek($result2, 10);
        mysql_field_seek($result2, 2);
        mysql_free_result($result2);
    }
}

function close($link) {
    mysql_close($link);
}