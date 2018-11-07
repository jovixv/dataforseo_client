<?php

require_once '../../../../vendor/autoload.php';

use DFSClient\DFSClient;
use DFSClient\Models\KeywordsDataApi\Search_Volume_for_Keyword\SearchVolumeForKeywordGetByTaskId as SearchVolumeByTaskId;

$DFSClient = new DFSClient();
$model = new SearchVolumeByTaskId();
$taskId = 182131436;

$completed = $model->setExtraToRequestUrl($taskId)->get();

if (!$completed->isSuccessful()) {
    dd($completed);
}

foreach ($completed as $key=>$item) {
    dump($item);
}
