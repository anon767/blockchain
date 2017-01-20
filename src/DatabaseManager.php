<?php
/**
 * @project: blockchain
 * @package: Blockchain
 * @author: anon767
 * @date: 20.01.2017
 */

namespace Blockchain;


class DatabaseManager implements IDatabaseManager
{
    private $blockChain;
    private $savePath = "data/blockchain.dat";

    public function __construct(Blockchain $blockchain)
    {
        $this->blockChain = $blockchain;
    }

    public function save()
    {
        file_put_contents($this->savePath, json_encode($this->blockChain));
    }

    public function retrieve()
    {
        $array = json_decode(file_get_contents($this->savePath), true);
        $this->blockChain = new Blockchain();
        foreach ($array["blocks"] as $block) {
            $blocknew = new Block();
            $blocknew->setData($block["data"]);
            $blocknew->setHash($block["hash"]);
            $blocknew->setTimeStamp($block["timeStamp"]);
            $blocknew->setPreviousHash($block["previousHash"]);
            $this->blockChain->addBlock($blocknew);
        }
    }

    /**
     * @return Blockchain
     */
    public function getBlockChain()
    {
        return $this->blockChain;
    }

    /**
     * @param Blockchain $blockChain
     */
    public function setBlockChain($blockChain)
    {
        $this->blockChain = $blockChain;
    }

}