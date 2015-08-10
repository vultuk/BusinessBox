<?php namespace Vultuk\BusinessBox\Extensions;

use Guzzle\Service\Exception\ValidationException;

trait Validation {

    protected function validate()
    {

        if (!empty($this->fields))
        {
            foreach ($this->fields as $fieldKey => $fieldDetails)
            {
                $fieldDetails = explode('|', $fieldDetails);

                $this->checkForRequiredFields($fieldKey, $fieldDetails)
                    ->checkTypes($fieldKey, $fieldDetails);
            }
        }

        return $this;
    }

    protected function checkTypes($fieldKey, array $fieldDetails)
    {
        $fieldGetter = 'get' . $fieldKey;

        foreach ($fieldDetails as $item)
        {
            if (substr($item, 0, 4) == 'type')
            {
                $type = substr($item, 5);

                if (($type == 'bool' || $type == 'boolean') && (!is_bool($this->$fieldGetter()) || !in_array($this->$fieldGetter(), ['Yes', 'No'])))
                {
                    throw new \UnexpectedValueException($fieldKey . ' must be a Boolean or Yes / No.');
                }

                if ( ($type == 'int' || $type == 'integer') && !is_integer($this->$fieldGetter()) )
                {
                    throw new \UnexpectedValueException($fieldKey . ' must be an integer.');
                }

                if ( ($type == 'str' || $type == 'string') && !is_string($this->$fieldGetter()) )
                {
                    throw new \UnexpectedValueException($fieldKey . ' must be a string.');
                }

                if ( $type == 'email' && !filter_var($this->$fieldGetter(), FILTER_VALIDATE_EMAIL) )
                {
                    throw new \UnexpectedValueException($fieldKey . ' must be a valid email address.');
                }

            }
        }

        return $this;
    }

    protected function checkForRequiredFields($fieldKey, array $fieldDetails)
    {
        $fieldGetter = 'get' . $fieldKey;

        if (in_array('required', $fieldDetails) && empty($this->$fieldGetter()))
        {
            throw new ValidationException(
                "Required field '". end(explode('\\', get_class($this))) . ':' .$fieldKey."' has not been set."
            );
        }

        return $this;
    }
    
}