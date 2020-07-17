<?php

namespace Positus;

use Positus\Api\Number;

class Client
{
    private $client;

    private $numberId;

    public function __construct()
    {
        $this->client = new HttpClient();
    }

    public function setToken($token) {
        $this->client->setAuthToken($token);
    }

    public function number($numberId, $sandbox = false)
    {
        $this->numberId = $numberId;

        return new Number($this, $sandbox);
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getNumberId()
    {
        return $this->numberId;
    }
}