<?php

namespace App;

class ConnectConverter {

    const REGEX_NEEDLE = '/(\$\w*)?(\s*=\s*)?(mysql_connect\()/';

    const IDX_LINK = 1;
    const IDX_AFFEC = 2;
    const IDX_MYSQL_CONNECT = 3;

    public function convert(string $in) : string {

        $matches = [];
        preg_match(self::REGEX_NEEDLE, $in, $matches);

        if(!empty($matches)) {
            
            if($matches[self::IDX_LINK] != "" &&  $matches[self::IDX_MYSQL_CONNECT] != "") {
                $in = str_replace($matches[self::IDX_MYSQL_CONNECT], "mysqli_connect(", $in);
            }
            else if($matches[self::IDX_MYSQL_CONNECT] != "") {
                $in = str_replace($matches[self::IDX_MYSQL_CONNECT], "\$link = mysqli_connect(", $in);
            }
        }

        return $in;
    }

}