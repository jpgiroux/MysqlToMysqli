<?php

namespace App\Tests\Unit;

use App\Transformation\ErrnoTransformation;
use PHPUnit\Framework\TestCase;

class ErrnoTransformationTest extends TestCase {

    /**
     * @var ErrnoTransformation
     */
    private $errnoTrans;

    protected function setUp() {
        $this->errnoTrans = new ErrnoTransformation();
    }

    public function testGivenNoLink_ThenMysqliWithLink() {
        $this->assertEquals('mysqli_errno($link);', $this->errnoTrans->transform('mysql_errno();'));
    }

    public function testGivenLink_ThenMysqliWithLink() {
        $this->assertEquals('mysqli_errno($myOwnLink);', $this->errnoTrans->transform('mysql_errno($myOwnLink);'));
    }
}