<?php

namespace DFSClient\Models;


class RankedKeywordFinder extends AbstractModel
{
    protected $requestToFunction = 'kwrd_for_keywords';
    protected $pathToMainData    = 'results';
    protected $method            = 'POST';

    protected function test (){
        //
    }
}