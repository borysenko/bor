<?php
namespace bor;

Class Router extends \Bramus\Router\Router{

    private $pattern;
    static private $uri;

    public function __construct(){
        $this->setBasePath('');
    }

    public function method($method, $pattern, $controller)
    {
        $this->pattern = $pattern;
        $class_action = explode('@', $controller);
        $class = "\controllers\\$class_action[0]";
        $action = $class_action[1];
        $ref = new \ReflectionMethod($class, $action);
        $functionParameters = [];
        foreach($ref->getParameters() as $key => $currentParameter) {
            $functionParameters[$currentParameter->getName()] = null;
        }
        $this->{$method}($pattern, function(...$args) use ($class, $action) {
            $controller = new $class();
            echo call_user_func_array([$controller, $action], $args);
        });

        return $this;
    }

}
