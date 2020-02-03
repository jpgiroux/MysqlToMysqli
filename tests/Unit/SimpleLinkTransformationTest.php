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

    public function testGivenLinkHasFunctionCall_ThenMysqliWithLinkHasFunctionCall() {
        $this->assertEquals(self::A_FUNCTION_MYSQLI . '(functionCall());', $this->transformation->transform(self::A_FUNCTION_MYSQL . '(functionCall());'));
    }

    public function testGivenLinkHasFunctionCallWithParameters_ThenMysqliWithLinkHasFunctionCallWithParameters() {
        $this->assertEquals(self::A_FUNCTION_MYSQLI . '(functionCall("stuff", $other));', $this->transformation->transform(self::A_FUNCTION_MYSQL . '(functionCall("stuff", $other));'));
    }

    public function testGivenClassLinkHasMethod_ThenMysqliWithClassLinkHasMethod() {
        $this->assertEquals(self::A_FUNCTION_MYSQLI . '($this->functionCall("stuff", $this->other));', $this->transformation->transform(self::A_FUNCTION_MYSQL . '($this->functionCall("stuff", $this->other));'));
    }

    public function testGivenSingletonLink_ThenMysqliWithSingletonLink() {
        $this->assertEquals(self::A_FUNCTION_MYSQLI . '(Singleton::getLink());', $this->transformation->transform(self::A_FUNCTION_MYSQL . '(Singleton::getLink());'));
    }

    public function testGivenNamespaceSingletonLink_ThenMysqliWithNamespaceSingletonLink() {
        $this->assertEquals(self::A_FUNCTION_MYSQLI . '(App\Singleton::getLink());', $this->transformation->transform(self::A_FUNCTION_MYSQL . '(App\Singleton::getLink());'));
    }

    public function testGivenGlobalNamespaceSingletonLink_ThenMysqliWithGlobalNamespaceSingletonLink() {
        $this->assertEquals(self::A_FUNCTION_MYSQLI . '(\Singleton::getLink());', $this->transformation->transform(self::A_FUNCTION_MYSQL . '(\Singleton::getLink());'));
    }
}