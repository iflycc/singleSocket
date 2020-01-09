<?php
/**
 * Created by PhpStorm.
 * User: changchao
 * Date: 2020/1/9
 * Time: 10:51
 */
require "../vendor/autoload.php";

use Single\Socket\Server\ServerTcp;

$content = "hi client~\r\n";


// 方式1：设置回复http请求
$http_response = "HTTP/1.1 200 OK\r\n";
$http_response.= "Content-Type:text/html;charset=utf-8;\r\n";
$http_response.= "Connection: keep-alive\r\n";
$http_response.= "Server: php socket server\r\n";
$http_response.= "Content-length: " . strlen($content) ."\r\n\r\n";
$http_response.= $content;
ServerTcp::getInstance()->start("tcp://0.0.0.0:9800",$http_response);


exit;
// 方式2：tcp回复
ServerTcp::getInstance()->start("tcp://0.0.0.0:9800",$content);