<?php
require_once './vendor/autoload.php';

$cache = new Cache(3);

$cache->set('key1', 1);
$cache->set('key2', 2);
$cache->set('key3', 3);
$cache->set('key4', 4);

var_dump($cache->get('key1'));
var_dump($cache->get('key2'));
var_dump($cache->get('key3'));
var_dump($cache->get('key4'));
