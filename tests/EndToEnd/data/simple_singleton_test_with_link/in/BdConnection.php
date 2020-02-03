<?php

class BdConnection {

    private static $link;

    private function __construct(){}

    public static function getConnection() {
        if(self::$link == null) {
            self::$link = mysql_connect('aserver', 'auser', 'apass');

            if(mysql_error(self::$link)) { echo mysql_errno(self::$link) .": something whent wrong"; }
        
            echo "client: " . mysql_get_client_info(self::$link) . PHP_EOL .
                "host: " . mysql_get_host_info(self::$link) . PHP_EOL .
                "proto: " . mysql_get_proto_info(self::$link) . PHP_EOL .
                "server: " . mysql_get_server_info(self::$link) . PHP_EOL .
                "info: " . mysql_info(self::$link) . PHP_EOL . 
                "connected: " . (mysql_ping(self::$link) ? 'true' : 'false') . PHP_EOL .
                "status: " . mysql_stat(self::$link) . PHP_EOL . 
                "thread: " . mysql_thread_id(self::$link) . PHP_EOL;
        
            mysql_select_db('a database', self::$link);
        
            mysql_set_charset('utf8', self::$link);
        }

        return self::$link;
    }

    public static function closeConnection() {
        if(self::$link) {
            mysql_close(self::$link);
        }
    }
}