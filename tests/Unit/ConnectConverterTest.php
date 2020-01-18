<?php

namespace App\Tests\Unit;

use App\ConnectConverter;
use PHPUnit\Framework\TestCase;

class ConnectConverterTest extends TestCase {

    const MYSQL_CONNECT_STRING = "mysql_connect('a db', 'a user', '***');";
    const MYSQL_CONNECT_STRING_TAB_ML = "   mysql_connect(
        'a db',
        'a user',
        '***'
    );";
    const MYSQL_CONNECT_STRING_WITH_LINK = "\$link = mysql_connect('a db', 'a user', '***');";
    const MYSQL_CONNECT_STRING_WITH_LINK_TAB_ML = "   \$link = mysql_connect(
        'a db',
        'a user',
        '***'
    );";

    const MYSQL_CONNECT_STRING_WITH_CUSTOM_LINK = "\$myConnection = mysql_connect('a db', 'a user', '***');";

    const MYSQLI_CONNECT_STRING_WITH_LINK = "\$link = mysqli_connect('a db', 'a user', '***');";
    const MYSQLI_CONNECT_STRING_WITH_LINK_TAB_ML = "   \$link = mysqli_connect(
        'a db',
        'a user',
        '***'
    );";
    const MYSQLI_CONNECT_STRING_WITH_CUSTOM_LINK = "\$myConnection = mysqli_connect('a db', 'a user', '***');";

    /**
     * @var ConnectConverter
     */
    private $converter;

    protected function setUp() {
        $this->converter = new ConnectConverter();
    }

    public function testGivenEmptyString_WhenConverting_ThenEmptyString() {
        $this->assertEquals("", $this->converter->convert(""));
    }

    public function testGivenWhiteString_WhenConverting_ThenWhiteString() {
        $this->assertEquals("   ", $this->converter->convert("   "));
    }

    public function testGivenConnectString_WhenConverting_ThenMysqliConnectStringWithLink() {
        $this->assertEquals(self::MYSQLI_CONNECT_STRING_WITH_LINK, 
            $this->converter->convert(self::MYSQL_CONNECT_STRING));
    }

    public function testGivenTabulatedConnectString_WhenConverting_ThenTabulatedMysqliConnectStringWithLink() {
        $this->assertEquals("   " . self::MYSQLI_CONNECT_STRING_WITH_LINK, 
            $this->converter->convert("   " . self::MYSQL_CONNECT_STRING));
    }

    public function testGivenTabulatedMultiLineConnectString_WhenConverting_ThenTabulatedMultiLineMysqliConnectStringWithLink() {
        $this->assertEquals(self::MYSQLI_CONNECT_STRING_WITH_LINK_TAB_ML, 
            $this->converter->convert(self::MYSQL_CONNECT_STRING_TAB_ML));    
    }
    
    public function testGivenConnectStringWithLink_WhenConverting_ThenMysqliConnectStringWithLink() {
        $this->assertEquals(self::MYSQLI_CONNECT_STRING_WITH_LINK, 
            $this->converter->convert(self::MYSQL_CONNECT_STRING_WITH_LINK)); 
    }

    public function testGivenTabulatedConnectStringWithLink_WhenConverting_ThenTabulatedMysqliConnectStringWithLink() {
        $this->assertEquals("   " . self::MYSQLI_CONNECT_STRING_WITH_LINK, 
            $this->converter->convert("   " . self::MYSQL_CONNECT_STRING_WITH_LINK)); 
    }

    public function testGivenTabulatedConnectStringWithLinkMultiLine_WhenConverting_ThenTabulatedMysqliConnectStringWhithLinkMultiLine() {
        $this->assertEquals(self::MYSQLI_CONNECT_STRING_WITH_LINK_TAB_ML, 
            $this->converter->convert(self::MYSQL_CONNECT_STRING_WITH_LINK_TAB_ML));    
    }

    public function testGivenConnectStringWithCustomLink_WhenConverting_ThenMysqliConnectStringWithCustomLink() {
        $this->assertEquals(self::MYSQLI_CONNECT_STRING_WITH_CUSTOM_LINK, 
            $this->converter->convert(self::MYSQL_CONNECT_STRING_WITH_CUSTOM_LINK));   
    }

}