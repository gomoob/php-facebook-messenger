<?php

/**
 * BSD 3-Clause License
 *
 * Copyright (c) 2017, GOMOOB All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted provided that the
 * following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this list of conditions and the following
 * disclaimer.
 *
 * * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following
 * disclaimer in the documentation and/or other materials provided with the distribution.
 *
 * * Neither the name of the copyright holder nor the names of its contributors may be used to endorse or promote
 * products derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
 * INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
namespace Gomoob\FacebookMessenger\Client;

use Gomoob\FacebookMessenger\Model\Message\TextMessage;
use Gomoob\FacebookMessenger\Model\Request\TextMessageRequest;
use Gomoob\FacebookMessenger\Model\Recipient\Recipient;
use Gomoob\FacebookMessenger\Model\Request\TemplateMessageRequest;
use Gomoob\FacebookMessenger\Model\Message\TemplateMessage;
use Gomoob\FacebookMessenger\Model\Button\WebUrlButton;
use Gomoob\FacebookMessenger\Model\Payload\ButtonTemplatePayload;

use PHPUnit\Framework\TestCase;
use Gomoob\FacebookMessenger\Model\Attachment\ButtonTemplateAttachment;
use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

/**
 * Test case used to test the `ClientTest` class.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @group ClientTest
 */
class ClientTest extends TestCase
{
    /**
     * Test method for the `getPageAccessToken()` and `setPageAccessToken($pageAccessToken)` functions.
     */
    public function testGetSetPageAccessToken()
    {
        $client = Client::create();
        $client->setPageAccessToken('PAGE_ACCESS_TOKEN');
        $this->assertSame('PAGE_ACCESS_TOKEN', $client->getPageAccessToken());
    }

    /**
     * Test method for the `sendMessage()` function.
     *
     * @group ClientTest.testSendMessage
     */
    public function testSendMessage()
    {
        $client = Client::create();

        // Test with no 'pageAccessToken' property defined
        try {
            $client->sendMessage($this->createTextMessageRequest());
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame('The \'pageAccessToken\' property is not set !', $fmex->getMessage());
        }
        $client->setPageAccessToken('PAGE_ACCESS_TOKEN');

        // Test with a 'TextMessageRequest'
        $request = $this->createTextMessageRequest();
        $this->configureGuzzleClientToReturnFakeResponse(
            $client,
            new Response(
                200,
                [],
                json_encode(
                    [
                            'recipient_id' => 'RECIPIENT_ID',
                            'message_id' => 'MESSAGE_ID'
                        ]
                )
            )
        );

        $response = $client->sendMessage($request);
        $this->assertNotNull($response);
        $this->assertSame('MESSAGE_ID', $response->getMessageId());
        $this->assertSame('RECIPIENT_ID', $response->getRecipientId());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getStatusMessage());
        $this->assertTrue($response->isOk());

        $this->markTestSkipped('Continue testing');

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // Create a request to send a Template Message                                                               //
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $button = WebUrlButton::create()->setTitle('Voir le moment')->setType('web_url')->setUrl("www.google.com");
        $button2 = WebUrlButton::create()->setTitle('Mon compte')->setType('web_url')->setUrl("www.google.com");

        $buttons[] = $button;
        $buttons[] = $button2;

        $buttonTemplatePayload = ButtonTemplatePayload::create()
            ->setText('ButtonTemplate payload test.')
            ->setButtons($buttons);

        $attachment = ButtonTemplateAttachment::create()->setPayload($buttonTemplatePayload);

        $templateMessageRequest = TemplateMessageRequest::create()
            ->setRecipient(Recipient::create()->setPhoneNumber('+33760647186'))
            ->setMessage(TemplateMessage::create()->setAttachment($attachment));

        // Call the REST Web Service
        $responseTemplateMessage = $client->sendMessage($templateMessageRequest);

        // Check if template message response is ok
        if ($responseTemplateMessage->isOk()) {
            print 'Great, my template message has been sent !';
        } else {
            print 'Oups, the template message sent failed :-(';
            print 'Status code : ' . $responseTemplateMessage->getStatusCode();
            print 'Status message : ' . $responseTemplateMessage->getStatusMessage();
        }
    }

    /**
     * Creates a testing `TextMessageRequest` to be using during testing.
     *
     * @return \Gomoob\FacebookMessenger\Model\RequestInterface the created request.
     */
    private function createTextMessageRequest()
    {
        return TextMessageRequest::create()
            ->setRecipient(Recipient::create()->setId('USER_ID'))
            ->setMessage(TextMessage::create()->setText('hello, world !'));
    }

    /**
     * Configure the Guzzle client associated Facebook Messenger to return an expected fake response.
     *
     * @param array $fakeResponse the fake response to return.
     */
    private function configureGuzzleClientToReturnFakeResponse(
        /* \GuzzleHttp\Client */ $client,
        /* \GuzzleHttp\Psr7\Response */ $fakeResponse
    ) {

        // Creates the Mock Handler
        $mock = new MockHandler([$fakeResponse]);

        // Creates the testing Guzzle Client
        $guzzleClient = new \GuzzleHttp\Client(
            [
                'handler' =>HandlerStack::create($mock)
            ]
        );

        // Updates the Facebook Messenger client
        $reflectionProperty = new \ReflectionProperty($client, 'guzzleClient');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($client, $guzzleClient);
    }
}
