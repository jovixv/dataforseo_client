<?php

namespace DFSClient\Models;

use DFSClient\Exceptions\ModelException;
use DFSClient\Services\HttpClient\Handlers\Responses;

class ResponseCollection implements \IteratorAggregate, \Countable, \Serializable
{
    public $response;
    public $errorMessage;
    public $errorResponse;

    private $items = [];
    private $isSuccessful = false;
    protected $pathToMainData;

    public function __construct(Responses $response, $pathToMainData = 'results')
    {
        if ($response->getStatus()) {
            $this->response = json_decode($response->getResponse(), null, 512, JSON_BIGINT_AS_STRING);
            $this->isSuccessful = true;
        } else {
            $this->errorResponse = $response->getResponse();
            $this->errorMessage = $response->getErrorMessage();
        }

        $this->pathToMainData = $pathToMainData;
    }

    public function __get($name)
    {
        if (!isset($this->response->{$name})) {
            throw new ModelException('Property not found, you can find all available properties in dd($completed->response); ');
        }
        return $this->response->{$name};
    }

    public function getIterator()
    {
        $this->setItemsFromPath($this->pathToMainData);
        
        if (is_string($this->items))
            return new \ArrayIterator($this->items);
        
        return new \ArrayIterator($this->items);
    }

    /**
     * Get count of main data.
     *
     * @return int
     */
    public function count()
    {
        return iterator_count($this);
    }

    /**
     * TODO.
     */
    public function copy()
    {
        //TODO
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return ($this->count() === 0) ? true : false;
    }

    /**
     * Convert response to array.
     *
     * @return array|ResponseCollection
     */
    public function toArray()
    {
        return iterator_to_array($this);
    }

    /**
     * TODO.
     */
    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    /**
     * TODO.
     */
    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }

    private function setItemsFromPath($path):void
    {
        $paths = explode('->', $path);
        $returned = $this->response;

        foreach ($paths as $key=>$val) {
            if (is_numeric($val) && isset($returned[$val]) && $this->isSuccessful) {
                $returned = $returned[$val];
            } elseif (isset($returned->$val) && $this->isSuccessful) {
                $returned = $returned->$val;
            }
        }
        $this->items = ($this->response) ? $returned : [];
    }

    /**
     * You can use this method for getting status of request.
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->isSuccessful;
    }

    /**
     * @param $newPath
     */
    public function changePathToMainData($newPath)
    {
        $this->pathToMainData = $newPath;
    }
}
