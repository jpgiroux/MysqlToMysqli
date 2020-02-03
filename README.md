# MysqToMysqli

![PHP Composer](https://github.com/jpgiroux/MysqlToMysqli/workflows/PHP%20Composer/badge.svg)

A php tool to convert your Mysql code to Mysqli.

## Installation

`composer install`

## How to use

`bin/console app:mysql-to-mysqli "PATH/TO/YOUR/DIRECTORY/TO/CONVERT"`

## Supported features

For now, single and multiple files are officialy supported (tested). No class support yet.


## Supported functions

* mysql_connect
* mysql_error
* mysql_errno
* mysql_get_client_info
* mysql_get_host_info
* mysql_get_proto_info
* mysql_get_server_info
* mysql_info
* mysql_ping
* mysql_stat
* mysql_thread_id
* mysql_select_db
* mysql_set_charset
* mysql_query
* mysql_affected_rows
* mysql_insert_id
* mysql_real_escape_string
* mysql_num_rows
* mysql_data_seek
* mysql_fetch_array
* mysql_fetch_assoc
* mysql_fetch_lengths
* mysql_fetch_object
* mysql_fetch_row
* mysql_field_seek
* mysql_free_result
* mysql_close
* MYSQL_BOTH
* MYSQL_ASSOC
* MYSQL_NUM

## Known issues

The use of function as a parameter for the `mysql_real_escape_string` (or any other function) inside the `mysql_query` function (or any other function) is currently bugy.

```php
 $result2 = mysql_query('select * from a_table WHERE something = '
    . mysql_real_escape_string('a"string"', BdConnection::getConnection()) . ' ORDER by id',  BdConnection::getConnection());

```