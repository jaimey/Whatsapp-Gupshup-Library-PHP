<?php

use PHPUnit\Framework\TestCase;
use Jaime\WhatsappGupshup\InboundMessageandEvents;

class  InboundUserEventTest extends TestCase
{
    /** @test */
    public function opted_in()
    {
        $json = '{
            "app":"DemoApp",
            "timestamp":1584541505908,
            "version":2,
            "type":"user-event",
            "payload":{
               "phone":"123456789",
               "type":"opted-in"
            }
         }';
        $notification = json_decode($json, true);

        $UserEvent = new InboundMessageandEvents($notification);
        $this->assertEquals("opted-in", $UserEvent->getTypePayload());
        $this->assertEquals("123456789", $UserEvent->getPhoneUserEvent());
        $this->assertEquals(1584541505908, $UserEvent->getTimestamp());
        $this->assertEquals("DemoApp", $UserEvent->getNameApp());
    }

    /** @test */
    public function opted_out()
    {
        $json = '{
            "app":"DemoApp",
            "timestamp":1584541505908,
            "version":2,
            "type":"user-event",
            "payload":{
               "phone":"123456789",
               "type":"opted-out"
            }
         }';
        $notification = json_decode($json, true);

        $UserEvent = new InboundMessageandEvents($notification);
        $this->assertEquals("opted-out", $UserEvent->getTypePayload());
        $this->assertEquals("123456789", $UserEvent->getPhoneUserEvent());
    }

    /** @test */
    public function sandbox_start()
    {
        $json = '
        {
            "app":"DemoApp",
            "timestamp":1580142086287,
            "version":2,
            "type":"user-event",
            "payload":{
               "phone":"callbackSetPhone",
               "type":"sandbox-start"
            }
         }';
        $notification = json_decode($json, true);

        $UserEvent = new InboundMessageandEvents($notification);
        $this->assertEquals("sandbox-start", $UserEvent->getTypePayload());
        $this->assertEquals("callbackSetPhone", $UserEvent->getPhoneUserEvent());
    }
}
