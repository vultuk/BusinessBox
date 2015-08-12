<?php namespace Vultuk\BusinessBox\Extensions;

/**
 * Magic methods that can be used for any class
 *
 * Class MagicSetter
 * @package Vultuk\BusinessBox\Extensions
 */
trait MagicSetter {

    /**
     * Used to Get and Set any data in the class it extends
     *
     * @param $name
     * @param $arguments
     * @return $this|null
     */
    public function __call($name, $arguments)
    {
        // Check if we are trying a set function
        if (substr($name, 0, 3) == 'set')
        {
            $this->arrayData[substr($name, 3)] = $arguments[0];

            return $this;
        } elseif (substr($name, 0, 3) == 'get') {
            return isset($this->arrayData[substr($name, 3)]) ? $this->arrayData[substr($name, 3)] : null;
        } else {
            throw new \BadMethodCallException('Tried to call method ' . $name . ' which does not exist.');
        }

    }

}