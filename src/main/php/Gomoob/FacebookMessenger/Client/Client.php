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
namespace Gomoob\FacebookMessenger\Model\Client;

use Gomoob\FacebookMessenger\ClientInterface;
use Gomoob\FacebookMessenger\Model\MessageInterface;
use Gomoob\FacebookMessenger\Model\Recipient\Request;
use Gomoob\FacebookMessenger\Model\Request\TextMessageRequest;
use Gomoob\FacebookMessenger\Model\Message\TextMessage;
use Gomoob\FacebookMessenger\Model\Recipient\Recipient;

/**
 * Class which defines a Facebook Messenger client.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference/text-message
 */
class Client implements ClientInterface
{
    /**
     * The Guzzle client used to request the Facebook Graph Web Services.
     *
     * @var \GuzzleHttp\Client
     */
    private $guzzleClient;

    /**
     * Creates a new instance of the Facebook Messenger client.
     */
    public function __construct()
    {
        $this->guzzleClient = new \GuzzleHttp\Client(
            [
                'base_uri' => 'https://graph.facebook.com/v2.6/me/messages',
                'timeout' => 2.0
            ]
        );
    }
    
    /**
     * Utility function used to create a new instance of the <tt>TextMessageRequest</tt>.
     *
     * @return \Gomoob\FacebookMessenger\Model\Request\TextMessageRequest the new created instance.
     */
    public static function createTextMessageRequest()
    {
    	return new TextMessageRequest();
    }

    /**
     * {@inheritDoc}
     */
    public function sendMessage(/*MessageInterface $message*/)
    {
    	// Create a message to send.
    	$message = TextMessage::create()->setText("Hello World");
    	
    	$recipient = new Recipient();
    	$recipient->setName('Toto');
    	$recipient->setPhoneNumber('0700112233');
    	
    	// Create a Facebook Messenger client
    	// $client = Client::createTextMessageRequest()->setPageAccessToken('XXXX-XXX');
    	$client = Client::createTextMessageRequest()->setMessage($message);
    	
    	// Create a request to send a simple Text Message
    	$textMessagerequest = TextMessageRequest::create();
    	$textMessagerequest->setMessage($message);
    	$textMessagerequest->setRecipient($recipient);
    	
    	// Call the REST Web Service
    	$response = $client->sendMessage($textMessagerequest);
    }
}