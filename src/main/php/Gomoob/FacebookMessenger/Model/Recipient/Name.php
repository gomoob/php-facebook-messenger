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
namespace Gomoob\FacebookMessenger\Model\Recipient;

use Gomoob\FacebookMessenger\Model\NameInterface;
use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

/**
 * Class which represents a Facebook Messenger name to be attached to a recipient.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference#recipient
 */
class Name implements NameInterface
{
    /**
     * The first name of the recipient
     * @var string
     */
    private $firstName;

    /**
     * The last name of the recipient
     * @var string
     */
    private $lastName;

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        // One of the 'firstName' or 'lastName' property must have been defined.
        if(!isset($this->firstName) && !isset($this->lastName))
        {
            throw new FacebookMessengerException('None of the \'firstName\' and \'lastName\' properties are set !');
        }

        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * {@inheritDoc}
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }
}