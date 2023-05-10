<?php
namespace bor;

use Josantonius\Session\Facades\Session as BaseSession;

Class Session
{
    static public function start() : void
    {
        BaseSession::start(['cookie_httponly' => true,]);
    }
}