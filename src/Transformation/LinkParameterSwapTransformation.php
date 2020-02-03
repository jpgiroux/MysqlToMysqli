<?php

namespace App\Transformation;

class LinkParameterSwapTransformation implements ITransformation {

    /**
     * @var string
     */
    protected $functionName;

    /**
     * @var string
     */
    protected $functionReplacement;

    public function __construct(string $functionName, string $functionReplacement) {
        $this->functionName = $functionName;
        $this->functionReplacement = $functionReplacement;
    }

    public function transform(string $in) : string {
        $in = preg_replace([
                '/' . $this->functionName  .'\('.Expressions::ANY_STRING.',\s*('.Expressions::VARIABLE.'|'.Expressions::FUNC.'\s*)\)/',
                '/' . $this->functionName . '\('.Expressions::ANY_STRING.'\)/',
            ],
            [
                $this->functionReplacement . '($6, $1)',
                $this->functionReplacement . '($link, $1)',
            ],
            $in
        );
        return $in;
    }
}