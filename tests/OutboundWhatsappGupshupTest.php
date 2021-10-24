<?php

use PHPUnit\Framework\TestCase;
use Jaime\WhatsappGupshup\OutboundMessage;

class OutboundMessageTest extends TestCase
{
    public $gupshup;

    public function setUp(): void
    {
        $this->gupshup  = new OutboundMessage('SRC_NAME', 'SOURCE', 'API_KEY');
    }

    /** @test */
    public function SetText()
    {
        $text = "Hi John, how are you?";
        $this->gupshup->setText($text);

        $msg = [
            'type' => 'text',
            'text' => $text
        ];

        $this->assertEquals($msg, $this->gupshup->getMsg());
    }

    /** @test */
    public function SetImage()
    {
        $url = "https://www.buildquickbots.com/whatsapp/media/sample/jpg/sample01.jpg";
        $caption =  "Sample image";

        $this->gupshup->setImage($url, $caption);

        $msg = [
            "type" => "image",
            "originalUrl" => $url,
            "previewUrl" => $url,
            "caption" => $caption
        ];

        $this->assertEquals($msg, $this->gupshup->getMsg());
    }

    /** @test */
    public function SetAudio()
    {

        $msg = [
            "type" => "audio",
            "url" => "https://www.buildquickbots.com/whatsapp/media/sample/audio/sample01.mp3"
        ];
        $this->gupshup->setAudio($msg['url']);

        $this->assertEquals($msg, $this->gupshup->getMsg());
    }

    /** @test */
    public function SetFile()
    {
        $msg = [
            "type" => "file",
            "url" => "https://www.buildquickbots.com/whatsapp/media/sample/pdf/sample01.pdf",
            "filename" => "Sample funtional resume"
        ];

        $this->gupshup->setFile($msg['url'], $msg['filename']);

        $this->assertEquals($msg, $this->gupshup->getMsg());
    }

    /** @test */
    public function SetVideo()
    {
        $msg = [
            "type" => "video",
            "url" => "https://www.buildquickbots.com/whatsapp/media/sample/video/sample01.mp4",
            "caption" => "Sample video"
        ];

        $this->gupshup->setVideo($msg['url'], $msg['caption']);

        $this->assertEquals($msg, $this->gupshup->getMsg());
    }

    /** @test */
    public function SetSticker()
    {
        $msg = [
            "type" => "sticker",
            "url" => "http://www.buildquickbots.com/whatsapp/stickers/SampleSticker01.webp",
        ];

        $this->gupshup->setSticker($msg['url']);

        $this->assertEquals($msg, $this->gupshup->getMsg());
    }

    /** @test */
    public function setListMessage()
    {
        $randomId = rand();

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


        $this->gupshup->setListMessage('title text', 'body text', $randomId, $globalButtons, $items);

        $msg = [
            'type' => 'list',
            'title' => 'title text',
            'body' => 'body text',
            'msgid' => "$randomId",
            'globalButtons' => $globalButtons,
            'items' => $items
        ];

        $this->assertEquals($msg, $this->gupshup->getMsg());
    }

    /** @test */
    public function setQuickRepliesText()
    {
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

        $this->gupshup->setQuickRepliesText($msgid, $content, $options);

        $msg = [
            'type'  => 'quick_reply',
            'msgid' => $msgid,
            'content' => $content,
            'options' => $options
        ];

        $this->assertEquals($msg, $this->gupshup->getMsg());
    }

    /** @test */
    public function setTemplate()
    {
        $idtemplate = 'c6aecef6-bcb0-4fb1-8100-28c094e3bc6b';
        $templateparams =  ["Agent", "Local Address", "Tracking code"];

        $this->gupshup->setTemplate($idtemplate, $templateparams);

        $msg = [
            'id' => $idtemplate,
            'params' => $templateparams
        ];

        $this->assertEquals($msg, $this->gupshup->getMsg());
    }
}
