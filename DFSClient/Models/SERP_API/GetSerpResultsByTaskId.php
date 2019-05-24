<?php

namespace DFSClient\Models\SERP_API;

use DFSClient\Models\AbstractModel;

class GetSerpResultsByTaskId extends AbstractModel
{
    protected $requestToFunction = 'srp_html_tasks_get';
    protected $pathToMainData = 'results';
    protected $method = 'GET';
    protected $isSupportedMerge = false;
}
