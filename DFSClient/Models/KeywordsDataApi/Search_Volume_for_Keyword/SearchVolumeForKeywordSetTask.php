<?php

namespace DFSClient\Models\KeywordsDataApi\Search_Volume_for_Keyword;


use DFSClient\Models\AbstractModel;

class SearchVolumeForKeywordSetTask extends AbstractModel
{
    protected $requestToFunction = 'kwrd_sv_tasks_post';
    protected $pathToMainData    = 'results';
    protected $method            = 'POST';
    protected $isSupportedMerge  = true;

}