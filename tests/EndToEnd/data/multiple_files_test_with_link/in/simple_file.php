<?php

include_once __DIR__ . '/connect.php';

/*****************************************************
 * Test file containing most common mysql_ functions 
 ****************************************************/

$result1 = mysql_query('insert into visit (time) VALUES (now())', $link);
if(mysql_affected_rows() == 1) {
    $visit = mysql_insert_id();
}

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

mysql_close($link);
