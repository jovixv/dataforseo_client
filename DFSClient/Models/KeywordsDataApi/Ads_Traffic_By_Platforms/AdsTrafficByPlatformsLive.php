<?php

namespace DFSClient\Models\KeywordsDataApi\Ads_Traffic_By_Platforms;

use DFSClient\Models\AbstractModel;

class AdsTrafficByPlatformsLive extends AbstractModel
{
    protected $requestToFunction = 'kwrd_ad_traffic_by_platforms';
    protected $pathToMainData = 'results';
    protected $method = 'POST';
    protected $isSupportedMerge = false;
}
