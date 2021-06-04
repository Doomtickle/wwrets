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
        $temp = [];
        $rets = new Rets();
        $request = Craft::$app->getRequest();
        $resource = $request->getParam('resource');
        $class = $request->getParam('class');
        $query = $request->getParam('query') ?? 'L_ListingID=0+';

        if (! $resource || ! $class) {
            throw new \ErrorException('Missing appropriate query params (resource, class)');
        }

        $results = $rets->login()->find($resource, $class, '(LM_Char10_2=RPLNT, GWS, RLAND),(L_TYPE_=0, 1, 2),(L_StatusCatID=1)', [
            'QueryType' => 'DMQL2',
            'Count' => 1, // count and records
            'Format' => 'COMPACT-DECODED',
            'Limit' => 99999,
            'Select' => 'L_ListingID,L_Type_,L_AddressNumber,L_AddressStreet,L_StatusID'
        ]);

        Craft::dd($results->getTotalResultsCount());
    }
}
