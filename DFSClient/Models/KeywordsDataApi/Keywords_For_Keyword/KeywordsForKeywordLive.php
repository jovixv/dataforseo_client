<?php

namespace DFSClient\Models\KeywordsDataApi\Keywords_For_Keyword;

use DFSClient\Models\AbstractModel;

class KeywordsForKeywordLive extends AbstractModel
{
    protected $requestToFunction = 'kwrd_for_keywords';
    protected $pathToMainData = 'results';
    protected $method = 'POST';
    protected $isSupportedMerge = true;
}
