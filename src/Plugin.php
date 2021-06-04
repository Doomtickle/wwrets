<?php

namespace wrayward\wwrets;

use wrayward\wwrets\services\Rets;

class Plugin extends \craft\base\Plugin
{
    public static $wwrets;

    public function init()
    {
        parent::init();

        $this->controllerNamespace = 'wrayward\wwrets\controllers';

        $this->setComponents([
            'wwrets' => Rets::class,
        ]);

        self::$wwrets = $this->get('wwrets');
    }
}
