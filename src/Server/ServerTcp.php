<?php
/**
 * Created by PhpStorm.
 * User: changchao
 * Date: 2020/1/9
 * Time: 10:55
 * TCP 服务端
 */

namespace Single\Socket\Server;
use Single\Socket\Worker;


class ServerTcp
{
    private static $instance = null;

    /**
     * ServerTcp constructor.
     */
    private function __construct(){

    }


    private function __clone(){
        // TODO: Implement __clone() method.
    }

    /**
     * @return null|ServerTcp
     */
    public static function getInstance(){
        if(!self::$instance instanceof self){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $socket_address
     * @param string $sendContent
     */
    public function start($socket_address,$sendContent = ""){
        $worker = new Worker($socket_address);
        $worker->setSendContent($sendContent);
        $worker->run();
    }


}