<?php
namespace validator;

use bor\Validator;

Class SiteValidator extends Validator
{
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required',
        ];
    }
}