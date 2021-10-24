<?php

namespace Jaime\WhatsappGupshup;

class InboundMessageandEvents
{
    public $notification;

    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    public function getNameApp()
    {
        return $this->notification['app'];
    }

    public function getTimestamp()
    {
        return $this->notification['timestamp'];
    }

    public function getTypeNotification()
    {
        return $this->notification['type'];
    }

    public function getTypePayload()
    {
        return $this->notification['payload']['type'];
    }

    // User Event
    public function getPhoneUserEvent()
    {
        return $this->notification['payload']['phone'];
    }

    // Message Event
    public function getWhatsappMesageIDMessageEvent()
    {
        return $this->notification['payload']['payload']['whatsappMessageId'];
    }

    public function getReasonFailedMessageEvent()
    {
        return isset($this->notification['payload']['payload']['code'])
            ? $this->notification['payload']['payload']['code'] . " " . $this->notification['payload']['payload']['reason']
            : false;
    }

    public function getDestinationMessageEvent()
    {
        return $this->notification['payload']['destination'];
    }

    public function getTSMessageEvent()
    {
        return $this->notification['payload']['payload']['ts'];
    }

    // Message
    public function getID()
    {
        return $this->notification['payload']['id'];
    }

    public function getPayload()
    {
        return $this->notification['payload'];
    }

    public function getText()
    {
        return $this->notification['payload']['payload']['text'];
    }

    public function getContextID()
    {
        return $this->notification['payload']['context']['id'];
    }

    public function getContextGsId()
    {
        return $this->notification['payload']['context']['gsId'];
    }

    public function getUrl()
    {
        return $this->notification['payload']['payload']['url'];
    }

    public function getCaption()
    {
        return isset($this->notification['payload']['payload']['caption']) ? $this->notification['payload']['payload']['caption'] : '';
    }

    public function getSenderName()
    {
        return  $this->notification['payload']['sender']['name'];
    }

    public function getSenderPhone()
    {
        return $this->notification['payload']['sender']['phone'];
    }
}
