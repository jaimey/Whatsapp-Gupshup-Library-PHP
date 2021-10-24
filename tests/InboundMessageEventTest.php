<?php

use PHPUnit\Framework\TestCase;
use Jaime\WhatsappGupshup\InboundMessageandEvents;

class  MessageEventTest extends TestCase
{
   /** @test */
   public function enqueued()
   {
      $json = '    
        {
            "app":"DemoAPI",
            "timestamp":1580546677791,
            "version":2,
            "type":"message-event",
            "payload":{
               "id":"59f8db90-c37e-4408-90ab-cc54ef8246ad",
               "type":"enqueued",
               "destination":"123456789",
               "payload":{
                  "whatsappMessageId":"gBEGkYaYVSEEAgkD7bRi9syGnBk",
                  "type":"session"
               }
            }
         }';
      $notification = json_decode($json, true);

      $MessageEvent = new InboundMessageandEvents($notification);
      $this->assertEquals("message-event", $MessageEvent->getTypeNotification());
      $this->assertEquals("enqueued", $MessageEvent->getTypePayload());
      $this->assertEquals("123456789", $MessageEvent->getDestinationMessageEvent());
      $this->assertEquals("gBEGkYaYVSEEAgkD7bRi9syGnBk", $MessageEvent->getWhatsappMesageIDMessageEvent());
   }

   /** @test */
   public function failed()
   {
      $json = '    
            {
                "app":"DemoAPI",
                "timestamp":1580311136040,
                "version":2,
                "type":"message-event",
                "payload":{
                   "id":"ee4a68a0-1203-4c85-8dc3-49d0b3226a35",
                   "type":"failed",
                   "destination":"123456789",
                   "payload":{
                      "code":1008,
                      "reason":"User is not Opted in and Inactive"
                   }
                }
             }';
      $notification = json_decode($json, true);

      $MessageEvent = new InboundMessageandEvents($notification);
      $this->assertEquals("failed", $MessageEvent->getTypePayload());
      $this->assertEquals("123456789", $MessageEvent->getDestinationMessageEvent());
      $this->assertEquals($notification['payload']['payload']['code'] . " " . $notification['payload']['payload']['reason'], $MessageEvent->getReasonFailedMessageEvent());
   }

   /** @test */
   public function sent()
   {
      $json = '    
            {
                "app":"DemoAPI",
                "timestamp":1585344475993,
                "version":2,
                "type":"message-event",
                "payload":{
                   "id":"gBEGkYaYVSEEAgnZxQ3JmKK6Wvg",
                   "gsId":"ee4a68a0-1203-4c85-8dc3-49d0b3226a35",
                   "type":"sent",
                   "destination":"123456789",
                   "payload":{
                      "ts":1585344475
                   }
                }
             }';
      $notification = json_decode($json, true);

      $MessageEvent = new InboundMessageandEvents($notification);
      $this->assertEquals("sent", $MessageEvent->getTypePayload());
      $this->assertEquals("123456789", $MessageEvent->getDestinationMessageEvent());
      $this->assertEquals(1585344475, $MessageEvent->getTSMessageEvent());
   }

   /** @test */
   public function delivered()
   {
      $json = '    
            {
                "app":"DemoAPI",
                "timestamp":1585344476683,
                "version":2,
                "type":"message-event",
                "payload":{
                   "id":"gBEGkYaYVSEEAgnZxQ3JmKK6Wvg",
                   "gsId":"ee4a68a0-1203-4c85-8dc3-49d0b3226a35",
                   "type":"delivered",
                   "destination":"123456789",
                   "payload":{
                      "ts":1585344476
                   }
                }
             }';
      $notification = json_decode($json, true);

      $MessageEvent = new InboundMessageandEvents($notification);
      $this->assertEquals("delivered", $MessageEvent->getTypePayload());
      $this->assertEquals("123456789", $MessageEvent->getDestinationMessageEvent());
      $this->assertEquals(1585344476, $MessageEvent->getTSMessageEvent());
   }

   /** @test */
   public function read()
   {
      $json = '    
        {
            "app":"DemoAPI",
            "timestamp":1585344602933,
            "version":2,
            "type":"message-event",
            "payload":{
               "id":"gBEGkYaYVSEEAgnZxQ3JmKK6Wvg",
               "gsId":"ee4a68a0-1203-4c85-8dc3-49d0b3226a35",
               "type":"read",
               "destination":"123456789",
               "payload":{
                  "ts":1585344602
               }
            }
         }';
      $notification = json_decode($json, true);

      $MessageEvent = new InboundMessageandEvents($notification);
      $this->assertEquals("read", $MessageEvent->getTypePayload());
      $this->assertEquals("123456789", $MessageEvent->getDestinationMessageEvent());
      $this->assertEquals(1585344602, $MessageEvent->getTSMessageEvent());
   }
}
