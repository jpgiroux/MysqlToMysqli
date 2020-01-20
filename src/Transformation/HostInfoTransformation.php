<?php

namespace App\Transformation;

class HostInfoTransformation implements ITransformation {

    public function transform(string $in) : string {
        $in = preg_replace([
                '/mysql_get_host_info\((\s*\$\w*\s*)\)/',
                '/mysql_get_host_info\(\)/',
            ],
            [
                'mysqli_get_host_info($1)',
                'mysqli_get_host_info($link)'
            ],
            $in
        );
        return $in;
    }
}