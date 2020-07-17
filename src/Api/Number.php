<?php

namespace Positus\Api;

use Positus\Response;

class Number
{
    private $client;

    private $numberId;

    public function __construct($client)
    {
        $this->client = $client;

        $this->numberId = $client->getNumberId();
    }

    private function sendRequest($method, $path, $data = [])
    {
        $response = $this->client->getClient()->getHttpClient()->request($method, $path, [
            'json' => $data
        ]);

        return new Response($response);
    }

    public function sendMessage($data)
    {
        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendTemplate($data)
    {
        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendHsm($data)
    {
        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendContacts($data)
    {
        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendLocation($data)
    {
        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendImage($data)
    {
        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendDocument($data)
    {
        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendVideo($data)
    {
        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendAudio($data)
    {
        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function getMedia($mediaId)
    {
        return $this->sendRequest('GET', sprintf('whatsapp/numbers/%d/media/%s', $this->numberId, $mediaId));
    }
}