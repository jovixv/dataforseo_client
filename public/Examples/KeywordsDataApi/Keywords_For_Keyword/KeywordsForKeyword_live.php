<?php

require_once '../../../../vendor/autoload.php';

use DFSClient\DFSClient;
use DFSClient\Models\KeywordsDataApi\Keywords_For_Keyword\KeywordsForKeywordLive;

$DFSClient = new DFSClient();
$model = new KeywordsForKeywordLive();

$completed = $model->setOpt('keys', ['dataforseo'])
    ->setOpt('language', 'en')
    ->setOpt('loc_name_canonical', 'United States')
    ->get();

if (!$completed->isSuccessful()) {
    dd($completed);
}

// you can call property as described below
echo 'status: '.$completed->status.'<br>';
echo 'task_id: '.$completed->task_id.'<br>';
echo 'results_time: '.$completed->results_time.'<br>';
echo 'results_count: '.$completed->results_count.'<br>';

foreach ($completed as $key=>$item) {
    dump($item);
}
