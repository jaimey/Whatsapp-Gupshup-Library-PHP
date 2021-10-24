<?php

namespace Jaime\WhatsappGupshup;

class OutboundMessage
{
    private $srcname;
    private $from;
    private $apiKey;
    public $msg;

    public function __construct(string $srcname, string $from, string $apiKey)
    {
        $this->srcname  = $srcname;
        $this->from     = $from;
        $this->apiKey   = $apiKey;
    }
    public function setText(string $message)
    {
        $this->msg = [
            'type' => 'text',
            'text' => $message
        ];
    }

    public function getMsg()
    {
        return $this->msg;
    }
    public function setImage(string $imageUrl, string $caption)
    {
        $this->msg = [
            'type'        => 'image',
            'originalUrl' => $imageUrl,
            'previewUrl'  => $imageUrl,
            'caption'     => $caption,
        ];
    }

    public function setAudio(string $audioUrl)
    {
        $this->msg = [
            'type' => 'audio',
            'url'  => $audioUrl,

        ];
    }

    public function setFile(string $file, string $caption)
    {
        $this->msg = [
            'type'      => 'file',
            'url'       => $file,
            'filename'  => $caption,
        ];
    }

    public function setVideo(string $file, string $caption)
    {
        $this->msg = [
            'type'      => 'video',
            'url'       => $file,
            'caption'  => $caption,
        ];
    }

    public function setSticker(string $url)
    {
        $this->msg = [
            'type'      => 'sticker',
            'url'       => $url
        ];
    }

    public function setListMessage(string $title, string $body, string $msgid, array $globalButtons, array $items)
    {
        $this->msg = [
            'type' => 'list',
            'title' => $title,
            'body' => $body,
            'msgid' => $msgid,
            'globalButtons' => $globalButtons,
            'items' => $items
        ];
    }

    public function setQuickRepliesText(string $msgid, array $content, array $options)
    {
        $this->msg = [
            'type'  => 'quick_reply',
            'msgid' => $msgid,
            'content' => $content,
            'options' => $options
        ];
    }

    public function setQuickRepliesImage(string $msgid, array $content, array $options)
    {
        $this->msg = [
            'type'  => 'quick_reply',
            'msgid' => $msgid,
            'content' => $content,
            'options' => $options
        ];
    }

    public function sendRequest($to)
    {
        $url = 'https://api.gupshup.io/sm/api/v1/msg';

        $params = [
            'channel'     => 'whatsapp',
            'source'      => $this->from,
            'destination' => $to,
            'message'     => json_encode($this->msg, JSON_UNESCAPED_SLASHES),
            'src.name'    => $this->srcname,
        ];

        return $this->doPost($url, $params);
    }

    public function getTemplates()
    {
        $url = 'https://api.gupshup.io/sm/api/v1/template/list/' . $this->srcname;

        return $this->doGet($url);
    }

    public function setTemplate(string $idtemplate, array $templateparams)
    {
        $this->msg = [
            'id' => $idtemplate,
            'params' => $templateparams
        ];
    }

    public function sendTemplate($to)
    {
        $url = 'http://api.gupshup.io/sm/api/v1/template/msg';

        $params = [
            'source'      => $this->from,
            'destination' => $to,
            'template'    => json_encode($this->msg, JSON_UNESCAPED_SLASHES),
        ];

        return $this->doPost($url, $params);
    }

    public function getOptin()
    {
        $url = 'https://api.gupshup.io/sm/api/v1/users/' . $this->srcname;

        return $this->doGet($url);
    }

    public function markOpt($mobile, $inout)
    {
        $url = 'https://api.gupshup.io/sm/api/v1/app/opt/' . $inout . '/' . $this->srcname;

        $params = [
            'user' => $mobile
        ];

        return $this->doPost($url, $params);
    }

    public function getWalletBalance()
    {
        $url = 'https://api.gupshup.io/sm/api/v2/wallet/balance';

        return $this->doGet($url);
    }

    private function doPost($url, $params)
    {
        $headers = [
            'Content-Type: application/x-www-form-urlencoded',
            'apikey: ' . $this->apiKey
        ];

        $fields_string = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    private function doGet($url)
    {
        $headers = [
            'apikey: ' . $this->apiKey
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
