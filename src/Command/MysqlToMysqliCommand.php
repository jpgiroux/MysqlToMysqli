<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\MysqlToMysqli;
use Symfony\Component\Console\Input\InputArgument;

class MysqlToMysqliCommand extends Command
{    
    protected static $defaultName = 'app:mysql-to-mysqli';

    private $mysqlTomysqli;

    public function __construct(MysqlToMysqli $mysqlToMysqli)
    {
        $this->mysqlTomysqli = $mysqlToMysqli;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription("Convert a directory using mysql extension to use mysqli instead.");
        $this->addArgument("dir", InputArgument::REQUIRED, "The directory to convert");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dir = $input->getArgument("dir");
        $this->mysqlTomysqli->convert($dir);
        return 0;
    }
}