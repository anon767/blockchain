<?php
/**
 * @project: blockchain
 * @package: Blockchain
 * @author: anon767
 * @date: 20.01.2017
 */

namespace Blockchain;


class Block implements \JsonSerializable
{
    private $hash;
    private $previousHash;
    private $length;
    private $data;
    private $timeStamp;

    public function __construct()
    {
        $this->timeStamp = time();
    }

    /**
     * @return mixed
     */
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    /**
     * @param mixed $timeStamp
     */
    public function setTimeStamp($timeStamp)
    {
        $this->timeStamp = $timeStamp;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param mixed $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return mixed
     */
    public function getPreviousHash()
    {
        return $this->previousHash;
    }

    /**
     * @param mixed $previousHash
     */
    public function setPreviousHash($previousHash)
    {
        $this->previousHash = $previousHash;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->length = strlen($data);
        $this->data = $data;
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
        $vars = get_object_vars($this);
        return $vars;
    }
}