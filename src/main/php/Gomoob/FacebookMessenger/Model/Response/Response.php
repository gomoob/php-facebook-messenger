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
namespace Gomoob\FacebookMessenger\Model\Response;

use Gomoob\FacebookMessenger\Model\ResponseInterface;
use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

/**
 * Class which represents a Facebook Messenger response.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference#response
 */
class Response implements ResponseInterface
{
    /**
     * Technical identifier of message sent.
     * @var string The technical identifier of message sent.
     */
    private $messageId;

    /**
     * Technical identifier of the user.
     * @var string The technical identifier of the user.
     */
    private $recipientId;

    /**
     * The Facebook Messenger status code, the Pushwoosh API can return the following create message status codes :
     *  - 200    : (HTTP Status Code = 200) Message succesfully created.
     *  - 210    : (HTTP Status Code = 200) Argument error. See statusMessage for more info.
     *  - 400    : (HTTP Status Code = N/A) Malformed request string.
     *  - 500    : (HTTP Status Code = 500) Internal error.
     *
     * @var int
     */
    protected $statusCode;

    /**
     * The Facebook Messenger status message.
     *
     * @var string
     */
    protected $statusMessage;

    /**
     * Utility function used to create a new instance of the <tt>Response</tt> class.
     *
     * @param $jsonBody the body of the guzzle response
     * @param $statusCode the Facebook Messenger status code.
     * @param $statusMessage the Facebook Messenger status message.
     *
     * @return \Gomoob\FacebookMessenger\Model\Response\Response the new created instance.
     */
    public static function create($jsonBody, $statusCode, $statusMessage)
    {
        $createResponse = new Response();
        $createResponse->setMessageId($jsonBody['message_id']);
        $createResponse->setRecipientId($jsonBody['recipient_id']);
        $createResponse->setStatusCode(200);
        $createResponse->setStatusMessage($statusMessage);

        return $createResponse;
    }

    /**
     * {@inheritDoc}
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * {@inheritDoc}
     */
    public function getRecipientId()
    {
        return $this->recipientId;
    }

    /**
     * {@inheritDoc}
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * {@inheritDoc}
     */
    public function getStatusMessage()
    {
        return $this->statusMessage;
    }

    /**
     * {@inheritDoc}
     */
    public function isOk()
    {
        return $this->statusCode === 200;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        if (!isset($this->recipientId) || !isset($this->messageId)) {
            throw new FacebookMessengerException('The \'recipientId\' or \'messageId\' property is not set !');
        }

        return [
            'recipient_id' => $this->recipientId,
            'message_id' => $this->messageId
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function setMessageId(/*string*/ $messageId)
    {
        $this->messageId = $messageId;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setRecipientId(/*string*/ $recipientId)
    {
        $this->recipientId = $recipientId;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * {@inheritDoc}
     */
    public function setStatusMessage($statusMessage)
    {
        $this->statusMessage= $statusMessage;
    }
}
