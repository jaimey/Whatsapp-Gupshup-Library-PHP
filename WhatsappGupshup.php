<?php
class WhatsappGupshup
{
    private $srcname;
    private $from;
    private $apiKey;
    private $data;

    public function __construct($srcname, $from, $apiKey)
    {
        $this->srcname  = $srcname;
        $this->from     = $from;
        $this->apiKey   = $apiKey;
    }
    public function sendText($to, $message)
    {
        $msg = json_encode(['type' => 'text', 'isHSM' => false, 'text' => $message]);
        return $this->sendRequest($to, $msg);
    }

    public function SendImage($to, $imageUrl, $caption)
    {
        $msg = json_encode([
            'type'        => 'image',
            'originalUrl' => $imageUrl,
            'previewUrl'  => $imageUrl,
            'caption'     => $caption,
        ], JSON_UNESCAPED_SLASHES);

        return $this->sendRequest($to, $msg);
    }

    public function sendAudio($to, $audioUrl)
    {
        $msg = json_encode([
            'type' => 'audio',
            'url'  => $audioUrl,

        ], JSON_UNESCAPED_SLASHES);

        return $this->sendRequest($to, $msg);
    }

    public function sendApplication($to, $application, $caption)
    {
        $msg = json_encode([
            'type'       => 'file',
            'previewUrl' => $application,
            'filename'   => $caption,
        ], JSON_UNESCAPED_SLASHES);

        return $this->sendRequest($to, $msg);
    }

    public function sendListMessage($to, $title, $body, $msgid, $globalButtons, $items)
    {
        $msg = json_encode([
            'type' => 'list',
            'title' => $title,
            'body' => $body,
            'msgid' => $msgid,
            'globalButtons' => $globalButtons,
            'items' => $items
        ], JSON_UNESCAPED_SLASHES);

        return $this->sendRequest($to, $msg);
    }

    public function sendQuickRepliesText($to, $content, $options)
    {
        $msg = json_encode([
            'type'  => 'quick_reply',
            'msgid' => 'qr1',
            'content' => $content,
            'options' => $options
        ], JSON_UNESCAPED_SLASHES);

        return $this->sendRequest($to, $msg);
    }

    public function sendQuickRepliesImage($to, $content, $options)
    {
        $msg = json_encode([
            'type'  => 'quick_reply',
            'msgid' => 'qr1',
            'content' => $content,
            'options' => $options
        ], JSON_UNESCAPED_SLASHES);

        return $this->sendRequest($to, $msg);
    }

    public function getTemplates()
    {
        $url = 'https://api.gupshup.io/sm/api/v1/template/list/' . $this->srcname;

        return $this->doGet($url);
    }

    public function sendTemplate($to, $idtemplate, $params)
    {
        $url = 'http://api.gupshup.io/sm/api/v1/template/msg';

        $msg = json_encode([
            'id' => $idtemplate,
            'params' => $params
        ]);

        $data = [
            'source'      => $this->from,
            'destination' => $to,
            'template'    => $msg,
        ];

        return $this->doPost($url, $data);
    }

    public function getOptin()
    {
        $url = 'https://api.gupshup.io/sm/api/v1/users/' . $this->srcname;

        return $this->doGet($url);
    }

    public function markOpt($mobile, $inout)
    {
        $url = 'https://api.gupshup.io/sm/api/v1/app/opt/' . $inout . '/' . $this->srcname;

        $data = [
            'user' => $mobile
        ];

        return $this->doPost($url, $data);
    }

    public function getWalletBalance()
    {
        $url = 'https://api.gupshup.io/sm/api/v2/wallet/balance';

        return $this->doGet($url);
    }

    private function sendRequest($to, $msg)
    {
        $url = 'https://api.gupshup.io/sm/api/v1/msg';

        $data = [
            'channel'     => 'whatsapp',
            'source'      => $this->from,
            'destination' => $to,
            'message'     => $msg,
            'src.name'    => $this->srcname,
        ];

        return $this->doPost($url, $data);
    }

    private function doPost($url, $data)
    {
        $headers = [
            'Content-Type: application/x-www-form-urlencoded',
            'apikey: ' . $this->apiKey
        ];

        $fields_string = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;

        // // Laravel
        // return Http::withHeaders([
        //     'Cache-Control' => 'no-cache',
        //     'apikey'        => $this->apiKey,
        // ])->asForm()->post($url, $data)->json();
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
        
        // // Laravel
        // return Http::withHeaders([
        //     'apikey'        => $this->apiKey,
        // ])->asForm()->get($url)->json();     
    }

    public function getID()
    {
        return $this->data['payload']['id'];
    }

    public function getTypePayload()
    {
        return $this->data['payload']['type'];
    }

    public function getPayload()
    {
        return $this->data['payload']['payload'];
    }
    public function getText()
    {
        return $this->data['payload']['payload']['text'];
    }
    public function getCaption()
    {
        return isset($this->data['payload']['payload']['caption']) ? $this->data['payload']['payload']['caption'] : '';
    }
    public function getSenderName()
    {
        return  $this->data['payload']['sender']['name'];
    }
    public function getSenderPhone()
    {
        return $this->data['payload']['sender']['phone'];
    }
}
