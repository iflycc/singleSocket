<?php
/**
 * Created by PhpStorm.
 * User: changchao
 * Date: 2020/1/9
 * Time: 11:09
 */

include "../vendor/autoload.php";

use Single\Socket\Client\ClientTcp;

ClientTcp::getInstance()->run("tcp://127.0.0.1:9800");