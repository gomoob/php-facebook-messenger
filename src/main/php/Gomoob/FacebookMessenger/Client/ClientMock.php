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

use Gomoob\FacebookMessenger\ClientInterface;
use Gomoob\FacebookMessenger\Model\Response\Response;
use Gomoob\FacebookMessenger\ClientMockInterface;

/**
 * Class which defines a Facebook Messenger client mock.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference/text-message
 */
class ClientMock implements ClientMockInterface
{
	/**
	 * The page access token to be used by default by all the requests performed by the Facebook Messenger client.
	 * This identifier can be overwritten by request if needed.
	 *
	 * @var string
	 */
	private $pageAccessToken;
	
	/**
	 * An array which contains all Facebook Messenger requests sent by this client.
	 *
	 * @var array
	 */
	private $FacebookMessengerRequests = [];

	/**
	 * 
	 * {@inheritDoc}
	 * @see \Gomoob\FacebookMessenger\ClientInterface::getPageAccessToken()
	 */
    public function getPageAccessToken()
    {
    	return $this->pageAccessToken;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Gomoob\FacebookMessenger\ClientInterface::sendMessage()
     */
    public function sendMessage($request)
    {
    	$this->FacebookMessengerRequests[] = $request;
    	return Response::create(
    		json_decode('{
    			"recipient_id":"1506900809384015",
    			"message_id":"mid.$cAACzfxmNj4VjBRUYrFc08_P1M_Za",
                "status_code":200,
                "status_message":"OK"
            }', true)
    	);
    }
	
    /**
     * 
     * {@inheritDoc}
     * @see \Gomoob\FacebookMessenger\ClientInterface::setPageAccessToken()
     */
    public function setPageAccessToken($pageAccessToken)
    {
    	$this->pageAccessToken = $pageAccessToken;
    	return $this;
    }
    
    /**
     * Gets the list of Facebook Messenger requests which have been sent with this Facebook Messenger client.
     *
     * @return array An array of Facebook Messenger requests which have been sent with this Facebook Messenger client.
     */
	public function getFacebookMessengerRequests() {
		return $this->FacebookMessengerRequests;
	}
	
}
