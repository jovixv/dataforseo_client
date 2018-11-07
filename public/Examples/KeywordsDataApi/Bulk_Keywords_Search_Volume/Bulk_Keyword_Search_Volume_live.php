<?php

require_once '../../../../vendor/autoload.php';

use DFSClient\DFSClient;
use DFSClient\Models\KeywordsDataApi\Bulk_Keyword_Search_Volume\BulkKeywordSearchVolumeLive as BulkSearchVolumeLive;

$DFSClient = new DFSClient();
$model = new BulkSearchVolumeLive();

$completed = $model->setOpt('keys', ['Anime', 'big data', 'dataforseo'])
    ->setOpt('language', 'en')
    ->setOpt('loc_name_canonical', 'United States')
    ->get();

if (!$completed->isSuccessFul()) {
    dd($completed);
}

// you can call property as described below
echo 'status: '.$completed->status.'<br>';
echo 'results_time: '.$completed->results_time.'<br>';
echo 'results_count: '.$completed->results_count.'<br>';

foreach ($completed as $key=>$item) {
    dump($item);
}
