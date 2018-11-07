<?php

require_once '../../../../vendor/autoload.php';

use DFSClient\DFSClient;
use DFSClient\Models\KeywordsDataApi\Ads_Traffic_For_Keywords\AdsTrafficForKeywordsLive;

$DFSClient = new DFSClient();
$model = new AdsTrafficForKeywordsLive();

$completed = $model->setOpt('language', 'en')
    ->setOpt('loc_name_canonical', 'United States')
    ->setOpt('bid', 100.00)
    ->setOpt('match', 'exact')
    ->setOpt('keys', ['seo', 'seo tools', 'traffic for keywords seo'])
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
