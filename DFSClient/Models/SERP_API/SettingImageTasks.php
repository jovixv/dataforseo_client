<?php

namespace DFSClient\Models\SERP_API;

use DFSClient\Models\AbstractModel;

class SettingImageTasks extends AbstractModel
{
    protected $requestToFunction = 'srp_google_images_tasks_post';
    protected $pathToMainData = 'results';
    protected $method = 'POST';
    protected $isSupportedMerge = true;
}
