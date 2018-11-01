<?php

require_once '../../../../vendor/autoload.php';

use DFSClient\DFSClient;
use DFSClient\Models\KeywordsFinderApi\Related_Keywords\RelatedKeywords;

$DFSClient = new DFSClient();
$model     = new RelatedKeywords();

$completed  = $model->setOpt('keyword','big data')
    ->setOpt('language', 'en')
    ->setOpt('country_code', 'US')
    ->setOpt('depth', 2)
    ->get();


if (!$completed->isSuccessFul())
    dd($completed);

//dd($completed); // - This method can be used to get a list of all available parameters in the form of an object.The data is serialized and similar to the response of DFS API.

// you can call property as described below
echo 'status: '       .$completed->status        ."<br>";
echo 'results_time: ' .$completed->results_time  ."<br>";
echo 'results_count: '.$completed->results_count ."<br>";

foreach ($completed as $key=>$item) {
    dump($item);
}
