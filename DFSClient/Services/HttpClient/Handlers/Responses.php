<?php

namespace DFSClient\Services\HttpClient\Handlers;


class Responses
{

    private $status;

    private $response;

    private $errorMessage;

    private $headers;


    public function __construct($status, $errorMessage = null, $response = null, $headers = null)
    {
        $this->status       = $status;
        $this->errorMessage = $errorMessage;
        $this->response     = $response;
        $this->headers      = $headers;
    }


    /*
     * getters for response
     */
    public function getResponse(){
        return $this->response;
    }

    /*
     * getters for status
     */
    public function getStatus(){
        return $this->status;
    }

    /*
     * getters for message
     */
    public function getErrorMessage(){
        return $this->errorMessage;
    }

    /*
     * getters for headers
     */
    public function getHeaders(){
        return $this->headers;
    }




}
