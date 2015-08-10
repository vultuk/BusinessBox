<?php namespace Vultuk\BusinessBox\Extensions;

trait MagicSetter {

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