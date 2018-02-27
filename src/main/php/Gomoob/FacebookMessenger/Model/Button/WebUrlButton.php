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
namespace Gomoob\FacebookMessenger\Model\Button;

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

/**
 * Class which define a Facebook Messenger web url button.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference/url-button
 */
class WebUrlButton extends AbstractButton
{
    /**
     * The title of the button.
     *
     * @var string
     */
    private $title;

    /**
     * This URL opens in a mobile browser when someone presses the button. Must use an HTTPS protocol.
     *
     * @var string
     */
    private $url;

    /**
     * Must be true if Messenger extensions are used.
     *
     * @var boolean
     */
    private $messengerExtension;

    /**
     * The URL to use for clients that do not support Messenger extensions. If this property is not set, the url
     * property will be used as a fallback. It should only be specified if messenger_extensions is true. Must use an
     * HTTPS protocol.
     *
     * @var string
     */
    private $fallbackUrl;

    /**
     * Height of the web view.
     *
     * @var string
     */
    private $webViewHeightRatio;

    /**
     * Set this property to hide to disable the Share button in the Webview (for sensitive information). This does not
     * affect the shares that the developer makes with the extensions.
     *
     * @var string
     */
    private $webViewShareButton;

    /**
     * Utility function used to create a new instance of the <tt>WebUrlButton</tt> class.
     *
     * @return \Gomoob\FacebookMessenger\Model\Button\WebUrlButton the new created instance.
     */
    public static function create()
    {
        return new WebUrlButton();
    }

    /**
     * Get the fallback url
     * @return string the fallback url
     */
    public function getFallbackUrl()
    {
        return $this->fallbackUrl;
    }

    /**
     * True if messenger extension are used.
     * @return boolean True if messenger extension are used.
     */
    public function getMessengerExtension()
    {
        return $this->messengerExtension;
    }

    /**
     * Get the title of the button.
     * @return string the title of the button
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the Url of the button target
     * @return string the Url of the button target
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the height ratio of the web view.
     * @return string the height ratio of the web view.
     */
    public function getWebViewHeightRatio()
    {
        return $this->webViewHeightRatio;
    }

    /**
     * Get the parameter of the web view share button.
     * @return string the parameter of the web view share button.
     */
    public function getWebViewShareButton()
    {
        return $this->webViewShareButton;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        // The 'type' property must have been defined
        if (!isset($this->title) || !isset($this->url)) {
            throw new FacebookMessengerException('None of the \'type\', \'title\' or \'url\' properties are set !');
        }

        return [
            'type' => 'web_url',
            'url' => $this->url,
            'title' => $this->title
        ];
    }

    /**
     * Set the fallback url.
     *
     * @param string $fallbackUrl the fallback url.
     */
    public function setFallbackUrl($fallbackUrl)
    {
        $this->fallbackUrl = $fallbackUrl;

        return $this;
    }

    /**
     * Set true if messenger extension are used.
     *
     * @param boolean true if messenger extension are used.
     */
    public function setMessengerExtension($messengerExtension)
    {
        $this->messengerExtension = $messengerExtension;

        return $this;
    }

    /**
     *
     * @param string $title
     * @return string
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     *
     * @param string $url
     * @return string the url of the button target.
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     *
     * @param string $webViewHeightRatio
     * @return string
     */
    public function setWebViewHeightRatio($webViewHeightRatio)
    {
        $this->webViewHeightRatio = $webViewHeightRatio;

        return $this;
    }

    /**
     *
     * @param string $webViewShareButton
     * @return string
     */
    public function setWebViewShareButton($webViewShareButton)
    {
        $this->webViewShareButton = $webViewShareButton;

        return $this;
    }
}
