
# Libreria WhatsApp Gupshup PHP



## API Reference

```php
$gupshup = new WhatsappGupshup('SRC_NAME','SOURCE_PHONE','API_KEY');
```

#### Send Text

```php
$gupshup->sendText('573111111111','Texto de prueba');
```

#### Send Image

```php
$gupshup->SendImage('573111111111','https://www.buildquickbots.com/whatsapp/media/sample/jpg/sample01.jpg','Imagen Caption');
```

#### Send List Messages

```php
$globalButtons[] = [
    'type' => 'text',
    'title' => 'Escoger'
];

$items[] = [
    'title' => 'Primera Sección',
    'subtitle' => 'Primer Subtitulo',
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

// Params: $to, $title, $body, $msgid, $globalButtons, $items
$gupshup->sendListMessage('573111111111', 'Title', 'body text', rand(), $globalButtons, $items);
```

#### Send Quick replies

```php
$content = [
    'type'    => 'text',
    'text'    => 'this is body',
    'caption' => 'this is footer'
];

$options = [
    [
        'type'          => 'text',
        'title'         => 'Firts',
        'postbackText'  => 'QR payload'
    ],
    [
        'type'          => 'text',
        'title'         => 'Second',
        'postbackText'  => 'Second payload'
    ],
    [
        'type'          => 'text',
        'title'         => 'Third',
        'postbackText'  => 'Third payload'
    ]
];

$gupshup->sendQuickRepliesText('573111111111', $content, $options);
```

#### Send Quick Replies Image

```php
$content = [
    'type'    => 'image',
    'url'    => 'https://picsum.photos/200/300',
    'caption' => 'body text'
];

$options = [
    [
        'type'          => 'text',
        'title'         => 'Firts',
        'postbackText'  => 'QR payload'
    ],
    [
        'type'          => 'text',
        'title'         => 'Second',
        'postbackText'  => 'Second payload'
    ],
    [
        'type'          => 'text',
        'title'         => 'Third',
        'postbackText'  => 'Third payload'
    ]
];
$gupshup->sendQuickRepliesImage('573111111111', $content, $options);
```

#### Get Template list

```php
$templates = $gupshup->getTemplates();
```

#### Send a message through a template
```php
$params = [
    "Agent",
    "Local Address"
];
$response = $gupshup->sendTemplate('573111111111', 'abcdef-ghijk-lmno-pqrstu', $params);
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
## License

[MIT](https://choosealicense.com/licenses/mit/)

  