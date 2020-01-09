<?php
/**
 * Created by PhpStorm.
 * User: changchao
 * Date: 2020/1/9
 * Time: 11:10
 */

namespace Single\Socket\Client;


class ClientTcp
{
    private static $instance = null;

    /**
     * ClientTcp constructor.
     */
    private function __construct(){

    }

    private function __clone(){

    }

    /**
     * @return null|ClientTcp
     */
    public static function getInstance(){
        if(! self::$instance instanceof self){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param string $remote_socket socket远程地址，如：tcp://127.0.0.1:9800
     */
    public function run($remote_socket){
        $clientSocket = stream_socket_client($remote_socket,$errNo,$errStr);
        if(!$clientSocket) {
            echo "$errNo ($errStr)",PHP_EOL;
        }
        else{
            // 连接建立，向socket中写数据
            fwrite($clientSocket,"Hi server, " . mt_rand(1,1000) ."~");
            // 读取socket缓冲区数据
            while (!feof($clientSocket)){
                $buffer = fgets($clientSocket,1024);
                echo "服务器回复：",$buffer,PHP_EOL;
            }
            fclose($clientSocket);
        }

    }

}