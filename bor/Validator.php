<?php
namespace bor;

use Rakit\Validation\Validation;

Class Validator extends \Rakit\Validation\Validator
{

    public function validate(array $inputs = [], array $rules = [], array $messages = []) : Validation
    {
        $validation = $this->make($_POST + $_FILES, $this->rules());
        $validation->validate();
        return $validation;
    }
}