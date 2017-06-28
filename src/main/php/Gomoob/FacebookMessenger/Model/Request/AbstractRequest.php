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
namespace Gomoob\FacebookMessenger\Model\Request;

use Gomoob\FacebookMessenger\Model\RequestInterface;
use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

/**
 * Abstract class common to all Facebook Messenger request.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 */
abstract class AbstractRequest implements RequestInterface
{
    /**
     * The message attached to the request.
     *
     * @var \Gomoob\FacebookMessenger\Model\MessageInterface
     */
    protected $message;

    /**
     * The notification type of the request.
     *
     * @var string
     */
    protected $notificationType;

    /**
     * The recipient of the message link to the request.
     *
     * @var \Gomoob\FacebookMessenger\Model\RecipientInterface
     */
    protected $recipient;

    /**
     * The sender action of the request.
     *
     * @var string
     */
    protected $senderAction;

    /**
     * {@inheritDoc}
     */
    public function getMessage() /* : MessageInterface */
    {
        return $this->message;
    }

    /**
     * {@inheritDoc}
     */
    public function getNotificationType() /* : string */
    {
        return $this->notificationType;
    }

    /**
     * {@inheritDoc}
     */
    public function getRecipient() /* : RecipientInterface */
    {
        return $this->recipient;
    }

    /**
     * {@inheritDoc}
     */
    public function getSenderAction() /* : string */
    {
        return $this->senderAction;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return [
            'message' => $this->message,
            'notificationType' => $this->notificationType,
            'recipient' => $this->recipient,
            'senderAction' => $this->senderAction
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function setMessage(/* MessageInterface */ $message) /* : RequestInterface */
    {
        if ($message !== null) {
            // First checks the message is of the right type
            $this->doCheckMessageType($message);

            // If the sender action is defined then the message cannot be defined
            if (isset($this->senderAction)) {
                throw new FacebookMessengerException(
                    'The message cannot be defined because a sender action has been associated to this request ! If ' .
                    'you want to set a message then you must first set the sender action to \'null\'.'
                );
            }
        }

        // Sets the message
        $this->message = $message;

        // Returns this instance
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setNotificationType(/* string */ $notificationType) /* : RequestInterface */
    {
        // Ensure the notification type has the right value
        $allowedNotificationTypes = [
            RequestInterface::NOTIFICATION_TYPE_NO_PUSH,
            RequestInterface::NOTIFICATION_TYPE_REGULAR,
            RequestInterface::NOTIFICATION_TYPE_SILENT_PUSH
        ];
        if ($notificationType !== null && !in_array($notificationType, $allowedNotificationTypes)) {
            throw new FacebookMessengerException(
                'Invalid notification type \'' . $notificationType . '\' ! The notification type can only be equal ' .
                    'to \'' . RequestInterface::NOTIFICATION_TYPE_NO_PUSH . '\', \'' .
                    RequestInterface::NOTIFICATION_TYPE_REGULAR . '\' or \'' .
                    RequestInterface::NOTIFICATION_TYPE_SILENT_PUSH . '\'.'
            );
        }

        $this->notificationType = $notificationType;

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

    /**
     * {@inheritDoc}
     */
    public function setSenderAction(/* string */ $senderAction)
    {
        if ($senderAction !== null) {
            // Ensure the sender action has the right value
            $allowedSenderActions = [
                RequestInterface::SENDER_ACTION_MARK_SEEN,
                RequestInterface::SENDER_ACTION_TYPING_OFF,
                RequestInterface::SENDER_ACTION_TYPING_ON
            ];
            if (!in_array($senderAction, $allowedSenderActions)) {
                throw new FacebookMessengerException(
                    'Invalid sender action \'' . $senderAction . '\' ! The sender action can only be equal ' .
                    'to \'' . RequestInterface::SENDER_ACTION_MARK_SEEN . '\', \'' .
                    RequestInterface::SENDER_ACTION_TYPING_OFF . '\' or \'' .
                    RequestInterface::SENDER_ACTION_TYPING_ON . '\'.'
                );
            }

            // If the message is defined then the sender action cannot be defined
            if (isset($this->message)) {
                throw new FacebookMessengerException(
                    'The sender action cannot be defined because a message has been associated to this request ! If ' .
                    'you want to set a sender action then you must first set the message to \'null\'.'
                );
            }
        }

        // Sets the sender action
        $this->senderAction = $senderAction;

        // Returns this instance
        return $this;
    }

    /**
     * Checks that the message associated to this request is of the right type.
     *
     * @param \Gomoob\FacebookMessenger\Model\MessageInterface $message the message to check.
     *
     * @throws \Gomoob\FacebookMessenger\Exception\FacebookMessengerException if the provided message has not the right
     *         type.
     */
    abstract protected function doCheckMessageType(/* MessageInterface */ $message);
}
