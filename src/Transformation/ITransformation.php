<?php

namespace App\Transformation;

interface ITransformation {

    public function transform(string $in) : string;
}