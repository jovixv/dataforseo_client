<?php

require_once '../../../vendor/autoload.php';

use DFSClient\DFSClient;
use DFSClient\Models\RankTrackerApi\SettingRankTasks;

$DFSClient = new DFSClient();
$model     = new SettingRankTasks();


//------------------ EXAMPLE IF YOU WANT ADD A FEW TASKS TO ONE REQUEST. -------------------------------------
echo 'EXAMPLE FOR A FEW TASKS IN ONE REQUEST <br/>';

$pool = [];
for($i=0; $i<3; $i++){
    $pool[] = $model::setOpt('priority', 1)
        ->setOpt('site','dataforseo.com')
        ->setOpt('se_id', 22)
        ->setOpt('loc_id',1006886 )
        ->setOpt('key_id', 62845222)
        ->setPostId(mt_rand(4000, 5546456)+$i);
}

$completed = SettingRankTasks::getAfterMerge($pool);

if (!$completed->isSuccessful())
    dd($completed);

// you can call property as described below
echo 'status: '       .$completed->status        ."<br>";
echo 'results_time: ' .$completed->results_time  ."<br>";
echo 'results_count: '.$completed->results_count ."<br>";


foreach ($completed as $key=>$item){
    dump($item);
}



//---------------------------EXAMPLE IF YOU WANT SEND SINGLE TASK-----------------------------------------------
echo 'SINGLE TASK<br/>';

$completed = $model->setOpt('priority', 1)
    ->setOpt('site','ranksonick.com')
    ->setOpt('se_name', 'google.co.uk')
    ->setOpt('se_language','English' )
    ->setOpt('loc_name_canonical', 'London,England,United Kingdom')
    ->setOpt('key',mb_convert_encoding("get first place in google", "UTF-8") )
    ->get();

if (!$completed->isSuccessful())
    dd($completed);

foreach ($completed as $key=>$item){
    dump($item);
}