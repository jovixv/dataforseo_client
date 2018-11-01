<?php

 return [

     'DATAFORSEO_LOGIN'       =>'Your Login',
     'DATAFORSEO_PASSWORD'    =>'Your Password',


     'timeoutForEachRequests' => 10,
     'apiVersion'             => '/v2/',
     'url'                    => 'https://api.dataforseo.com',
     'headers'                => ['Content-Type' => 'application/json', 'Connection' => 'close','Accept-Encoding'=>'gzip', 'User-Agent'=>'DFSClient (gzip)'],

     //schema for payload
     'payloadData'=>[ // keys: payloadData and json are required for script. "data" need for DFSApi
         'json'=>[
             'data'=> [
                 [
                    // data
                 ]
             ]
         ]
     ],


     // SYSTEM CONFIG



 ];