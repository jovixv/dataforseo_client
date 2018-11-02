<?php

require_once '../../../../vendor/autoload.php';

use DFSClient\DFSClient;
use DFSClient\Models\KeywordsDataApi\Keywords_For_Domain\KeywordsForDomainLive;

$DFSClient = new DFSClient();
$model = new KeywordsForDomainLive();

$domain = 'dataforseo.com';
$lang = 'en';
$countryCode = 'us';
$sortBy = 'relevance';

$completed = $model->setExtraToRequestUrl($domain)
    ->setExtraToRequestUrl($countryCode)
    ->setExtraToRequestUrl($lang)
    ->setTimeOut(30)
    ->setExtraToRequestUrl($sortBy)
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
