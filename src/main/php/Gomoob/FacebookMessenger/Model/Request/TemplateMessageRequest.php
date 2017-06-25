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
namespace Gomoob\FacebookMessenger\Model\Request;

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

/**
 * Class which represents a Facebook Messenger request.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference#request
 */
class TemplateMessageRequest extends AbstractRequest {
	
	/**
	 * The message to be attached to the template message request.
	 * @var \Gomoob\FacebookMessenger\Model\TemplateMessageInterface The message to be attached to the template message 
	 * request.
	 */
	private $message;

    /**
     * Utility function used to create a new instance of the <tt>TemplateMessageRequest</tt>.
     *
     * @return \Gomoob\FacebookMessenger\Model\Request\TemplateMessageRequest the new created instance.
     */
    public static function create()
    {
        return new TemplateMessageRequest();
    }
	
	/**
	 * {@inheritDoc}
	 * @see \Gomoob\FacebookMessenger\Model\RequestInterface::getMessage()
	 */
    public function getMessage()
    {
    	return $this->message;
    }

    /**
     * {@inheritDoc}
     */
    public function getNotificationType()
    {
        return $this->notificationType;
    }

    /**
     * {@inheritDoc}
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * {@inheritDoc}
     */
    public function getSenderAction()
    {
        return $this->senderAction;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
    	// Message property must been define.
    	if (!isset($this->message)) {
            throw new FacebookMessengerException('The \'message\' property is not set !');
        }
        
        // Recipient property must been define.
    	if (!isset($this->recipient)) {
            throw new FacebookMessengerException('The \'recipient\' property is not set !');
        }
        $json = [
            'message' => $this->message,
//             'notificationType' => $this->notificationType,
            'recipient' => $this->recipient,
//             'senderAction' => $this->senderAction
        ];

        return $json;
    }

    /**
     * {@inheritDoc}
     * @see \Gomoob\FacebookMessenger\Model\RequestInterface::setMessage()
     */
    public function setMessage($message)
    {
    	$this->message = $message;
    	
    	return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setNotificationType(/* string */ $notificationType)
    {
        $this->notificationType = $notificationType;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setSenderAction(/* string */ $senderAction)
    {
        $this->senderAction = $senderAction;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setRecipient(/* RecipientInterface */ $recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }
}