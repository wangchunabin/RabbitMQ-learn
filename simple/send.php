<?php
require_once __DIR__ . '/../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

$stime = microtime(true);
echo $stime."\n";
$message = '简单模式--'.$stime;
$msg = new AMQPMessage($message);
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent '简单模式'\n";

$channel->close();
$connection->close();