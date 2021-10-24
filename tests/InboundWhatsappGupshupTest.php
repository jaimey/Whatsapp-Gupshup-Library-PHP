<?php

use PHPUnit\Framework\TestCase;
use Jaime\WhatsappGupshup\InboundMessageandEvents;

class InboundMessageandEventsTest extends TestCase
{
    /** @test */
    public function inbound()
    {
        $json = '
        {
            "app":"DemoApp",
            "timestamp":1580227766370,
            "version":2,
            "type":"user-event message-event message",
            "payload":"This varies according to type property value "
        }';
        $notification = json_decode($json, true);

        $inbound = new InboundMessageandEvents($notification);

        $this->assertEquals(1580227766370, $inbound->getTimestamp());
        $this->assertEquals("DemoApp", $inbound->getNameApp());
    }
}
