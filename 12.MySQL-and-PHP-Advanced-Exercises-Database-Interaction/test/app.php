<?php
session_start();
spl_autoload_register(function($class){
    require_once $class.'.php';
});

$app = new \Core\Application();
$db = new \Adapter\PDODatabase(
    \Config\DbConfig::DB_HOST,
    \Config\DbConfig::DB_NAME,
    \Config\DbConfig::DB_USER,
    \Config\DbConfig::DB_PASS
);