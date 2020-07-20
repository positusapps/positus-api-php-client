<?php

namespace Positus\Api;

use Positus\Response;

class Number
{
    private $client;

    private $numberId;

    private $sandbox;

    public function __construct($client, $sandbox)
    {
        $this->client = $client;

        $this->sandbox = $sandbox;

        $this->numberId = $client->getNumberId();
    }

    private function sendRequest($method, $path, $data = [])
    {
        $response = $this->client->getClient()->getHttpClient()->request($method, $path, [
            'json' => $data
        ]);

        return new Response($response);
    }

    private function resolveMessagePath()
    {
        $path = sprintf('whatsapp/numbers/%s/messages', $this->numberId);

        if ($this->sandbox) {
            return 'sandbox/' . $path;
        }

        return $path;
    }

    private function resolveMediaPath($mediaId)
    {
        $path = sprintf('whatsapp/numbers/%s/media/%s', $this->numberId, $mediaId);

        if ($this->sandbox) {
            return 'sandbox/' . $path;
        }

        return $path;
    }

    public function sendData($data)
    {
        return $this->sendRequest('POST', $this->resolveMessagePath(), $data);
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

        return $this->sendRequest('POST', $this->resolveMessagePath(), $data);
    }

    public function sendTemplate($to, $namespace, $name, $languageCode, $components = [])
    {
        $data = [
            'to' => $to,
            'type' => 'template',
            'template' => [
                "namespace" => $namespace,
                "name" => $name,
                "language" => [
                    "code" => $languageCode
                ],
                "components" => $components
            ]
        ];

        return $this->sendRequest('POST', $this->resolveMessagePath(), $data);
    }

    public function sendHsm($to, $namespace, $elementName, $languageCode, $localizableParams = [])
    {
        $data = [
            'to' => $to,
            'type' => 'hsm',
            'hsm' => [
                "namespace" => $namespace,
                "element_name" => $elementName,
                "language" => [
                    "code" => $languageCode
                ],
                "localizable_params" => array_map(function ($param) {
                    return [
                        'default' => $param
                    ];
                }, $localizableParams)
            ]
        ];

        return $this->sendRequest('POST', $this->resolveMessagePath(), $data);
    }

    public function sendContacts($to, $contacts)
    {
        $data = [
            'to' => $to,
            'type' => 'contacts',
            'contacts' => $contacts
        ];

        return $this->sendRequest('POST', $this->resolveMessagePath(), $data);
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

        return $this->sendRequest('POST', $this->resolveMessagePath(), $data);
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

        return $this->sendRequest('POST', $this->resolveMessagePath(), $data);
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

        return $this->sendRequest('POST', $this->resolveMessagePath(), $data);
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

        return $this->sendRequest('POST', $this->resolveMessagePath(), $data);
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

        return $this->sendRequest('POST', $this->resolveMessagePath(), $data);
    }

    public function getMedia($mediaId)
    {
        return $this->sendRequest('GET', $this->resolveMediaPath($mediaId));
    }
}