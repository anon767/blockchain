<?php
require 'vendor/autoload.php';
use Blockchain\Block;
use Pleo\Merkle\FixedSizeTree;
use Blockchain\FixedSizeTreeWalkable;

$blockchain = new \Blockchain\Blockchain();
$vars = explode(" ","this is a cool test");
foreach($vars as $var){
    $blockchain->addBlock($var);
}
$dbmanager = new \Blockchain\DatabaseManager($blockchain);
$dbmanager->save();
$dbmanager->retrieve();
$blockchain = $dbmanager->getBlockChain();
var_dump($blockchain);