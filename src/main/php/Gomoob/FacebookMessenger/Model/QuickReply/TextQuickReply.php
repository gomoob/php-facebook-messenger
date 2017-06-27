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
namespace Gomoob\FacebookMessenger\Model\QuickReply;

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

/**
 * Class which represents a Facebook Messenger location quick reply (i.e a quick reply having a `content_type` JSON
 * property equals to `text`).
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference/quick-replies
 */
class TextQuickReply extends AbstractQuickReply
{
    /**
     * URL of image.
     *
     * @var string
     */
    private $imageUrl;

    /**
     * Custom data that will be sent back to you via webhook.
     *
     * @var string
     */
    private $payload;

    /**
     * The caption of the button.
     *
     * @var string
     */
    private $title;

    /**
     * Utility function used to create a new instance of the <tt>TextQuickReply</tt> class.
     *
     * @return \Gomoob\FacebookMessenger\Model\QuickReply\TextQuickReply the new created instance.
     */
    public static function create()
    {
        return new TextQuickReply();
    }

    /**
     * Gets the URL of image.
     *
     * @return string the URL of image.
     */
    public function getImageUrl() /* : string */
    {
        return $this->imageUrl;
    }

    /**
     * Gets the custom data that will be sent back to you via webhook.
     *
     * @return string the custom data that will be sent back to you via webhook.
     */
    public function getPayload() /* : string */
    {
        return $this->payload;
    }

    /**
     * Gets the caption of the button.
     *
     * @return string the caption of the button.
     */
    public function getTitle() /* : string */
    {
        return $this->title;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        // The 'title' property must have been defined
        if (!isset($this->title)) {
            throw new FacebookMessengerException('The \'title\' property is not set !');
        }

        $json = [
            'content_type' => 'text',
            'title' => $this->title
        ];

        // If the 'payload' property is defined
        if (isset($this->payload)) {
            $json['payload'] = $this->payload;
        }

        // If the 'imageUrl' property is defined
        if (isset($this->imageUrl)) {
            $json['image_url'] = $this->imageUrl;
        }

        return $json;
    }

    /**
     * Sets the URL of image.
     *
     * @param string $imageUrl the URL of image.
     *
     * @return \Gomoob\FacebookMessenger\Model\QuickReply\TextQuickReply this instance.
     */
    public function setImageUrl(/* string */ $imageUrl) /* : TextQuickReply */
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Sets the custom data that will be sent back to you via webhook.
     *
     * @param string $payload the custom data that will be sent back to you via webhook.
     *
     * @return \Gomoob\FacebookMessenger\Model\QuickReply\TextQuickReply this instance.
     */
    public function setPayload(/* string */ $payload) /* : TextQuickReply */
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Sets the caption of the button.
     *
     * @param string $title the caption of the button.
     *
     * @return \Gomoob\FacebookMessenger\Model\QuickReply\TextQuickReply this instance.
     */
    public function setTitle(/* string */ $title) /* : TextQuickReply */
    {
        $this->title = $title;

        return $this;
    }
}
