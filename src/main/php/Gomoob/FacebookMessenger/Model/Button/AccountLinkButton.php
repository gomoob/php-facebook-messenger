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
 * Class which define a Facebook Messenger account link button.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/account-linking/link-account
 */
class AccountLinkButton extends AbstractButton
{
    /**
     * The authentication callback URL. Must use HTTPS protocol.
     *
     * @var string
     */
    private $url;

    /**
     * Utility function used to create a new instance of the <tt>AccountLinkButton</tt> class.
     *
     * @return \Gomoob\FacebookMessenger\Model\Button\AccountLinkButton the new created instance.
     */
    public static function create()
    {
        return new AccountLinkButton();
    }

    /**
     * Gets the authentication callback URL. Must use HTTPS protocol.
     *
     * @return string the authentication callback URL.
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
            'type' => 'account_link',
            'url' => $this->url
        ];
    }

    /**
     * Sets the authentication callback URL. Must use HTTPS protocol.
     *
     * @param string $url the authentication callback URL.
     *
     * @return \Gomoob\FacebookMessenger\Model\Button\AccountLinkButton this instance.
     */
    public function setUrl(/* string */ $url) /* : AccountLinkButton */
    {
        $this->url = $url;

        return $this;
    }
}
