<?php

namespace App\Transformation;

class Expressions {

    const DOUBLE_QUOTE_STRING = '".*"';
    const SINGLE_QUOTE_STRING = '\'.*\'';
    const VARIABLE = '\$(this->)?\w*';
    const NEW_LINE = '\\n*';
    const CONCAT_OPERATOR = '\.*';
    const WHITE = '\s*';
    const FUNC = '(\$this->)?\w*\([^\)]*\)';

    const ANY_STRING = '(('.self::DOUBLE_QUOTE_STRING.'|'.self::SINGLE_QUOTE_STRING.'|'.self::VARIABLE.
        '|'.self::NEW_LINE.'|'.self::CONCAT_OPERATOR.'|'.self::WHITE.'|'.self::FUNC.')*)';
}