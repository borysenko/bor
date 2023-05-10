<?php
namespace bor;

Class Controller {

    use View;
    use Helper;

    public function __construct()
    {
        if(!empty($_POST))
        {
            self::post();
        }
    }

}
