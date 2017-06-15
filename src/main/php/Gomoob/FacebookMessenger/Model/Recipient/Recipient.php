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

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;
use Gomoob\FacebookMessenger\Model\RecipientInterface;
use Gomoob\FacebookMessenger\Model\NameInterface;

/**
 * Class which represents a recepient to which one to send a Facebook Messenger message.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference#recipient
 */
class Recipient implements RecipientInterface
{
    /**
     * The page-scoped user ID of the recipient. This is the field most developers will commonly use to send messages.
     *
     * @var string
     */
    private $id;

    /**
     * The Phone number of the recipient with the format `+1(212)555-2368`. Your bot must be approved for Customer
     * Matching to send messages this way.
     *
     * @var string
     */
    private $name;

    /**
     * The Phone number of the recipient with the format `+1(212)555-2368`. Your bot must be approved for Customer
     * Matching to send messages this way.
     *
     * @var string
     */
    private $phoneNumber;

    /**
     * {@inheritDoc}
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): NameInterface
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        $json = [];

        // One of the 'id' or 'phoneNumber' property must have been defined.
        if(!isset($this->id) && !isset($this->phoneNumber))
        {
            throw new FacebookMessengerException('None of the \'id\' or \'phoneNumber\' properties are set !');
        }

        // If the 'id' or 'phoneNumber' parameters are both set this is an error
        elseif(isset($this->id) && isset($this->phoneNumber))
        {
            throw new FacebookMessengerException('Both \'id\' and \'phoneNumber\' properties are set !');
        }

        // The 'id' property is set
        elseif(isset($this->id))
        {
            $json['id'] = $this->id;
        }

        // The 'phoneNumber' property is set
        else {
            $json['phoneNumber'] = $this->phoneNumber;
        }

        // The 'name' property is set
        if(isset($this->name))
        {
            $json['name'] = $this->name;
        }

        return $json;
    }

    /**
     * {@inheritDoc}
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setName(NameInterface $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}