<?php
namespace bor;

use Pecee\SimpleRouter\SimpleRouter;
use Rakit\Validation\ErrorBag;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;

trait View {

    static $post = [];
    static $dir = '..';

    use Helper;

    static private function content(string $dir = null, string $name = null, string $content = null, array $var_array = []) : string{
        if($dir) {
            self::$dir = $dir;
        }
        $file = self::$dir . '/view/' . $name . '.tpl.php';
        $exists = file_exists($file);

        if ($exists){
            ob_start();
            $errors = new ErrorBag;
            if(self::hasErrors()) {
                $errors = self::getErrors();
                self::removeErrors();
            }

            if(self::hasPost()) {
                self::$post = self::getPost();
                self::removePost();
            }
            $view = new ViewTemplate(self::$post);
            extract($var_array);
            include $file;
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        }
        else {
            return 'could not find template:' . $file;
        }
    }

    public function render(string $name, array $var_array = []) : string
    {
        $content = self::content(name: $name, var_array: $var_array);
        return self::content(name: 'main', content: $content);
    }

    public function renderAjax(string $name, array $var_array = []) : string
    {
        $content = self::content(name: $name, var_array: $var_array);
        return $content;
    }
}

Class ViewTemplate
{
    public array $post;
    public $package;
    public static $title;

    public function __construct($post)
    {
        $this->post = $post;
        $this->package = new Package(new JsonManifestVersionStrategy('../web/js/manifest.json'));
    }

    public function setTitle($value)
    {
        if(!self::$title)
        {
            self::$title = $value;
        }
    }

    public function getTitle()
    {
        return self::$title;
    }

    public function old($key, string $value = null)
    {
        return (!empty($this->post[$key]) ? $this->post[$key] : $value);
    }

    public function url(?string $name = null, $parameters = null, ?array $getParams = null): string
    {
        return SimpleRouter::getUrl($name, $parameters, $getParams);
    }
}