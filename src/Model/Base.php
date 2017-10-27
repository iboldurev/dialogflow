<?php

namespace DialogFlow\Model;

/**
 * Class Base
 *
 * @package DialogFlow\Model
 */
class Base implements \JsonSerializable
{
    /**
     * @var array
     */
    private $data;

    /**
     * Base constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->data;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * @param string $name
     * @param mixed $default
     *
     * @return mixed
     */
    public function get($name, $default = null)
    {
        return $this->getField($name, $default);
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function add($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param string $name
     */
    public function remove($name)
    {
        unset($this->data[$name]);
    }

    /**
     * @param string $name
     * @param mixed $default
     *
     * @return mixed
     */
    private function getField($name, $default = null)
    {
        return $this->has($name) ? $this->data[$name] : $default;
    }

}
