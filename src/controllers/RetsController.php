<?php

namespace wrayward\wwrets\controllers;

use Craft;
use craft\web\Controller;
use wrayward\wwrets\services\Rets;

class RetsController extends Controller
{
    protected $allowAnonymous = ['search'];

    public function actionSearch()
    {
        $rets = new Rets();
        $request = Craft::$app->getRequest();
        $resource = $request->getParam('resource');
        $class = $request->getParam('class');
        $query = $request->getParam('query') ?? 'L_ListingID=0+';

        if (! $resource || ! $class) {
            throw new \ErrorException('Missing appropriate query params (resource, class)');
        }

        $results = $rets->login()->find($resource, $class, $query);

        Craft::dd($results);
    }
}
