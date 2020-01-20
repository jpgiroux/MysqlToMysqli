<?php

namespace App\Tests\Unit;

use App\Transformation\ClientInfoTransformation;
use App\Transformation\HostInfoTransformation;
use PHPUnit\Framework\TestCase;

class HostInfoTransformationTest extends TestCase {

    /**
     * @var HostInfoTransformation
     */
    private $transformation;

    protected function setUp() {
        $this->transformation = new HostInfoTransformation();
    }

    public function testGivenNoLink_ThenMysqliWithLink() {
        $this->assertEquals('mysqli_get_host_info($link);', $this->transformation->transform('mysql_get_host_info();'));
    }

    public function testGivenLink_ThenMysqliWithLink() {
        $this->assertEquals('mysqli_get_host_info($myOwnLink);', $this->transformation->transform('mysql_get_host_info($myOwnLink);'));
    }
}