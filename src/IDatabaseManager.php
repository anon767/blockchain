<?php
/**
 * @project: blockchain
 * @package: Blockchain
 * @author: anon767
 * @date: 20.01.2017
 */

namespace Blockchain;


interface IDatabaseManager
{
    public function __construct(Blockchain $blockchain);
    public function save();
    public function retrieve();
}