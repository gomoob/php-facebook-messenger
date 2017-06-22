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

use PHPUnit\Framework\TestCase;
use Gomoob\FacebookMessenger\Client\Client;
use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;
use Gomoob\FacebookMessenger\Model\Message\TextMessage;
use Gomoob\FacebookMessenger\Model\Request\TextMessageRequest;
use Gomoob\FacebookMessenger\Model\Recipient\Recipient;

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
        $client->setPageAccessToken('1702809689738727|5v1Lg1Ysbln9hrYESZgS_GEWToA');
        $this->assertSame('1702809689738727|5v1Lg1Ysbln9hrYESZgS_GEWToA', $client->getPageAccessToken());
    }
    
    /**
     * Test method for the `sendMessage()` function.
     *
     * @group ClientTest.testSendMessage
     */
    public function testSendMessage()
    {
        
        // Create a Facebook Messenger client
        $client = Client::create()->setPageAccessToken(
            'EAAZAZA7jhHbesBACsWYzdxcZAHJxArPoZBgMZCBFgsQo9Y0Om35KY5KZBA1Q1S47ZC5N4KYMUuzjluDdm2dTNN8vlbwFap70FcWJgHA' .
            'uujyQtIdWy0ZCRiODMZA8BLj4OiKsL5y2pPfuYTgZBrixRXT0SINWZAEZBbqEVd5lRLTaD6yfZAQZDZD'
        );
        
        // Create a request to send a simple Text Message
        $request = TextMessageRequest::create()
            ->setRecipient(Recipient::create()->setPhoneNumber('+33760647186'))
            ->setMessage(TextMessage::create()->setText('Hello World !'));
        // Call the REST Web Service
        $response = $client->sendMessage($request);

        $this->assertSame(200, $response->getStatusCode());
        
        // Check if its ok
    	if($response->isOk()) {
    		print 'Great, my message has been sent !';
    	} else {
    		print 'Oups, the sent failed :-(';
    		print 'Status code : ' . $response->getStatusCode();
    		print 'Status message : ' . $response->getStatusMessage();
    	}
    }
}
