<?php

namespace Positus;

use GuzzleHttp\Client as Guzzle;

class HttpClient
{
    private $baseUrl = 'https://api.positus.global/v2/';

    private $defaultHeaders;

    public function __construct()
    {
        $this->defaultHeaders = [
            'Accept' => 'application/json',
        ];
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function setAuthToken($token)
    {
        $this->defaultHeaders['Authorization'] = 'Bearer ' . $token;
    }

    public function getHttpClient()
    {
        return new Guzzle([
            'base_uri' => $this->baseUrl,
            'headers' => $this->defaultHeaders,
            'http_errors' => false
        ]);
    }
}