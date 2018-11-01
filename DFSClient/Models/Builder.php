<?php

namespace DFSClient\Models;


use DFSClient\Exceptions\ModelException;

class Builder
{

    public $args    = [];

    public $payload;

    public $methods = [];


    public function __construct()
    {
        $this->payload = $GLOBALS['DFSClient']->app->config['payloadData'];
    }

    /**
     * @param $arg
     * @return $this
     */
    public function where($arg){


       return $this;
    }

    /**
     * @param $arg
     * @return $this
     * @throws \Exception
     */
    public function setOpt($arg){

        list($field,$value) = $arg;
        if (!isset($field) OR !is_string($field))
            throw new ModelException('setOpt can\'t be empty OR Field must be a string, if you need to set post id, you must use postId method');


        if (is_array($value) or is_string($value) or is_numeric($value))
            $this->payload['json']['data'][0][$field] = $value;

       return $this;
    }


    /**
     * Will return payload data for request
     *
     * @return mixed
     */
    public function getPayload(){
        return $this->payload;
    }

    public function generateNewQuery(){
        // TODO:
    }

}
