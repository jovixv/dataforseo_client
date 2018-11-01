<?php
require_once '../../../../vendor/autoload.php';

use DFSClient\DFSClient;
use DFSClient\Models\KeywordsDataApi\Search_Volume_for_Keyword\SearchVolumeForKeywordGetCompletedTask as SVCompletedTask;


$DFSClient = new DFSClient(); // init DFSClient, at now it is required.
$model     = new SVCompletedTask(); // init model;
$completed = $model->get();

if (!$completed->isSuccessful())
    dd($completed);


// you can call property as described below
echo 'status: '       .$completed->status        ."<br>";
echo 'results_time: ' .$completed->results_time  ."<br>";
echo 'results_count: '.$completed->results_count ."<br>";

foreach ($completed as $key=>$item ){
    dump($item);
}