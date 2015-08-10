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

                $this->checkForRequiredFields($fieldKey, $fieldDetails);
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

                if ($type == 'bool')

                switch ($this->$fieldGetter()) {
                    case
                }
            }
        }
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