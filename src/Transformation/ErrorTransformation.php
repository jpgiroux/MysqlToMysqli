<?php

namespace App\Transformation;

class ErrorTransformation implements ITransformation {

    public function transform(string $in) : string {
        $in = preg_replace([
                '/mysql_error\((\s*\$\w*\s*)\)/',
                '/mysql_error\(\)/',
            ],
            [
                'mysqli_error($1)',
                'mysqli_error($link)'
            ],
            $in
        );
        return $in;
    }
}