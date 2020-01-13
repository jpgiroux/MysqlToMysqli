# MysqToMysqli

A php tool to convert your Mysql code to Mysqli.

## Installation

`composer install`

## How to use

`bin/console app:mysql-to-mysqli "PATH/TO/YOUR/DIRECTORY/TO/CONVERT"`

## Supported features

For now, a single file is supported. No scope management. The variable $link might be overwritten. The link identifier from mysql is not supported.


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