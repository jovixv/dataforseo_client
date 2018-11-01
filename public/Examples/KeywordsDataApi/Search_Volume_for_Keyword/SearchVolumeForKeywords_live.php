<?php
require_once '../../../../vendor/autoload.php';

use DFSClient\DFSClient;
$DFSClient = new DFSClient();


$model = $DFSClient->kwrd_sv; // kwrd_sv  - is model, we do request to this apiPoint;

// it is request to api, when you write SETOPT working "magic method __call", also method get will return Iterable object "ResponseCollection"
// method get() will be run request
$completed = $model::setOpt('key','call of duty')
    ->setOpt('loc_name_canonical','United States')
    ->setOpt('language', 'en')
    ->get();

if (!$completed->isSuccessful())
    dd($completed);


// you can call property as described below
echo 'status: '       .$completed->status        ."<br>";
echo 'task_id: '      .$completed->task_id       ."<br>";
echo 'results_time: ' .$completed->results_time  ."<br>";
echo 'results_count: '.$completed->results_count ."<br>";

foreach($completed as $key=>$result){
    dump($result);
}

/**------------------ DON'T USE GET() METHOD IF YOU USE getAfterMerge() or getAsync() ----------------------------------\
 * This is an example of how to access the data.                                                                        |                                                                   |
 * If you would like to get several keywords per single request, the process is similar to getting elements with postID.|
*----------------------------------------------------------------------------------------------------------------------*/

// you can setPostId() for each pool, but it is not required for all apiPoint
for($i=0; $i < 3; $i++){
  $pool[] = $model::setOpt('key', 'seo '.$i)
     ->setOpt('loc_name_canonical','United States')
     ->setOpt('language', 'en');
     //->setPostId($i)
}

$completed = $model::getAfterMerge($pool); // this method handle your pool, and do request.

if (!$completed->isSuccessful())
    dd($completed);


// you can call property as described below
echo 'status: '       .$completed->status        ."<br>";
echo 'task_id: '      .$completed->task_id       ."<br>";
echo 'results_time: ' .$completed->results_time  ."<br>";
echo 'results_count: '.$completed->results_count ."<br>";


foreach($completed as $k=>$v){
   dump($v);
}
