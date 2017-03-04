<?php
use \Workerman\Worker;
use \GatewayWorker\Gateway;
use \Workerman\Autoloader;
require_once __DIR__ . '/../../Workerman/Autoloader.php';
Autoloader::setRootPath(__DIR__);

// #### 内部推送端口(假设当前服务器内网ip为192.168.100.100) ####
$internal_gateway = new Gateway("Text://127.0.0.1:7273");
$internal_gateway->name='internalGateway';
$internal_gateway->startPort = 2800;
// 端口为start_register.php中监听的端口，聊天室默认是1236
$internal_gateway->registerAddress = '127.0.0.1:1236';
// #### 内部推送端口设置完毕 ####

if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}