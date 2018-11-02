<?php

require_once '../../../../vendor/autoload.php';

use DFSClient\DFSClient;

$DFSClient = new DFSClient();

$model = $DFSClient->kwrd_sv_tasks_post; // kwrd_sv_tasks_post - is namespace to model, and we do request to this apiPoint;

// it is request to api, when you run SETOPT working "magic method __call", also method get will return Iterable object "ResponseCollection"
// method get() will be run request
$completed = $model::setOpt('key', 'seo')
    ->setOpt('loc_name_canonical', 'United States')
    ->setOpt('language', 'en')
    ->setPostId(35)
    ->get();

if (!$completed->isSuccessful()) {
    dd($completed);
}

foreach ($completed as $key=>$result) {
    dump($result);
}

/**------------------ DON'T USE GET() METHOD IF YOU USE getAfterMerge() or getAsync() ----------------------------------\
 * This is an example of how to access the data.                                                                        |                                                                   |
 * If you would like to get several keywords per single request, the process is similar to getting elements with postID.|
 *----------------------------------------------------------------------------------------------------------------------*/

// you can setPostId() for each pool, but it is not required for all apiPoint
for ($i = 0; $i < 3; $i++) {
    $pool[] = $model::setOpt('key', 'seo')
        ->setOpt('loc_name_canonical', 'United States')
        ->setOpt('language', 'en')
        ->setPostId(mt_rand(210000, 3543555));
}

$completed = $model::getAfterMerge($pool); // this method handle your pool, and do request.

if (!$completed->isSuccessful()) {
    dd($completed);
}

foreach ($completed as $k=>$v) {
    dump($v);
}
