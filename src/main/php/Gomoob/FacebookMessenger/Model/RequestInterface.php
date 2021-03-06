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
namespace Gomoob\FacebookMessenger\Model;

/**
 * Interface which represents a Facebook Messenger request.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference
 */
interface RequestInterface extends \JsonSerializable
{
    /**
     * A string which defines the `NO_PUSH` notification type.
     *
     * @var string
     */
    const NOTIFICATION_TYPE_NO_PUSH = 'NO_PUSH';

    /**
     * A string which defines the `REGULAR` notification type.
     *
     * @var string
     */
    const NOTIFICATION_TYPE_REGULAR = 'REGULAR';

    /**
     * A string which defines the `SILENT_PUSH` notification type.
     *
     * @var string
     */
    const NOTIFICATION_TYPE_SILENT_PUSH = 'SILENT_PUSH';

    /**
     * A string which defines the `mark_seen` sender action.
     *
     * @var string
     */
    const SENDER_ACTION_MARK_SEEN = 'mark_seen';

    /**
     * A string which defines the `typing_off` sender action.
     *
     * @var string
     */
    const SENDER_ACTION_TYPING_OFF = 'typing_off';

    /**
     * A string which defines the `typing_on` sender action.
     *
     * @var string
     */
    const SENDER_ACTION_TYPING_ON = 'typing_on';

    /**
     * Gets the message associated to the request.
     *
     * @return \Gomoob\FacebookMessenger\Model\MessageInterface the message associated to the request.
     */
    public function getMessage() /* : MessageInterface */;

    /**
     * Gets the notification type of the request.
     *
     * @return string the notification type of the request.
     */
    public function getNotificationType() /* : string */;

    /**
     * Gets the recipient of the message associated to the request.
     *
     * @return \Gomoob\FacebookMessenger\Model\RecipientInterface the recipient of the message associated to the
     *         request.
     */
    public function getRecipient() /* : RecipientInterface */;

    /**
     * Gets the sender action of the request.
     *
     * @return string the sender action of the request.
     */
    public function getSenderAction() /* : string */;

    /**
     * Set the message link to the request.
     *
     * @param \Gomoob\FacebookMessenger\Model\MessageInterface $message the message link to the request.
     *
     * @return \Gomoob\FacebookMessenger\Model\RequestInterface this instance.
     */
    public function setMessage(/* MessageInterface */ $message) /* : RequestInterface */;

    /**
     * Set the notification type of the request.
     *
     * @param string $notificationType the notification type of the request.
     *
     * @return \Gomoob\FacebookMessenger\Model\RequestInterface this instance.
     */
    public function setNotificationType(/* string */ $notificationType) /* : RequestInterface */;

    /**
     * Set the recipient of the message link to the request
     *
     * @param \Gomoob\FacebookMessenger\Model\RecipientInterface $recipient the recipient of the message link to
     *        the request.
     *
     * @return \Gomoob\FacebookMessenger\Model\RequestInterface this instance.
     */
    public function setRecipient(/* RecipientInterface */ $recipient) /* : RequestInterface */;

    /**
     * Set the sender action of the request.
     *
     * @param string $senderAction the sender action of the request.
     *
     * @return \Gomoob\FacebookMessenger\Model\RequestInterface this instance.
     *
     * @return \Gomoob\FacebookMessenger\Model\RequestInterface this instance.
     */
    public function setSenderAction(/* string */ $senderAction) /* : RequestInterface */;
}
