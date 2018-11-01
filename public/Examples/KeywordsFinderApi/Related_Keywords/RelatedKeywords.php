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

dd($completed);
// you can call property as described below
echo 'status: '       .$completed->status        ."<br>";
echo 'results_time: ' .$completed->results_time  ."<br>";
echo 'results_count: '.$completed->results_count ."<br>";

foreach ($completed as $key=>$item) {
    dump($item);
}