<?php

namespace App\Tests\Unit;

use App\Transformation\ClientInfoTransformation;
use PHPUnit\Framework\TestCase;

class ClientTransformationTest extends TestCase {

    /**
     * @var ClientInfoTransformation
     */
    private $transformation;

    protected function setUp() {
        $this->transformation = new ClientInfoTransformation();
    }

    public function testGivenNoLink_ThenMysqliWithLink() {
        $this->assertEquals('mysqli_get_client_info($link);', $this->transformation->transform('mysql_get_client_info();'));
    }

    public function testGivenLink_ThenMysqliWithLink() {
        $this->assertEquals('mysqli_get_client_info($myOwnLink);', $this->transformation->transform('mysql_get_client_info($myOwnLink);'));
    }
}