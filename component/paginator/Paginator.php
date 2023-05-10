<?php
namespace component\paginator;

use bor\View;

Class Paginator{

    use View;

    public static function Links($paginator)
    {
        return self::content(__DIR__,  'links', null, ['paginator' => $paginator]);
    }
}
