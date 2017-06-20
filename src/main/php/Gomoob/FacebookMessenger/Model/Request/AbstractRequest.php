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
namespace Gomoob\FacebookMessenger\Model\Recipient;

use Gomoob\FacebookMessenger\Model\RequestInterface;
use Gomoob\FacebookMessenger\Model\RecipientInterface;
use Gomoob\FacebookMessenger\Model\MessageInterface;

/**
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 *
 */
abstract class AbstractRequest implements RequestInterface {
	
	/**
	 * The message link to the request
	 * @var MessageInterface
	 */
	private $message;

	/**
	 * The notification type of the request
	 * @var String
	 */
    private $notificationType;

    /**
     * The recipient of the message link to the request
     * @var RecipientInterface
     */
    private $recipient;

    /**
     * The sender action of the request
     * @var String
     */
    private $senderAction;

    /**
     * {@inheritDoc}
     */
    public function getMessage(): MessageInterface
    {
        return $this->message;
    }

    /**
     * {@inheritDoc}
     */
    public function getNotificationType(): string
    {
        return $this->notificationType;
    }

    /**
     * {@inheritDoc}
     */
    public function getRecipient(): RecipientInterface
    {
        return $this->recipient;
    }

    /**
     * {@inheritDoc}
     */
    public function getSenderAction(): string
    {
        return $this->senderAction;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
    	$json = [
    		'message' => $this->message,
    		'notificationType' => $this->notificationType,
    		'recipient' => $this->recipient,
    		'senderAction' => $this->senderAction
    	];
    	
    	return $json;
    }

    /**
     * {@inheritDoc}
     */
    public function setMessage(MessageInterface $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setNotificationType(string $notificationType)
    {
        $this->notificationType = $notificationType;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setSenderAction(string $senderAction)
    {
        $this->senderAction = $senderAction;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setRecipient(RecipientInterface $recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }
}