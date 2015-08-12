<?php namespace Vultuk\BusinessBox\Extensions;

use Guzzle\Service\Exception\ValidationException;

/**
 * Class Validation
 * @package Vultuk\BusinessBox\Extensions
 */
trait Validation {

    /**
     * Method that is ran to complete all required validation
     *
     * @return $this
     */
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

    /**
     * Method to ensure that all fields have been submitted in the correct
     * types
     *
     * @param $fieldKey
     * @param array $fieldDetails
     * @return $this
     */
    protected function checkTypes($fieldKey, array $fieldDetails)
    {
        $fieldGetter = 'get' . $fieldKey;

        foreach ($fieldDetails as $item)
        {
            if (substr($item, 0, 4) == 'type')
            {
                $type = substr($item, 5);

                if (!empty($this->$fieldGetter()) && ($type == 'bool' || $type == 'boolean') && (!is_bool($this->$fieldGetter()) && !in_array($this->$fieldGetter(), ['Yes', 'No'])))
                {
                    throw new \UnexpectedValueException($fieldKey . ' must be a Boolean or Yes / No.');
                }

                if (!empty($this->$fieldGetter()) &&  ($type == 'int' || $type == 'integer') && !is_integer($this->$fieldGetter()) )
                {
                    throw new \UnexpectedValueException($fieldKey . ' must be an integer.');
                }

                if (!empty($this->$fieldGetter()) &&  ($type == 'str' || $type == 'string') && !is_string($this->$fieldGetter()) )
                {
                    throw new \UnexpectedValueException($fieldKey . ' must be a string.');
                }

                if (!empty($this->$fieldGetter()) &&  $type == 'email' && !filter_var($this->$fieldGetter(), FILTER_VALIDATE_EMAIL) )
                {
                    throw new \UnexpectedValueException($fieldKey . ' must be a valid email address.');
                }

            }
        }

        return $this;
    }

    /**
     * Method to check that all required fields have been submitted
     *
     * @param $fieldKey
     * @param array $fieldDetails
     * @return $this
     */
    protected function checkForRequiredFields($fieldKey, array $fieldDetails)
    {
        $fieldGetter = 'get' . $fieldKey;

        if (in_array('required', $fieldDetails) && empty($this->$fieldGetter()))
        {
            throw new ValidationException(
                "Required field '" .$fieldKey."' has not been set."
            );
        }

        return $this;
    }
    
}