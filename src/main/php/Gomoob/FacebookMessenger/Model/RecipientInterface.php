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
 * Interface which represents a recepient to which one to send a Facebook Messenger message.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference#recipient
 */
interface RecipientInterface extends \JsonSerializable
{
    /**
     * Gets the page-scoped user ID of the recipent.
     *
     * This is the field most developers will commonly use to send messages.
     *
     * @return string the page-scoped user ID of the recipient.
     */
    public function getId() /* : string*/;

    /**
     * Gets the name of the recipient.
     *
     * If passing a phone number, also passing the user's name that you have on file will increase the odds of a
     * successful match.
     *
     * @return \Gomoob\FacebookMessenger\Model\NameInterface the name of the recipent.
     */
    public function getName() /* : NameInterface */;

    /**
     * Gets the phone number of the recipient.
     *
     * This is a phone number of the recipient with the format `+1(212)555-2368`. Your bot must be approved for Customer
     * Matching to send messages this way.
     *
     * @return string the phone number of the recipient.
     */
    public function getPhoneNumber() /* : string */;

    /**
     * Gets the user reference of the recipent.
     * This identifier is usually generated and used with the facebook messenger checkbox plugin.
     * This is a field used for the first call to the send API to get the recipient ID in return.
     *
     * @return string the page-scoped user ID of the recipient.
     */
    public function getUserRef() /* : string*/;

    /**
     * Sets the page-scoped user ID of the recipent.
     *
     * This is the field most developers will commonly use to send messages.
     *
     * @param string $id the page-scoped user ID of the recipent.
     *
     * @return \Gomoob\FacebookMessenger\Model\RecipientInterface this instance.
     */
    public function setId(/* string */ $id);

    /**
     * Sets the name of the recipent.
     *
     * If passing a phone number, also passing the user's name that you have on file will increase the odds of a
     * successful match.
     *
     * @param \Gomoob\FacebookMessenger\Model\NameInterface $name the name of the recipent.
     *
     * @return \Gomoob\FacebookMessenger\Model\RecipientInterface this instance.
     */
    public function setName(/* NameInterface */ $name);

    /**
     * Sets the phone number of the recipient.
     *
     * This is a phone number of the recipient with the format `+1(212)555-2368`. Your bot must be approved for Customer
     * Matching to send messages this way.
     *
     * @param string $phoneNumber the phone number of the recipient.
     *
     * @return \Gomoob\FacebookMessenger\Model\RecipientInterface this instance.
     */
    public function setPhoneNumber(/*string*/ $phoneNumber);

    /**
     * Sets the user reference of the recipent.
     * This identifier is usually generated and used with the facebook messenger checkbox plugin.
     * This is a field used for the first call to the send API to get the recipient ID in return.
     *
     * @param string $userRef the user reference of the recipent to set.
     *
     * @return \Gomoob\FacebookMessenger\Model\RecipientInterface this instance.
     */
    public function setUserRef(/* string */ $userRef);
}
