<?php

namespace wrayward\wwrets;

use wrayward\wwrets\services\Rets;

class Plugin extends \craft\base\Plugin
{
    public static $wwrets;

    public function init()
    {
        parent::init();

        $this->setComponents([
            'wwrets' => Rets::class,
        ]);

        self::$wwrets = $this->get('wwrets');
    }

    private function bootstrap()
    {
        $system = $rets->GetSystemMetadata();
        var_dump($system);

        $resources = $system->getResources();
        $classes = $resources->first()->getClasses();
        var_dump($classes);

        $classes = $rets->GetClassesMetadata('Property');
        var_dump($classes->first());

        $objects = $rets->GetObject('Property', 'Photo', '00-1669', '*', 1);
        var_dump($objects);

        $fields = $rets->GetTableMetadata('Property', 'A');
        var_dump($fields[0]);

        $results = $rets->Search('Property', 'A', '*', ['Limit' => 3, 'Select' => 'LIST_1,LIST_105,LIST_15,LIST_22,LIST_87,LIST_133,LIST_134']);
        foreach ($results as $r) {
            var_dump($r);
        }
    }
}
