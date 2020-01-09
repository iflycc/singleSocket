<?php
/**
 * Created by PhpStorm.
 * User: changchao
 * Date: 2020/1/9
 * Time: 9:56
 */

namespace Single\Socket;


class Worker
{
    private $createSocket = null; // socket连接句柄
    private $acceptSocket = null; // socket接受之后的资源流
    private $sendContent = "hi client, i'm server~"; // 回复客户端的数据

    /**
     * Worker constructor.
     * @param string $socket_address socket地址
     */
    public function __construct($socket_address){
        $this->createSocket = stream_socket_server($socket_address,$errNo,$errStr); //创建一个socket服务监听资源
        if(!$this->createSocket){ //创建socket失败，打印报错信息
            echo "err: $errNo ($errStr)",PHP_EOL;
        }
    }

    /**
     * 启动服务
     */
    public function run(){
        while (true){ // 循环监听
            $this->acceptSocket = stream_socket_accept($this->createSocket,-1); // 创建接受socket通道
            if(!$this->acceptSocket) continue; // 接收socket失败，结束本次循环
            $this->onConnect($this->acceptSocket);// 接受socket通道，触发连接事件回调
            
            $buffer = fread($this->acceptSocket,65535); // 读取缓冲区的数据，设置最大长度：65535
            if(!$buffer) continue; // 无数据，中断循环
            $this->onReceive($buffer); // 触发接收消息事件
            $this->_send(); // 发送数据
        }
    }

    /**
     * 
     * @param string $content 设置发送的内容
     */
    public function setSendContent($content){
        $this->sendContent = $content ? : $this->sendContent;    
    }
    
    /**
     * socket连接事件回调
     * @param resource $conn 连接socket资源
     */
    protected function onConnect($conn){
        echo "连接成功：{$conn}",PHP_EOL;
    }

    protected function onReceive($buffer){
        echo "接收到消息：{$buffer}",PHP_EOL;
    }

    /**
     * 发送数据（其实就是想socket连接接受资源中写数据）
     */
    private function _send(){
        echo "回复数据：{$this->sendContent}",PHP_EOL;
        fwrite($this->acceptSocket,$this->sendContent);
    }
}