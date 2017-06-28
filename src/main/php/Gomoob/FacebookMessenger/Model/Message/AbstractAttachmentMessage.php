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
namespace Gomoob\FacebookMessenger\Model\Message;

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;
use Gomoob\FacebookMessenger\Model\AttachmentMessageInterface;

/**
 * Abstract class common to all Facebook Messenger messages having an attachment.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 */
abstract class AbstractAttachmentMessage extends AbstractMessage implements AttachmentMessageInterface
{
    /**
     * The attachment of the message to send.
     *
     * @var \Gomoob\FacebookMessenger\Model\AttachmentInterface
     */
    protected $attachment;

    /**
     * {@inheritDoc}
     */
    public function getAttachment() /* : AttachmentInterface */
    {
        return $this->attachment;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        // The 'attachment' property must have been defined
        if (!isset($this->attachment)) {
            throw new FacebookMessengerException('The \'attachment\' property is not set !');
        }

        return [
            'attachment' => $this->attachment->jsonSerialize()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function setAttachment($attachment) /* : AttachmentMessageInterface */
    {
        // First checks the attachment is of the right type
        $this->doCheckAttachmentType($attachment);

        // Sets the attachment
        $this->attachment = $attachment;

        // Return this instance
        return $this;
    }

    /**
     * Checks that the attachment attached to the message is of the right type.
     *
     * @param \Gomoob\FacebookMessenger\Model\AttachmentInterface $attachment the attachment to check.
     *
     * @throws \Gomoob\FacebookMessenger\Exception\FacebookMessengerException if the provided attachment has not the
     *         right type.
     */
    abstract protected function doCheckAttachmentType(/* AttachmentInterface */ $attachment);
}
