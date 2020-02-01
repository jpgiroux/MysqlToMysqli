<?php

namespace App\Transformation;

class SimpleLinkTransformation implements ITransformation {

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
                '/' . $this->functionName . '\(\)/',
                '/' . $this->functionName  .'\('.Expressions::ANY_STRING.'\)/',
                
            ],
            [
                $this->functionReplacement . '($link)',
                $this->functionReplacement . '($1)',
            ],
            $in
        );
        return $in;
    }

}