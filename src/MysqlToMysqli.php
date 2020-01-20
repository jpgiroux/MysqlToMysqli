<?php

namespace App;

use App\Transformation\ConnectTransformation;
use App\Transformation\SimpleLinkTransformation;

class MysqlToMysqli {

    const NEEDLES = [
        'mysql_get_proto_info()',
        'mysql_get_server_info()',
        'mysql_info()',
        'mysql_ping()',
        'mysql_stat()',
        'mysql_thread_id()',
        'mysql_select_db(',
        'mysql_set_charset(',
        'mysql_query(',
        'mysql_affected_rows()',
        'mysql_insert_id()',
        'mysql_real_escape_string(',
        'mysql_num_rows(',
        'mysql_data_seek(',
        'mysql_fetch_array(',
        'mysql_fetch_assoc(',
        'mysql_fetch_lengths(',
        'mysql_fetch_object(',
        'mysql_fetch_row(',
        'mysql_field_seek(',
        'mysql_free_result(',
        'mysql_close()',
        'MYSQL_BOTH',
        'MYSQL_ASSOC',
        'MYSQL_NUM',
    ];

    const REPLACES = [
        'mysqli_get_proto_info($link)',
        'mysqli_get_server_info($link)',
        'mysqli_info($link)',
        'mysqli_ping($link)',
        'mysqli_stat($link)',
        'mysqli_thread_id($link)',
        'mysqli_select_db($link, ',
        'mysqli_set_charset($link, ',
        'mysqli_query($link, ',
        'mysqli_affected_rows($link)',
        'mysqli_insert_id($link)',
        'mysqli_real_escape_string($link, ',
        'mysqli_num_rows(',
        'mysqli_data_seek(',
        'mysqli_fetch_array(',
        'mysqli_fetch_assoc(',
        'mysqli_fetch_lengths(',
        'mysqli_fetch_object(',
        'mysqli_fetch_row(',
        'mysqli_field_seek(',
        'mysqli_free_result(',
        'mysqli_close($link)',
        'MYSQLI_BOTH',
        'MYSQLI_ASSOC',
        'MYSQLI_NUM',
    ];

    private $files_content = [];

    private $transformations;

    public function __construct() {
       
        $this->transformations = [
            new ConnectTransformation(),
            new SimpleLinkTransformation('mysql_error', 'mysqli_error'),
            new SimpleLinkTransformation('mysql_errno', 'mysqli_errno'),
            new SimpleLinkTransformation('mysql_get_client_info', 'mysqli_get_client_info'),
            new SimpleLinkTransformation('mysql_get_host_info', 'mysqli_get_host_info'),
        ];
    }

    public function convert(string $dir) : void {
        if(is_dir($dir)) {
            if($dh = opendir($dir)) {
                while(($file = \readdir($dh)) !== false) {
                    if($file == '.' || $file == '..') continue;
                    
                    $fh = fopen($dir . $file, 'r');
                    $content = "";

                    while(!feof($fh)) {
                        $content .= fgets($fh);
                    }
                    fclose($fh);

                    foreach($this->transformations as $transformation) {
                        $content = $transformation->transform($content);
                    }

                    $this->files_content[$file] = str_replace(self::NEEDLES, self::REPLACES, $content);
                }
                closedir($dh);

                foreach($this->files_content as $file => $file_content) {
                    file_put_contents("$dir/../out/$file", $file_content);
                }
            }
        }
    }
}