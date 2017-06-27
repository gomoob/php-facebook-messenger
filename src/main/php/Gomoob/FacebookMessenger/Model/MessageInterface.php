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
 * Interface which represents a Facebook Messenger message.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference
 */
interface MessageInterface extends \JsonSerializable
{
    /**
     * Get the message attachment.
     *
     * @return \Gomoob\FacebookMessenger\Model\AttachmentInterface
     */
    public function getAttachment() /* : AttachmentInterface */;

    /**
     * Gets the custom string that is delivered as a message echo.
     *
     * @return string the custom string that is delivered as a message echo.
     */
    public function getMetadata() /* : string */;

    /**
     * Gets the quick replies to be sent with messages.
     *
     * @return \Gomoob\FacebookMessenger\Model\QuickReplyInterface[] the quick replies to be sent with messages.
     */
    public function getQuickReplies() /* : array */;

    /**
     * Set the message attachment.
     *
     * @param \Gomoob\FacebookMessenger\Model\AttachmentInterface $attachment
     *
     * @return \Gomoob\FacebookMessenger\Model\AttachmentInterface this instance.
     */
    public function setAttachment(/* AttachmentInterface */ $attachment) /* : MessageInterface */;

    /**
     * Sets the custom string that is delivered as a message echo.
     *
     * @param string $metadata the custom string that is delivered as a message echo.
     *
     * @return \Gomoob\FacebookMessenger\Model\AttachmentInterface this instance.
     */
    public function setMetadata(/* string */ $metadata) /* : MessageInterface */;

    /**
     * Sets the quick replies to be sent with messages.
     *
     * @param \Gomoob\FacebookMessenger\Model\QuickReplyInterface[] $quickReplies the quick replies to be sent with
     *        messages.
     */
    public function setQuickReplies(/* array */ $quickReplies) /* : MessageInterface */;
}
