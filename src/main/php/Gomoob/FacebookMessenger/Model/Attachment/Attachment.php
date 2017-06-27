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
namespace Gomoob\FacebookMessenger\Model\Attachment;

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;
use Gomoob\FacebookMessenger\Model\AttachmentInterface;

/**
 * Class which represents a Facebook Messenger response.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference#response
 */
class Attachment implements AttachmentInterface
{
    /**
     * The payload of the button model.
     * @var \Gomoob\FacebookMessenger\Model\PayloadInterface The payload of the attachment.
     */
    private $payload;

    /**
     * The type of the attachment must be `template`.
     * @var string The type of the attachment.
     */
    private $type;

    /**
     * Utility function used to create a new instance of the <tt>Attachment</tt> class.
     *
     * @return \Gomoob\FacebookMessenger\Model\Message\Attachment the new created instance.
     */
    public static function create()
    {
        return new Attachment();
    }

    /**
     * {@inheritDoc}
     * @see \Gomoob\FacebookMessenger\Model\AttachmentInterface::getPayload()
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * {@inheritDoc}
     * @see \Gomoob\FacebookMessenger\Model\AttachmentInterface::getType()
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        // The 'type' and 'payload' properties must have been defined
        if (!isset($this->type) && !isset($this->payload)) {
            throw new FacebookMessengerException('None of the \'type\' and \'payload\' properties are not set !');
        }

        return [
            'type' => $this->type,
            'payload' => $this->payload
        ];
    }

    /**
     * {@inheritDoc}
     * @see \Gomoob\FacebookMessenger\Model\AttachmentInterface::setPayload()
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
        return $this;
    }

    /**
     * {@inheritDoc}
     * @see \Gomoob\FacebookMessenger\Model\AttachmentInterface::setType()
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}
