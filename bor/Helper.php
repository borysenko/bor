<?php
namespace bor;

use Josantonius\Session\Facades\Session;
use Pecee\SimpleRouter\SimpleRouter;

trait Helper {

    private $url = null;

    public function route(?string $name = null, ?array $getParams = null) : object
    {
        $this->url = SimpleRouter::getUrl($name, null, $getParams);
        return $this;
    }

    public function redirect(string $url = null, int $statusCode = 302) : void
    {
        if($this->url) {
            $url = $this->url;
        }
        header('Location: ' . $url, true, $statusCode);
        die();
    }

    public function errors(object $errors)
    {
        Session::set('errors', $errors);
        return $this;
    }

    public static function hasErrors() : bool
    {
        return Session::has('errors');
    }

    public static function getErrors() : object
    {
        return Session::get('errors');
    }

    public static function removeErrors() : void
    {
        Session::remove('errors');
    }

    public static function post() : void
    {
        Session::set('post', $_POST);
    }

    public static function hasPost() : bool
    {
        return Session::has('post');
    }

    public static function getPost() : array
    {
        return Session::get('post');
    }

    public static function removePost() : void
    {
        Session::remove('post');
    }
}


if (!function_exists('getRandomStringRand')) {
    function getRandomStringRand($length = 32)
    {
        $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $stringLength = strlen($stringSpace);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString = $randomString . $stringSpace[rand(0, $stringLength - 1)];
        }
        return $randomString;
    }
}
