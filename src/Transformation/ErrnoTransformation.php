<?php

namespace App\Transformation;

class ErrnoTransformation implements ITransformation {

    public function transform(string $in) : string {
        $in = preg_replace([
                '/mysql_errno\((\s*\$\w*\s*)\)/',
                '/mysql_errno\(\)/',
            ],
            [
                'mysqli_errno($1)',
                'mysqli_errno($link)'
            ],
            $in
        );
        return $in;
    }
}