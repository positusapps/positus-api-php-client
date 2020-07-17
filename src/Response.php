<?php

namespace Positus;

class Response
{
    private $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function success()
    {
        // Check if sucess
    }

    public function error()
    {
        // Check if error
    }

    public function body()
    {
        return $this->response->getBody();
    }

    public function json()
    {
        return json_decode($this->response->getBody());
    }
}