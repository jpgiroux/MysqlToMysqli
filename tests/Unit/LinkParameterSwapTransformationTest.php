<?php

namespace App\Tests\Unit;

use App\Transformation\LinkParameterSwapTransformation;
use PHPUnit\Framework\TestCase;

class LinkParameterSwapTransformationTest extends TestCase {

    const A_FUNCTION_MYSQL = 'mysql_select_db';
    const A_FUNCTION_MYSQLI = 'mysqli_select_db';

    /**
     * @var LinkParameterSwapTransformation
     */
    private $transformation;

    protected function setUp() {
        $this->transformation = new LinkParameterSwapTransformation(self::A_FUNCTION_MYSQL, self::A_FUNCTION_MYSQLI);
    }

    public function testGivenNoLink_ThenMysqliWithLink() {
        $this->assertEquals(self::A_FUNCTION_MYSQLI . '($link, "a database");', $this->transformation->transform(self::A_FUNCTION_MYSQL . '("a database");'));
    }

    public function testGivenLink_ThenMysqliWithLink() {
        $this->assertEquals(self::A_FUNCTION_MYSQLI . '($myOwnLink, "a database");', $this->transformation->transform(self::A_FUNCTION_MYSQL . '("a database", $myOwnLink);'));
    }

    public function testGivenLinkAndComplicatedStringExpression_ThenMysqliWithLinkAndExpression() {
        $this->assertEquals(self::A_FUNCTION_MYSQLI . '($myOwnLink, "a," . \'data,\' . $base);', $this->transformation->transform(self::A_FUNCTION_MYSQL . '("a," . \'data,\' . $base, $myOwnLink);'));
    }
}