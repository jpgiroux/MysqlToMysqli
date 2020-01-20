<?php

namespace App\Transformation;

class ClientInfoTransformation implements ITransformation {

    public function transform(string $in) : string {
        $in = preg_replace([
                '/mysql_get_client_info\((\s*\$\w*\s*)\)/',
                '/mysql_get_client_info\(\)/',
            ],
            [
                'mysqli_get_client_info($1)',
                'mysqli_get_client_info($link)'
            ],
            $in
        );
        return $in;
    }
}