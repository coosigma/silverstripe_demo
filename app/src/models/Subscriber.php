<?php

namespace SSDemo\Models;

use SilverStripe\ORM\DataObject;

class Subscriber extends DataObject
{
    private static $table_name = "subscribers";
    private static $singular_name = "Subscriber";
    private static $plural_name = "Subscribers";

    private static $db = [
        'Name' => 'Varchar',
        'Company' => 'Varchar',
        'Email' => 'Varchar',
    ];

    public function validate()
    {
        $result = parent::validate();

        if (!($this->validateName($this->Name) && $this->validateName($this->Company) && $this->validateEmail($this->Email))) {
            $result->addError(
                sprintf("Properties are not valid!\nName: %s\n Company: %s\n Email: %s", $this->Name, $this->Company, $this->Email)
            );
        }

        return $result;
    }

    private function validateName($name)
    {
        $re = '/\w+/';
        return preg_match($re, $name);
    }
    private function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
