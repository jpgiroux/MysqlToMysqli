<?php

namespace App;

use App\Transformation\ConnectTransformation;
use App\Transformation\LinkParameterSwapTransformation;
use App\Transformation\SimpleLinkTransformation;

class MysqlToMysqli {

    const NEEDLES = [
        'mysql_num_rows(',
        'mysql_data_seek(',
        'mysql_fetch_array(',
        'mysql_fetch_assoc(',
        'mysql_fetch_lengths(',
        'mysql_fetch_object(',
        'mysql_fetch_row(',
        'mysql_field_seek(',
        'mysql_free_result(',
        'MYSQL_BOTH',
        'MYSQL_ASSOC',
        'MYSQL_NUM',
    ];

    const REPLACES = [
        'mysqli_num_rows(',
        'mysqli_data_seek(',
        'mysqli_fetch_array(',
        'mysqli_fetch_assoc(',
        'mysqli_fetch_lengths(',
        'mysqli_fetch_object(',
        'mysqli_fetch_row(',
        'mysqli_field_seek(',
        'mysqli_free_result(',
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
            new SimpleLinkTransformation('mysql_get_proto_info', 'mysqli_get_proto_info'),
            new SimpleLinkTransformation('mysql_get_server_info', 'mysqli_get_server_info'),
            new SimpleLinkTransformation('mysql_info', 'mysqli_info'),
            new SimpleLinkTransformation('mysql_ping', 'mysqli_ping'),
            new SimpleLinkTransformation('mysql_stat', 'mysqli_stat'),
            new SimpleLinkTransformation('mysql_thread_id', 'mysqli_thread_id'),
            new SimpleLinkTransformation('mysql_affected_rows', 'mysqli_affected_rows'),
            new SimpleLinkTransformation('mysql_insert_id', 'mysqli_insert_id'),
            new SimpleLinkTransformation('mysql_close', 'mysqli_close'),
            new LinkParameterSwapTransformation('mysql_select_db', 'mysqli_select_db'),
            new LinkParameterSwapTransformation('mysql_set_charset', 'mysqli_set_charset'),
            new LinkParameterSwapTransformation('mysql_real_escape_string', 'mysqli_real_escape_string'),
            new LinkParameterSwapTransformation('mysql_query', 'mysqli_query'),
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