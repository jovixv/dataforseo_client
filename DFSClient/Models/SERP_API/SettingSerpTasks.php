<?php

namespace DFSClient\Models\SERP_API;

use DFSClient\Models\AbstractModel;

class SettingSerpTasks extends AbstractModel
{
    protected $requestToFunction = 'srp_tasks_post';
    protected $pathToMainData = 'results';
    protected $method = 'POST';
    protected $isSupportedMerge = true;
}
