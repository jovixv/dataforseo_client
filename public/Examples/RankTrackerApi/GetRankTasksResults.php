<?php

require_once '../../../vendor/autoload.php';

use DFSClient\DFSClient;
use DFSClient\Models\RankTrackerApi\GetRankTasksResults;

$DFSClient = new DFSClient();
$model = new GetRankTasksResults();
$taskId = '2446280222'; // if you use 64-bit system you can set it as int, use constant MAX_INT_VALUE for checking.

//-----------------------------GET ALL RESULTS-----------------------------------------------
$completed = $model->get();

if (!$completed->isSuccessful()) {
    dd($completed);
}

echo 'All RESULTS <br/>';

foreach ($completed as $key=>$item) {
    dump('type:'.$key);
    dump($item);
}

//-----------------------------GET RESULTS BY TASK ID------------------------------------------
$completedByTaskId = $model->setExtraToRequestUrl($taskId)->get(); // get results by id

echo 'RESULTS BY TASK ID: '.$taskId.'<br/>';

foreach ($completedByTaskId as $key=>$item) {
    dump('type:'.$key);
    dump($item);
}
