<?php

namespace App\Tests\Unit;

use App\Transformation\SimpleLinkTransformation;
use PHPUnit\Framework\TestCase;

class SimpleLinkTransformationTest extends TestCase {

    const A_FUNCTION_MYSQL = 'mysql_get_client_info';
    const A_FUNCTION_MYSQLI = 'mysqli_get_client_info';

    /**
     * @var SimpleLinkTransformation
     */
    private $transformation;

    protected function setUp() {
        $this->transformation = new SimpleLinkTransformation(self::A_FUNCTION_MYSQL, self::A_FUNCTION_MYSQLI);
    }

    public function testGivenNoLink_ThenMysqliWithLink() {
        $this->assertEquals(self::A_FUNCTION_MYSQLI . '($link);', $this->transformation->transform(self::A_FUNCTION_MYSQL . '();'));
    }

    public function testGivenLink_ThenMysqliWithLink() {
        $this->assertEquals(self::A_FUNCTION_MYSQLI . '($myOwnLink);', $this->transformation->transform(self::A_FUNCTION_MYSQL . '($myOwnLink);'));
    }
}