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
        return $this->response->getStatusCode() >= 200 && $this->response->getStatusCode() < 300;
    }

    public function error()
    {
        return $this->response->getStatusCode() >= 400;
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