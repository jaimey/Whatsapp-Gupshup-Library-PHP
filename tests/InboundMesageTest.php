<?php

use PHPUnit\Framework\TestCase;
use Jaime\WhatsappGupshup\InboundMessageandEvents;

class  InboundMessageTest extends TestCase
{
   /** @test */
   public function customer_send_text()
   {
      $json = '
        {
            "app":"DemoApp",
            "timestamp":1580227766370,
            "version":2,
            "type":"message",
            "payload":{
               "id":"ABEGkYaYVSEEAhAL3SLAWwHKeKrt6s3FKB0c",
               "source":"57123456789",
               "type":"text",
               "payload":{
                  "text":"Hi"
               },
               "sender":{
                  "phone":"57123456789",
                  "name":"Smit",
                  "country_code":"57",
                  "dial_code":"123456789"
               }
            }
         }';
      $notification = json_decode($json, true);

      $message = new InboundMessageandEvents($notification);
      $this->assertEquals("message", $message->getTypeNotification());
      $this->assertEquals("ABEGkYaYVSEEAhAL3SLAWwHKeKrt6s3FKB0c", $message->getID());
      $this->assertEquals("Smit", $message->getSenderName());
      $this->assertEquals("57123456789", $message->getSenderPhone());

      $this->assertEquals("Hi", $message->getText());
   }

   /** @test */
   public function Customer_replied_to_a_business_message()
   {
      $json = '
        {
            "app":"DemoApp",
            "timestamp":1590854464792,
            "version":2,
            "type":"message",
            "payload":{
               "id":"ABEGkYaYVSEEAgo-sMx1DoUoQJRW",
               "source":"57123456789",
               "type":"text",
               "payload":{
                  "text":"hi"
               },
               "sender":{
                  "phone":"57123456789",
                  "name":"Smit",
                  "country_code":"57",
                  "dial_code":"57123456789"
               },
               "context":{
                  "id":"gBEGkYaYVSEEAgnPFrOLcjkFjL8",
                  "gsId":"9b71295f-f7af-4c1f-b2b4-31b4a4867bad"
               }
            }
        }';
      $notification = json_decode($json, true);

      $message = new InboundMessageandEvents($notification);
      $this->assertEquals("message", $message->getTypeNotification());
      $this->assertEquals("ABEGkYaYVSEEAgo-sMx1DoUoQJRW", $message->getID());
      $this->assertEquals("Smit", $message->getSenderName());
      $this->assertEquals("57123456789", $message->getSenderPhone());

      $this->assertEquals("hi", $message->getText());
      $this->assertEquals("gBEGkYaYVSEEAgnPFrOLcjkFjL8", $message->getContextID());
      $this->assertEquals("9b71295f-f7af-4c1f-b2b4-31b4a4867bad", $message->getContextGsId());
   }

   /** @test */
   public function Customer_clicked_on_a_Quick_Reply_template_message_button()
   {
      $json = '
            {
                "app":"DemoApp",
                "timestamp":1590854464792,
                "version":2,
                "type":"message",
                "payload":{
                   "id":"ABEGkYaYVSEEAgo-sMx1DoUoQJRW",
                   "source":"57123456789",
                   "type":"text",
                   "payload":{
                      "text":"View Account Balance",
                      "type":"button"
                   },
                   "sender":{
                      "phone":"57123456789",
                      "name":"Smit",
                      "country_code":"57",
                      "dial_code":"123456789"
                   },
                   "context":{
                      "id":"gBEGkYaYVSEEAgnPFrOLcjkFjL8",
                      "gsId":"9b71295f-f7af-4c1f-b2b4-31b4a4867bad"
                   }
                }
             }';
      $notification = json_decode($json, true);

      $message = new InboundMessageandEvents($notification);
      $this->assertEquals("message", $message->getTypeNotification());
      $this->assertEquals("ABEGkYaYVSEEAgo-sMx1DoUoQJRW", $message->getID());
      $this->assertEquals("Smit", $message->getSenderName());
      $this->assertEquals("57123456789", $message->getSenderPhone());

      $this->assertEquals("text", $message->getTypePayload());
      $this->assertEquals("View Account Balance", $message->getText());
      $this->assertEquals("gBEGkYaYVSEEAgnPFrOLcjkFjL8", $message->getContextID());
      $this->assertEquals("9b71295f-f7af-4c1f-b2b4-31b4a4867bad", $message->getContextGsId());
   }

   /** @test */
   public function Customer_send_image()
   {
      $json = '
        {
            "app":"DemoApp",
            "timestamp":1580227895991,
            "version":2,
            "type":"message",
            "payload":{
               "id":"ABEGkYaYVSEEAhAE0dyndiP9cVlr4hC5xU64",
               "source":"57123456789",
               "type":"image",
               "payload":{
                  "caption":"Sample image",
                  "url":"https://filemanager.gupshup.io/fm/wamedia/DemoApp/546af999-825e-485b-bf54-4a3323824cca",
                  "contentType":"image/jpeg",
                  "urlExpiry":1624956794816
               },
               "sender":{
                  "phone":"57123456789",
                  "name":"John",
                  "country_code":"57",
                  "dial_code":"123456789"
               }
            }
        }';
      $notification = json_decode($json, true);

      $message = new InboundMessageandEvents($notification);
      $this->assertEquals("message", $message->getTypeNotification());
      $this->assertEquals("ABEGkYaYVSEEAhAE0dyndiP9cVlr4hC5xU64", $message->getID());
      $this->assertEquals("John", $message->getSenderName());
      $this->assertEquals("57123456789", $message->getSenderPhone());

      $this->assertEquals("image", $message->getTypePayload());
      $this->assertEquals("https://filemanager.gupshup.io/fm/wamedia/DemoApp/546af999-825e-485b-bf54-4a3323824cca", $message->getUrl());
      $this->assertEquals("Sample image", $message->getCaption());
   }

   /** @test */
   public function Customer_send_audio()
   {
      $json = '
        {
            "app":"DemoApp",
            "timestamp":1580228104661,
            "version":2,
            "type":"message",
            "payload":{
               "id":"ABEGkYaYVSEEAhC8Sqz6bdT95X8wgVH28wz8",
               "source":"57123456789",
               "type":"audio",
               "payload":{
                  "url":"https://filemanager.gupshup.io/fm/wamedia/DemoApp/eae8a65a-b3ec-4085-94a6-3738338835fc",
                  "contentType":"audio/ogg; codecs=opus",
                  "urlExpiry":1624956864635
               },
               "sender":{
                  "phone":"57123456789",
                  "name":"John",
                  "country_code":"57",
                  "dial_code":"123456789"
               }
            }
        }';
      $notification = json_decode($json, true);

      $message = new InboundMessageandEvents($notification);
      $this->assertEquals("message", $message->getTypeNotification());
      $this->assertEquals("John", $message->getSenderName());
      $this->assertEquals("57123456789", $message->getSenderPhone());

      $this->assertEquals("https://filemanager.gupshup.io/fm/wamedia/DemoApp/eae8a65a-b3ec-4085-94a6-3738338835fc", $message->getUrl());
      $this->assertEquals("audio", $message->getTypePayload());
   }
}
