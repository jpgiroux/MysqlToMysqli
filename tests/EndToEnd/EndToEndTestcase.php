<?php

namespace App\Tests\EndToEnd;

use PHPUnit\Framework\TestCase;

class EndToEndTestcase extends TestCase {

    const TYPE_DIR = 'dir';
    const TYPE_FILE = 'file';

    public function assertDirectoryEquals(string $expected, string $actual, array $ignore = ['.gitignore' => true]) : void {

        $expectedInfo = [];
        $actualInfo = [];
        $this->getDirInfo($expectedInfo, $expected, $ignore);
        $this->getDirInfo($actualInfo, $actual, $ignore);

        $this->assertEquals($expectedInfo, $actualInfo);
    }

    private function getDirInfo(array & $info, string $dir, array $ignore, string $level = '/') : void {
        $dh = opendir($dir);
        while(($file =  \readdir($dh)) !== false) {
            if($file != '.' && $file != '..' && !isset($ignore[$file])){
                $path = $dir . '/' . $file;
                
                if(filetype($path) == self::TYPE_DIR) {
                    $this->getDirInfo($info, $path, $ignore, $level . $file . '/');
                }else{
                    $info[$level . $file] = file_get_contents($path);
                }
            }
        }
        closedir($dh);
    }

    protected function cleanDir(string $dir, array $ignore = ['.gitignore' => true]) : void {
        $dh = opendir($dir);
        while(($file =  \readdir($dh)) !== false) {
            if($file != '.' && $file != '..' && !isset($ignore[$file])){
                $path = $dir . '/' . $file;
                
                if(filetype($path) == self::TYPE_DIR) {
                    rmdir($path);    
                }else{
                    unlink($path);
                }
            }
        }
        closedir($dh);    
    }
};