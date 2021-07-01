<?php

require_once './app/autoloader.php';
App\DB::connect();

$obj = new App\Controller\Main();
echo $obj->start();

