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

use Gomoob\FacebookMessenger\Client\Client;
use Gomoob\FacebookMessenger\Model\Attachment\Attachment;
use Gomoob\FacebookMessenger\Model\Button\WebUrlButton;
use Gomoob\FacebookMessenger\Model\Message\TemplateMessage;
use Gomoob\FacebookMessenger\Model\Message\TextMessage;
use Gomoob\FacebookMessenger\Model\Payload\ButtonTemplatePayload;
use Gomoob\FacebookMessenger\Model\Recipient\Recipient;
use Gomoob\FacebookMessenger\Model\Request\TemplateMessageRequest;
use Gomoob\FacebookMessenger\Model\Request\TextMessageRequest;
use PHPUnit\Framework\TestCase;

/**
 * Test case used to test the `ClientMock` class.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @group ClientMockTest
 */
class ClientMockTest extends TestCase
{
    /**
     * Test method for the `getPageAccessToken()` and `setPageAccessToken($pageAccessToken)` functions.
     */
    public function testGetSetPageAccessToken()
    {
        $client = Client::create();
        $client->setPageAccessToken('1702809689738727|5v1Lg1Ysbln9hrYESZgS_GEWToA');
        $this->assertSame('1702809689738727|5v1Lg1Ysbln9hrYESZgS_GEWToA', $client->getPageAccessToken());
    }
    
    /**
     * Test method for the `sendMessage()` function.
     *
     * @group ClientMockTest.testSendMessage
     */
    public function testSendMessage()
    {
    	$clientMock = new ClientMock();
    	$this->assertCount(0, $clientMock->getFacebookMessengerRequests());
        
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // Create a request to simulate a send of a simple Text Message//
    	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $request = TextMessageRequest::create()
            ->setRecipient(Recipient::create()->setPhoneNumber('+33760647186'))
            ->setMessage(TextMessage::create()->setText('Hello World !'));

        // Call the REST Web Service
        $response = $clientMock->sendMessage($request);
        $this->assertNotNull($response);
        $this->assertTrue($response->isOk());
        $this->assertSame(200, $response->getStatusCode());
        
        // Check if its ok
    	if($response->isOk()) {
    		print 'Great, my text message mock has been sent !';
    	} else {
    		print 'Oups, the sent failed :-(';
    		print 'Status code : ' . $response->getStatusCode();
    		print 'Status message : ' . $response->getStatusMessage();
    	}
    	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	// Create a request to send a Template Message                                                               //
    	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	$button = WebUrlButton::create()->setTitle('Voir le moment')->setType('web_url')->setUrl("www.google.com");
    	$button2 = WebUrlButton::create()->setTitle('Mon compte')->setType('web_url')->setUrl("www.google.com");
    	
    	$buttons[] = $button;
    	$buttons[] = $button2;
    	
    	$buttonTemplatePayload = ButtonTemplatePayload::create()
    	    ->setTemplateType("button")
    	    ->setText('ButtonTemplate payload test.')
    	    ->setButtons($buttons);
    	
    	$attachment = Attachment::create()->setType('template')->setPayload($buttonTemplatePayload);
    	
    	$templateMessageRequest = TemplateMessageRequest::create()
    	    ->setRecipient(Recipient::create()->setPhoneNumber('+33760647186'))
    	    ->setMessage(TemplateMessage::create()->setAttachment($attachment));
    	
    	// Call the REST Web Service
    	$responseTemplateMessage = $clientMock->sendMessage($templateMessageRequest);
    	
    	// Check if template message response is ok
    	if($responseTemplateMessage->isOk()) {
    		print 'Great, my template message mock has been sent !';
    	} else {
    		print 'Oups, the template message sent failed :-(';
    		print 'Status code : ' . $responseTemplateMessage->getStatusCode();
    		print 'Status message : ' . $responseTemplateMessage->getStatusMessage();
    	}
    	
    	$this->assertCount(2, $clientMock->getFacebookMessengerRequests());
    }
}
