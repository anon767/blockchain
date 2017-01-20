<?php
/**
 * @project: blockchain
 * @package: Blockchain
 * @author: anon767
 * @date: 20.01.2017
 */

namespace Blockchain;


use Blockchain\Block;

class Blockchain implements \JsonSerializable
{
    private $blocks = [];
    protected $hasher;
    private $merkelRootHash = "";


    public function __construct($hasher = false)
    {
        if (!$hasher) {
            $this->hasher = function ($data) {
                return hash('sha256', hash('sha256', $data, false), false);
            };
        } else {
            $this->hasher = $hasher;
        }
    }

    public function buildMerkelTree()
    {
        if (count($this->blocks) < 2)
            return;
        $tree = new FixedSizeTreeWalkable(count($this->blocks), $this->hasher);

        foreach ($this->blocks as $key => $block) {
            $tree->set($key, $block->getData());
        }
        $this->merkelRootHash = $tree->getTreeRoot()->getHash();
    }

    public function hashBlocks()
    {
        foreach ($this->blocks as $key => $block) {
            $block->setHash(call_user_func($this->hasher, $block->getData()));
            if ($key > 0) {
                $block->setPreviousHash(call_user_func($this->hasher, $this->blocks[$key - 1]->getData()));
            }
        }
    }

    public function addBlock($data)
    {
        if ($data INSTANCEOF Block) {
            array_push($this->blocks, $data);
        } else {
            $block = new Block();
            $block->setData($data);
            array_push($this->blocks, $block);
        }
        $this->hashBlocks();
        $this->buildMerkelTree();
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return ["blocks" => $this->blocks,
            "merkelRootHash" => $this->merkelRootHash];
    }
}