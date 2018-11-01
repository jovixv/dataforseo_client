<?php
require_once '../../../../vendor/autoload.php';

use DFSClient\DFSClient;
use DFSClient\Models\KeywordsDataApi\Keywords_For_Category\KeywordsForCategoryLive;

$DFSClient = new DFSClient();
$model = new KeywordsForCategoryLive();

$completed = $model->setOpt('category_id',13895)
    ->setOpt('loc_name_canonical', 'United States')
    ->setOpt('language', 'en')
    ->setTimeOut(30)
    ->get();

if (!$completed->isSuccessful())
    dd($completed);

// you can call property as described below
echo 'status: '       .$completed->status        ."<br>";
echo 'task_id: '      .$completed->task_id       ."<br>";
echo 'results_time: ' .$completed->results_time  ."<br>";
echo 'results_count: '.$completed->results_count ."<br>";

foreach ($completed as $key=>$item) {
    dump($item);
}