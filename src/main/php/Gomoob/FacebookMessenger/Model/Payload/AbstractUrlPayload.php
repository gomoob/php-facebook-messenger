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
namespace Gomoob\FacebookMessenger\Model\Payload;

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

/**
 * Abstract class common to all Facebook Messenger payloads which transports an URL.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 */
abstract class AbstractUrlPayload extends AbstractPayload
{
    /**
     * The URL to the audio file.
     *
     * @var string
     */
    protected $url;

    /**
     * Gets the URL to the audio file.
     *
     * @return string the URL to the audio file.
     */
    public function getUrl() /* : string */
    {
        return $this->url;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        // The 'url' property must have been defined
        if (!isset($this->url)) {
            throw new FacebookMessengerException('The \'url\' property is not set !');
        }

        return [
            'url' => $this->url
        ];
    }

    /**
     * Sets the URL to the audio file.
     *
     * @param string $url the URL to the audio file.
     *
     * @return \Gomoob\FacebookMessenger\Model\Payload\AudioAttachmentPayload this instance.
     */
    public function setUrl(/* string */ $url) /* : AudioAttachmentPayload */
    {
        $this->url = $url;

        return $this;
    }
}
