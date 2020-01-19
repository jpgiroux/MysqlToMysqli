<?php

namespace App\Transformation;

class ConnectTransformation implements ITransformation {

    public function transform(string $in) : string {
        $in = preg_replace([
            '/(\$\w*\s*=\s*)(mysql_connect)/',
            '/mysql_connect/'
        ], [
            '$1mysqli_connect',
            '$link = mysqli_connect'
        ], $in);
        return $in;
    }
}