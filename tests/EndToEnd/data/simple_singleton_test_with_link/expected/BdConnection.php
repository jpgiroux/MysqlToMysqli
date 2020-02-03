<?php

class BdConnection {

    private static $link;

    private function __construct(){}

    public static function getConnection() {
        if(self::$link == null) {
            self::$link = mysqli_connect('aserver', 'auser', 'apass');

            if(mysqli_error(self::$link)) { echo mysqli_errno(self::$link) .": something whent wrong"; }
        
            echo "client: " . mysqli_get_client_info(self::$link) . PHP_EOL .
                "host: " . mysqli_get_host_info(self::$link) . PHP_EOL .
                "proto: " . mysqli_get_proto_info(self::$link) . PHP_EOL .
                "server: " . mysqli_get_server_info(self::$link) . PHP_EOL .
                "info: " . mysqli_info(self::$link) . PHP_EOL . 
                "connected: " . (mysqli_ping(self::$link) ? 'true' : 'false') . PHP_EOL .
                "status: " . mysqli_stat(self::$link) . PHP_EOL . 
                "thread: " . mysqli_thread_id(self::$link) . PHP_EOL;
        
            mysqli_select_db(self::$link, 'a database');
        
            mysqli_set_charset(self::$link, 'utf8');
        }

        return self::$link;
    }

    public static function closeConnection() {
        if(self::$link) {
            mysqli_close(self::$link);
        }
    }
}