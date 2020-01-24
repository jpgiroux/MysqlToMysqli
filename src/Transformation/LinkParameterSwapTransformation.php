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
                '/' . $this->functionName  .'\((\s*(".*"|\'.*\'|\$(this->)?\w*|\s*|\.*|\\n*|(\$this->)?\w*\([^\)]*\))*\s*),\s*(\$(this->)?\w*\s*)\)/',
                '/' . $this->functionName . '\((\s*(".*"|\'.*\'|\$(this->)?\w*|\s*|\.*|\\n*|(\$this->)?\w*\([^\)]*\))*\s*)\)/',
            ],
            [
                $this->functionReplacement . '($5, $1)',
                $this->functionReplacement . '($link, $1)'
            ],
            $in
        );
        return $in;
    }
}