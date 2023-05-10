<?php
namespace bor;

use entity\User;
use Josantonius\Session\Facades\Session;

Class Auth
{
    static public function login(User $user) : void
    {
        $auth = [
            'user_id' => $user->getId(),
            'token' => $user->getToken()
        ];

        Session::set('auth', $auth);
    }

    static public function logout() : void
    {
        Session::remove('auth');
    }

    static public function identity() : object|null
    {
        if(Session::has('auth')) {
            $auth = Session::get('auth');
            $user = DB::entityManager()->getRepository(User::class)->find($auth['user_id']);
            if($user->getToken() != $auth['token'])
            {
                throw new \ErrorException('User token is invalid');
            }
            return $user;
        }

        return null;
    }
}