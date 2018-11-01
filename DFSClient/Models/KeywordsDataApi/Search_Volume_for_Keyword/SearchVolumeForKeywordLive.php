<?php

namespace DFSClient\Models\KeywordsDataApi\Search_Volume_for_Keyword;


use DFSClient\Models\AbstractModel;

class SearchVolumeForKeywordLive extends AbstractModel
{
    protected $requestToFunction = 'kwrd_sv';
    protected $pathToMainData    = 'results';
    protected $method            = 'POST';
    protected $isSupportedMerge  = true;


    public function test(){
        //TODO
    }
}