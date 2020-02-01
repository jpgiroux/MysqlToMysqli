<?php

namespace App\Tests\Unit;

use App\Transformation\ConnectTransformation;
use PHPUnit\Framework\TestCase;

class ConnectTransformationTest extends TestCase {

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
     * @var ConnectTransformation
     */
    private $transformation;

    protected function setUp() {
        $this->transformation = new ConnectTransformation();
    }

    public function testGivenEmptyString_ThenEmptyString() {
        $this->assertEquals("", $this->transformation->transform(""));
    }

    public function testGivenWhiteString_ThenWhiteString() {
        $this->assertEquals("   ", $this->transformation->transform("   "));
    }

    public function testGivenConnectString_ThenMysqliConnectStringWithLink() {
        $this->assertEquals(self::MYSQLI_CONNECT_STRING_WITH_LINK, 
            $this->transformation->transform(self::MYSQL_CONNECT_STRING));
    }

    public function testGivenTabulatedConnectString_ThenTabulatedMysqliConnectStringWithLink() {
        $this->assertEquals("   " . self::MYSQLI_CONNECT_STRING_WITH_LINK, 
            $this->transformation->transform("   " . self::MYSQL_CONNECT_STRING));
    }

    public function testGivenTabulatedMultiLineConnectString_ThenTabulatedMultiLineMysqliConnectStringWithLink() {
        $this->assertEquals(self::MYSQLI_CONNECT_STRING_WITH_LINK_TAB_ML, 
            $this->transformation->transform(self::MYSQL_CONNECT_STRING_TAB_ML));    
    }
    
    public function testGivenConnectStringWithLink_ThenMysqliConnectStringWithLink() {
        $this->assertEquals(self::MYSQLI_CONNECT_STRING_WITH_LINK, 
            $this->transformation->transform(self::MYSQL_CONNECT_STRING_WITH_LINK)); 
    }

    public function testGivenTabulatedConnectStringWithLink_ThenTabulatedMysqliConnectStringWithLink() {
        $this->assertEquals("   " . self::MYSQLI_CONNECT_STRING_WITH_LINK, 
            $this->transformation->transform("   " . self::MYSQL_CONNECT_STRING_WITH_LINK)); 
    }

    public function testGivenTabulatedConnectStringWithLinkMultiLine_ThenTabulatedMysqliConnectStringWhithLinkMultiLine() {
        $this->assertEquals(self::MYSQLI_CONNECT_STRING_WITH_LINK_TAB_ML, 
            $this->transformation->transform(self::MYSQL_CONNECT_STRING_WITH_LINK_TAB_ML));    
    }

    public function testGivenConnectStringWithCustomLink_ThenMysqliConnectStringWithCustomLink() {
        $this->assertEquals(self::MYSQLI_CONNECT_STRING_WITH_CUSTOM_LINK, 
            $this->transformation->transform(self::MYSQL_CONNECT_STRING_WITH_CUSTOM_LINK));   
    }

}