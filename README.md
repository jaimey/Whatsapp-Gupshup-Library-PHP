# Libreria WhatsApp Gupshup PHP
- [Libreria WhatsApp Gupshup PHP](#libreria-whatsapp-gupshup-php)
  - [Installation](#installation)
  - [Usage](#usage)
    - [Outbound Message](#outbound-message)
      - [Send Text](#send-text)
      - [Send Image](#send-image)
      - [Send Audio](#send-audio)
      - [Send File](#send-file)
      - [Send Video](#send-video)
      - [Send Sticker](#send-sticker)
      - [Send List Messages](#send-list-messages)
      - [Send Quick replies](#send-quick-replies)
      - [Send Quick Replies Text](#send-quick-replies-text)
      - [Get Template list](#get-template-list)
      - [Send a message through a template](#send-a-message-through-a-template)
      - [Get Opt-in User list](#get-opt-in-user-list)
      - [Mark User Opt-in Opt-out](#mark-user-opt-in-opt-out)
      - [Check Wallet balance](#check-wallet-balance)
    - [Inbound Message and Events](#inbound-message-and-events)
  - [License](#license)
## Installation
You can install the package via composer:
```bash
composer require jaime/whatsapp-gupshup
```
## Usage
### Outbound Message

```php
$gupshup = new OutboundMessage('SRC_NAME', 'SOURCE', 'API_KEY');
```

#### Send Text

```php
$gupshup->setText('Texto de prueba');
$gupshup->send('573111111111');
```

#### Send Image

```php
$url = "https://www.buildquickbots.com/whatsapp/media/sample/jpg/sample01.jpg";
$caption =  "Sample image";

$gupshup->setImage($url, $caption);
$gupshup->send('573111111111');
```

#### Send Audio

```php
$url = "https://www.buildquickbots.com/whatsapp/media/sample/jpg/sample01.jpg";

$gupshup->setAudio($url);
$gupshup->send('573111111111');
```

#### Send File

```php
$url = "https://www.buildquickbots.com/whatsapp/media/sample/pdf/sample01.pdf";
$filename = "Sample funtional resume";

$gupshup->setFile($url, $filename);
$gupshup->send('573111111111');
```

#### Send Video

```php
$url = "https://www.buildquickbots.com/whatsapp/media/sample/video/sample01.mp4";
$caption = "Sample video";

$gupshup->setFile($url, $filename);
$gupshup->send('573111111111');
```

#### Send Sticker

```php
$url = "http://www.buildquickbots.com/whatsapp/stickers/SampleSticker01.webp";

$gupshup->setFile($url, $filename);
$gupshup->send('573111111111');
```

#### Send List Messages

```php
$globalButtons[] = [
    'type' => 'text',
    'title' => 'Escoger'
];

$items[] = [
    'title' => 'first Section',
    'subtitle' => 'first Subtitle',
    'options' => [
        [
            'type' => 'text',
            'title' => 'section 1 row 1',
            'description' => 'first row of 1 section description',
            'postbackText' => 'section 1 row 1 postback payload'
        ],
        [
            'type' => 'text',
            'title' => 'section 1 row 2',
            'description' => 'second row of 2 section description',
            'postbackText' => 'section 1 row 2 postback payload'
        ],
        [
            'type' => 'text',
            'title' => 'section 1 row 3',
            'description' => 'second row of 3 section description',
            'postbackText' => 'section 1 row 3 postback payload'
        ]
    ]
];

$items[] = [
    'title' => 'Segunda Sección',
    'subtitle' => 'Segundo Subtitulo',
    'options' => [
        [
            'type' => 'text',
            'title' => 'section 2 row 1',
            'description' => 'first row of 1 section description',
            'postbackText' => 'section 1 row 1 postback payload'
        ],
        [
            'type' => 'text',
            'title' => 'section 2 row 2',
            'description' => 'second row of 2 section description',
            'postbackText' => 'section 1 row 2 postback payload'
        ],
        [
            'type' => 'text',
            'title' => 'section 2 row 3',
            'description' => 'second row of 3 section description',
            'postbackText' => 'section 1 row 3 postback payload'
        ]
    ]
];

// Params: $title, $body, $msgid, $globalButtons, $items
$gupshup->setListMessage('title text', 'body text', rand(), $globalButtons, $items);
$gupshup->sendRequest("57311111111");
```

#### Send Quick replies

```php
$content = [
    'type' => 'text',
    'header' => 'this is the header',
    'text' => 'this is the body',
    'caption' => 'this is the footer'
];

$options = [
    [
        'type'          => 'text',
        'title'         => 'Firts',
    ],
    [
        'type'          => 'text',
        'title'         => 'Second',
    ],
    [
        'type'          => 'text',
        'title'         => 'Third',
    ]
];

$msgid = rand();
$gupshup->setQuickRepliesText($msgid, $content, $options);
$gupshup->sendRequest("57311111111");
```

#### Send Quick Replies Text

```php
$content = [
    'type' => 'text',
    'header' => 'this is the header',
    'text' => 'this is the body',
    'caption' => 'this is the footer'
];

$options = [
    [
        'type'          => 'text',
        'title'         => 'Firts',
    ],
    [
        'type'          => 'text',
        'title'         => 'Second',
    ],
    [
        'type'          => 'text',
        'title'         => 'Third',
    ]
];

$msgid = rand();
$gupshup->setQuickRepliesText($msgid, $content, $options);
$gupshup->sendRequest("57311111111");

```

#### Get Template list

```php
$templates = $gupshup->getTemplates();
```

#### Send a message through a template

```php
$idtemplate = 'aaaaa-bbbbb-ccccc-dddd-eeee';
$templateparams =  [
    "Agent", 
    "Local Address", 
    "Tracking code"
];

$gupshup->setTemplate($idtemplate, $templateparams);
$gupshup->sendTemplate("57311111111");
```

#### Get Opt-in User list

```php
$response = $gupshup->getOptin();
```

#### Mark User Opt-in Opt-out

```php
$response = $gupshup->markOpt('573111111111', 'in');
$response = $gupshup->markOpt('573111111111', 'out');
```

#### Check Wallet balance

```php
$response = $gupshup->getWalletBalance();
```

### Inbound Message and Events

```php
<?php
require('../vendor/autoload.php');

use Jaime\WhatsappGupshup\InboundMessageandEvents;

$log = json_decode(file_get_contents('php://input'), true);

$inboundGupshup = new InboundMessageandEvents($log);

switch ($inboundGupshup->getTypeNotification()) {
    case 'user-event':
    // code ..
    break;
    case 'message-event':
        if ($inboundGupshup->getTypePayload() == 'failed') {
            $logfailed = $inboundGupshup->getReasonFailedMessageEvent();
            // code ..
            file_put_contents('log-failed', '(' . date('Y-m-d H:i:s') . ') ' . print_r($logfailed, true) . PHP_EOL, FILE_APPEND | LOCK_EX);
        }
        break;

    default:
        # code...
        break;
}

http_response_code(200);
```

## License

[MIT](https://choosealicense.com/licenses/mit/)

  
