<?php

require_once '../../../vendor/autoload.php';

use DFSClient\DFSClient;
use DFSClient\Models\OnPageApi\SettingTasks;


$DFSClient = new DFSClient();
$model     = new SettingTasks();

for($i=0;$i<7;$i++){
    $pool[] = $model::setOpt('site', 'ranksonic.com')->setOpt('crawl_max_pages', 10);
}

$completed = SettingTasks::getAfterMerge($pool);

if (!$completed->isSuccessful())
    dd($completed);

foreach ($completed as $key=>$item){
    dump($item);
}