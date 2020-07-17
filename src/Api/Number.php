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

    public function sendData($data)
    {
        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendText($to, $body)
    {
        $data = [
            'to' => $to,
            'type' => 'text',
            'text' => [
                'body' => $body
            ]
        ];

        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendTemplate($data)
    {
        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendHsm($to, $namespace, $elementName, $code, $localizableParams)
    {
        $data = [
            'to' => $to,
            'type' => 'hsm',
            'hsm' => [
                "namespace" => $namespace,
                "element_name" => $elementName,
                "language" => [
                    "code" => $code,
                    "localizable_params" => array_map(function ($param) {
                        return [
                            'default' => $param
                        ];
                    }, $localizableParams)
                ]
            ]
        ];

        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendContacts($to, $contacts)
    {
        $data = [
            'to' => $to,
            'type' => 'contacts',
            'contacts' => $contacts
        ];

        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendLocation($to, $longitude, $latitude, $name, $address)
    {
        $data = [
            'to' => $to,
            'type' => 'location',
            'location' => [
                'longitude' => $longitude,
                'latitude' => $latitude,
                'name' => $name,
                'address' => $address,
            ]
        ];

        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendImage($to, $link, $caption = null)
    {
        $data = [
            'to' => $to,
            'type' => 'image',
            'image' => [
                'caption' => $caption,
                'link' => $link
            ]
        ];

        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendDocument($to, $link, $caption = null)
    {
        $data = [
            'to' => $to,
            'type' => 'document',
            'document' => [
                'caption' => $caption,
                'link' => $link
            ]
        ];

        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendVideo($to, $link, $caption = null)
    {
        $data = [
            'to' => $to,
            'type' => 'video',
            'video' => [
                'caption' => $caption,
                'link' => $link
            ]
        ];

        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function sendAudio($to, $link)
    {
        $data = [
            'to' => $to,
            'type' => 'audio',
            'audio' => [
                'link' => $link
            ]
        ];

        return $this->sendRequest('POST', sprintf('whatsapp/numbers/%d/messages', $this->numberId), $data);
    }

    public function getMedia($mediaId)
    {
        return $this->sendRequest('GET', sprintf('whatsapp/numbers/%d/media/%s', $this->numberId, $mediaId));
    }
}