<?php

namespace Positus\Api;

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
        return $this->sendRequest('POST', 'whatsapp/numbers/' . $this->numberId . '/messages', $data);
    }

    public function sendTemplate($data)
    {
        return $this->sendRequest('POST', 'whatsapp/numbers/' . $this->numberId . '/messages', $data);
    }

    public function sendHsm($data)
    {
        return $this->sendRequest('POST', 'whatsapp/numbers/' . $this->numberId . '/messages', $data);
    }

    public function sendContacts($data)
    {
        return $this->sendRequest('POST', 'whatsapp/numbers/' . $this->numberId . '/messages', $data);
    }

    public function sendLocation($data)
    {
        return $this->sendRequest('POST', 'whatsapp/numbers/' . $this->numberId . '/messages', $data);
    }

    public function sendImage($data)
    {
        return $this->sendRequest('POST', 'whatsapp/numbers/' . $this->numberId . '/messages', $data);
    }

    public function sendDocument($data)
    {
        return $this->sendRequest('POST', 'whatsapp/numbers/' . $this->numberId . '/messages', $data);
    }

    public function sendVideo($data)
    {
        return $this->sendRequest('POST', 'whatsapp/numbers/' . $this->numberId . '/messages', $data);
    }

    public function sendAudio($data)
    {
        return $this->sendRequest('POST', 'whatsapp/numbers/' . $this->numberId . '/messages', $data);
    }

    public function getMedia($mediaId)
    {
        return $this->sendRequest('GET', 'whatsapp/numbers/' . $this->numberId . '/media/' . $mediaId);
    }
}