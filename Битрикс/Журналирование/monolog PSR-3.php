<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('NAME');
$log->pushHandler(new StreamHandler('path/logs/error.log', Logger::DEBUG));

// add records to the log
$log->warning('Foo', array('additional_field' => 'text'));
$log->error('Bar', array('additional_field' => 'text'));
?>