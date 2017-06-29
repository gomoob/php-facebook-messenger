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
 *   disclaimer.
 *
 * * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following
 *   disclaimer in the documentation and/or other materials provided with the distribution.
 *
 * * Neither the name of the copyright holder nor the names of its contributors may be used to endorse or promote
 *   products derived from this software without specific prior written permission.
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
use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

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

    private $guzzleClientConfig;

    /**
     * The page access token used to send a request.
     *
     * @var string
     */
    private $pageAccessToken;

    /**
     * Creates a new instance of the Facebook Messenger client.
     */
    public function __construct()
    {
        $this->guzzleClientConfig = [
            'base_uri' => 'https://graph.facebook.com/v2.6/me/messages',
            'timeout' => 5.0,
            'verify' => __DIR__ . '/../../../../resources/cacert.pem'
        ];
        $this->guzzleClient = new \GuzzleHttp\Client($this->guzzleClientConfig);
    }

    /**
     * Utility function used to create a new instance of the <tt>Client</tt>.
     *
     * @return \Gomoob\FacebookMessenger\ClientInterface the new created instance.
     */
    public static function create()
    {
        return new Client();
    }

    /**
     * Gets the Guzzle client used to request the Facebook Graph Web Services.
     *
     * @return \GuzzleHttp\Client the Guzzle client used to request the Facebook Graph Web Services.
     */
    public function getGuzzleClient() /* : \GuzzleHttp\Client */
    {
        return $this->guzzleClient;
    }

    /**
     * {@inheritDoc}
     */
    public function getPageAccessToken()
    {
        return $this->pageAccessToken;
    }

    /**
     * {@inheritDoc}
     */
    public function sendMessage(/* RequestInterface */ $request)/* : Response */
    {
        // The 'payload' property must have been defined
        if (!isset($this->pageAccessToken)) {
            throw new FacebookMessengerException('The \'pageAccessToken\' property is not set !');
        }

        // Calls the Facebook Messenger Web Service
        $guzzleResponse = $this->guzzleClient->post(null, ['json' => $request->jsonSerialize()]);

        // Decode the Guzzle response
        $stringBody = (string)$guzzleResponse->getBody();
        $statusCode = $guzzleResponse->getStatusCode();
        $statusMessage = $guzzleResponse->getReasonPhrase();

        $jsonBody = json_decode($stringBody, true);

        // Returns the request
        return Response::create($jsonBody, $statusCode, $statusMessage);
    }

    /**
     * {@inheritDoc}
     */
    public function setPageAccessToken(/*string*/ $pageAccessToken)
    {
        $this->pageAccessToken = $pageAccessToken;

        // Updates the Guzzle client configuration
        $this->guzzleClientConfig['query'] = ['access_token' => $pageAccessToken];
        $this->guzzleClient = new \GuzzleHttp\Client($this->guzzleClientConfig);

        return $this;
    }
}
