<?php

include_once __DIR__ . '/BdConnection.php';

/*****************************************************
 * Test file containing most common mysql_ functions
 * wrapped into functions using singleton connection
 ****************************************************/

function doThingOne() {
    $result1 = mysqli_query(BdConnection::getConnection(), 'insert into visit (time) VALUES (now())');
    if(mysqli_affected_rows(BdConnection::getConnection()) == 1) {
        $visit = mysqli_insert_id(BdConnection::getConnection());
    }
}

function doThingTwo() {
    $link = BdConnection::getConnection();
    $result2 = mysqli_query(BdConnection::getConnection(), 'select * from a_table WHERE something = '
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
}