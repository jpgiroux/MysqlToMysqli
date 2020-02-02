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

    public function testDoMultipleFilesTestWithLink() {
        $this->cleanDir(__DIR__ . '/data/multiple_files_test_with_link/out');

        $this->converter->convert(__DIR__ . '/data/multiple_files_test_with_link/in/');
        $this->assertDirectoryEquals(__DIR__ .'/data/multiple_files_test_with_link/expected',
            __DIR__ . '/data/multiple_files_test_with_link/out');
    }

    public function testDoSimpleFunctionTestWithLink() {
        $this->cleanDir(__DIR__ . '/data/simple_function_test_with_link/out');

        $this->converter->convert(__DIR__ . '/data/simple_function_test_with_link/in/');
        $this->assertDirectoryEquals(__DIR__ .'/data/simple_function_test_with_link/expected',
            __DIR__ . '/data/simple_function_test_with_link/out');
    }
}