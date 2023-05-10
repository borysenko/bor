<?php
namespace validator;

use bor\DB;
use bor\Validator;
use entity\User;
use Rakit\Validation\Rule;

Class LoginValidator extends Validator
{

    public function __construct(array $messages = [])
    {
        parent::__construct($messages);
        $this->addValidator('validatePassword', new class extends Rule {
            public function check($value) : bool
            {
                if($user = DB::entityManager()->getRepository(User::class)->findOneBy(['username' => input()->post('username')])) {
                    if (password_verify($value, $user->getPassword())) {
                        return true;
                    }
                }
                return false;
            }
        });
    }

    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required|validatePassword',
        ];
    }
}