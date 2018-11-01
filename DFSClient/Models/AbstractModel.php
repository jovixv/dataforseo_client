<?php


namespace DFSClient\Models;

use DFSClient\Exceptions\ModelException;
use DFSClient\Models\Builder;
use MongoDB\Driver\Query;
use DFSClient\Services\HttpClient\HttpClient;

/**
 * @method boolean isSuccessful():void
 * @method  $this setOpt(string $field, mixed $param )
 * @see ResponseCollection
 * @see Builder
 */


abstract class AbstractModel
{

    private static $instance = null;

    /**
     * @var int $timeOut | timeout for request;
     */
    protected $timeOut      = null;

    /**
     * @var \DFSClient\Models\Builder  $queryBuilder | builder for creating payload
     */
    public  $queryBuilder = null;

    /**
     * @var string $apiVersion | apiVersion
     */
    protected $apiVersion   = null;

    /**
     * @var string $url | url to DataForSeo API
     */
    protected $url          = null;

    /**
     * @var int|null $postId PostId need for some request, for more information look to example or to DFSApi
     */
    protected $postId      = null;

    /**
     * @var null $statusCode At now this field not working
     */
    public $statusCode;

    /**
     * @var null $statusMessage At now this field not working
     */
    public $statusMessage;


    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var null $requiredField At now this field not working
     */
    protected $requiredField;

    /**
     * @var null $requiredField At now this field not working
     */
    protected $mainData;

    /**
     * @var static $requestType RequestType, this param will be sent to DFS API, .xml, .gzip etc...
     */
    protected $requestType;

    /**
     * @var string $method Method for http request. POST, GET , PUT, DELETE
     */
    protected $method;

    /**
     * This variable is required for all extended Class from AbstractModel
     *
     * @var null|string $requestToFunction It is name, when you want send request to api, use this param as api point, example: cmn_user
     */
    protected $requestToFunction = null;

    /**
     * This variable is required for all extended Class from AbstractModel
     * example for path: results->0->related
     *
     * results - is object link from DFSResponse
     * 0       - is Index of array
     * related - is object link containing main data
     *
     * @var null|string $pathToMainData It is system variable, it is contain path to main data from response and create iterable(IteratorAggregator) response.
     */
    protected $pathToMainData     = null;

    /**
     * @var bool $isSupportedMerge If request is support postId
     */
    protected $isSupportedMerge = false;

    /**
     * @var null|string
     */
    private $DFSLogin    = null;
    /**
     * @var null|string
     */
    private $DFSPassword = null;

    /**
     * @var null|ResponseCollection $response
     */
    public $response;


    public function __construct()
    {
        $this->headers = $GLOBALS['DFSClient']->app->config['headers'];
        $this->queryBuilder = new Builder();
    }

    /**
     * Forwarding from static context to object context
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
       // can be bug with array $arguments or something else
        return (new static())->$method($arguments);
    }

    /**
     *
     * @param $method
     * @param $arguments
     * @return $this
     */
    public function __call($method, $arguments)
    {
        // bug with $arguments
        if (is_array($arguments[0]))
            $arguments = $arguments[0];

        $builder = ($this->queryBuilder) ? $this->queryBuilder : new Builder();

        $builder->$method($arguments);

        $this->queryBuilder = $builder;

        return $this;
    }

    /**
     * This method will run request to api
     *
     * @return ResponseCollection]
     */
     public function get():ResponseCollection{

        $http           = new HttpClient($this->url, $this->apiVersion, $this->timeOut, $this->DFSLogin, $this->DFSPassword);
        $arr            = $this->queryBuilder->getPayload();
        $arr['headers'] = $this->headers;

        if (!isset($GLOBALS['DFSClient']))
            dd('DFSClient was not init, add to your code: $DFSClient = new DFSClient() ');

        if (!$this->requestToFunction )
            dd('requestFunction can not be null, set this field in your model: '.get_called_class());

        if ($this->postId !== null){
            $arr['json']['data'][$this->postId] = $arr['json']['data'][0];
            unset($arr['json']['data'][0]);
        }

        $res = $http->sendSingleRequest($this->method, $this->requestToFunction, $arr );
        return new ResponseCollection($res, $this->pathToMainData);
     }


    /**
     * Array contain this objects
     *
     * @param iterable $pool
     */
     public static function getAfterMerge(iterable $pool):ResponseCollection{

         $finishedPayload['json']['data'] =[];
         $header          =[];
         $url             = null;
         $apiVersion      = null;
         $timeOut         = null;
         $DFSLogin        = null;
         $DFSPassword     = null;
         $requestFunction = null;

         foreach ($pool as $key=>$val ){
          if (!$val->isSupportedMerge)
              throw new ModelException('This model does not supported merge, supported model must has post id ');

             $payLoad           = $val->queryBuilder->getPayload();
             $header            = $val->headers;
             $url               = $val->url;
             $apiVersion        = $val->apiVersion;
             $timeOut           = $val->timeOut;
             $DFSLogin          = $val->DFSLogin;
             $DFSPassword       = $val->DFSPassword;
             $requestToFunction = $val->requestToFunction;
             $method            = $val->method;
             $pathToMainData    = $val->pathToMainData;

             if ($val->postId === null){
                 $finishedPayload['json']['data'][] = $payLoad['json']['data'][0];
             }else{
                 $finishedPayload['json']['data'][$val->postId] = $payLoad['json']['data'][0];
             }
         }
        $finishedPayload['headers'] = $header;

         $http           = new HttpClient($url, $apiVersion, $timeOut, $DFSLogin, $DFSPassword);
         $arr            = &$finishedPayload;

         if (!$requestToFunction )
             throw new ModelException('requestFunction can not be null, set this field in your model: '.get_called_class());

         $res = $http->sendSingleRequest($method, $requestToFunction, $arr );
         return new ResponseCollection($res, $pathToMainData);
     }

     /*----------------------------------------------------------|
      | Mutator's : it need for building custom's request to API |
      |                                                          |
     *-----------------------------------------------------------/

    /**
     * This function rewrite default method for request (POST, GET, etc)
     *
     * @param $newMethod
     */
     public function setMethod($newMethod){
         $this->method = $newMethod;

         return $this;
     }

    /**
     *  This function rewrite default timeout from config for request (default 10 - config.php)
     *
     * @param $newTimeout
     */
     public function setTimeOut($newTimeout){
         $this->timeOut = $newTimeout;

         return $this;
     }


     public function setUrl($newUrl){
         $this->url = $newUrl;

         return $this;
     }

     public function setApiVersion($newVersion){
         $this->apiVersion = $newVersion;
         return $this;
     }

    /**
     * @param null $requestToFunction
     */
    public function setRequestToFunction($newRequestToFunction)
    {
        $this->requestToFunction = $newRequestToFunction;
        return $this;
    }

    public function setPathToMainData($newPath){
        $this->pathToMainData = $newPath;

        return $this;
    }

    public function setDFSLogin($newLogin){
        $this->DFSLogin = $newLogin;

        return $this;
    }

    public function setDFSPassword($newPassword){
        $this->DFSPassword = $newPassword;

        return $this;
    }

    public function setExtraToRequestUrl($extra){
        $this->requestToFunction = $this->requestToFunction.'/'.$extra;

        return $this;
    }

    public function setPostId($id){
        $this->postId = $id;
        return $this;
    }


}