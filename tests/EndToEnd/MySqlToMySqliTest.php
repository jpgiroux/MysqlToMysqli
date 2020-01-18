<?php

namespace App\Tests\EndToEnd;

use App\MysqlToMysqli;

class MySqlToMySqliTest extends EndToEndTestcase{

    private $converter;

    public function setup() {
        $this->converter = new MysqlToMysqli();
    }

    public function testDoSimpleTest() {
        $this->cleanDir(__DIR__ . '/data/simple_test/out');

        $this->converter->convert(__DIR__ . '/data/simple_test/in/');
        $this->assertDirectoryEquals(__DIR__ .'/data/simple_test/expected',
            __DIR__ . '/data/simple_test/out');
    }

    public function testDoSimpleTestWithLink() {
        $this->cleanDir(__DIR__ . '/data/simple_test_with_link/out');

        $this->converter->convert(__DIR__ . '/data/simple_test_with_link/in/');
        $this->assertDirectoryEquals(__DIR__ .'/data/simple_test_with_link/expected',
            __DIR__ . '/data/simple_test_with_link/out');
    }
}