<?php

namespace App\Tests\Unit;

use App\Transformation\ErrorTransformation;
use PHPUnit\Framework\TestCase;

class ErrorTransformationTest extends TestCase {

    /**
     * @var ErrorTransformation
     */
    private $errorTrans;

    protected function setUp() {
        $this->errorTrans = new ErrorTransformation();
    }

    public function testGivenNoLink_ThenMysqliWithLink() {
        $this->assertEquals('mysqli_error($link);', $this->errorTrans->transform('mysql_error();'));
    }

    public function testGivenLink_ThenMysqliWithLink() {
        $this->assertEquals('mysqli_error($myOwnLink);', $this->errorTrans->transform('mysql_error($myOwnLink);'));
    }
}