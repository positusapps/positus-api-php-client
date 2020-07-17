## Requirements

- PHP 7.4+

## Installing

Use Composer to install it:

````
composer require positus/positus-api-php-client
````
If you use Laravel, we provide a [wrapper](https://github.com/positusapps/positus-api-laravel-client).

## Instantiating

````php
use Positus\Client;

$client = new Client();
````

## Authentication

If you don't have an authentication token, [click here](https://studio.posit.us/minha-conta/api-tokens) to generate one.

````php
$client = new Client();

$client->setToken('you-api-token');
````

## Sending Messages

The first step to be able to send messages is to specify the ID number of origin:

````php
$number = $client->number('your-number-id');
````

Then send the message and wait for a response.

If you want to test a Sandbox you can pass a second argument when calling the number method as `true`:

````php
$number = $client->number('sandbox-number-id', true);
````

If you want to send a message using data on your own, you can use:

````php
$response = $number->sendData([
    'to' => '+5511999999999',
    'type' => 'text',
    'text' => [
        'body' => 'Hi!'
    ]
]);
````

To check all the data that can be sent in each type of message, check the [WhatsApp Business documentation](https://developers.facebook.com/docs/whatsapp/api/messages).

If you prefer, we provide ready methods for each type of message.

### Text

````php
$response = $number->sendText('+5511999999999', 'Your message');
````

### HSM

````php
$response = $number->sendHsm('+5511999999999', 'name-space', 'element-name', 'country-code', ['parameter-a', ...]);
````

Please check the documentation related to hsm in the [WhatsApp Business documentation](https://developers.facebook.com/docs/whatsapp/api/messages/message-templates).

### Contacts

````php
$response = $number->sendContacts('+5511999999999', [
    [
        'name' => [
            "formatted_name" => "John Doe"
        ],
        'phones' => [
            'phone' => '+5511888888888',
            'type' => 'CELL'
        ]
    ]
]);
````

Please check the documentation related to contacts in the [WhatsApp Business documentation](https://developers.facebook.com/docs/whatsapp/api/messages/others#contacts).

### Location

````php
$response = $number->sendLocation('+5511999999999', '-23.553885', '-46.662819', 'Robbu - Atendimento digital inteligente', 'Av. Angélica, 2530 - Bela Vista, São Paulo - SP, 01228-200');
````

### Image

````php
$response = $number->sendImage('+5511999999999', 'https://example.com/image.jpg', 'Random Image');
````

### Document

````php
$response = $number->sendDocument('+5511999999999', 'https://example.com/document.pdf', 'Random Document');
````

### Video

````php
$response = $number->sendVideo('+5511999999999', 'https://example.com/video.mp4', 'Random Video');
````

### Audio

````php
$response = $number->sendAudio('+5511999999999', 'https://example.com/audio.mp3');
````

## Messages Responses

After sending a message, you can check if the message was sent successfully:

````php
if ($response->success()) {
    echo 'Message with Id ' . $response->json()->messages[0]->id . ' sent successfully';
}
````

If everything goes correctly you will receive an answer like this:

````json
{
    "messages": [
        {
            "id": "gBEGVUOWQWWQAgnFOaNl67sTDIE"
        }
    ],
    "message": "The message was successfully sent"
}
````

If something goes wrong, you will receive a message detailing the errors:

````json
{
    "errors": [
        {
            "code": 1008,
            "title": "Required parameter is missing",
            "details": "Parameter 'body' is mandatory for type 'text'"
        }
    ],
    "message": "Unfortunately we were not able to send your message"
}
````

Please check all possible errors that the api may return in the [WhatsApp Business documentation](https://developers.facebook.com/docs/whatsapp/api/errors).

Feel free to create a [pull request](https://github.com/positusapps/positus-api-php-client) or open a [support ticket](https://studio.posit.us/suporte) in Positus Studio if you have or find any problems.

You can check if it failed:

````php
if ($response->error()) {
    echo 'Something went wrong';
}
````

You can get the answer from api as a string:

````php
$response->body();
````

Or if you prefer as JSON:

````php
$response->json();
````