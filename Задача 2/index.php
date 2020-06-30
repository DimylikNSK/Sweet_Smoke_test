<?php
include_once './UrlRebuilder.php';

$fromUrl = 'https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3';
$desired_value = 'https://www.somehost.com/?param4=1&param3=2&param1=4&url=%2Ftest%2Findex.html';

$builder = new UrlRebuilder($fromUrl);
$result = $builder
    ->removeValues(3)
    ->sortQueryArray()
    ->rebuild();

var_dump($desired_value);
var_dump($result);