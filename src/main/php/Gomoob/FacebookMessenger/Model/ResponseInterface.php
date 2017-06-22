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
 * Interface which represents a Facebook Messenger response.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference
 */
interface ResponseInterface extends \JsonSerializable
{
    public function getAttachmentId()/*: string*/;
    public function getMessageId()/*: string*/;
    public function getRecipientId()/*: string*/;

    /**
     * Gets the Facebook messenger status code, , the Facebook messenger API can return the following create message status codes :
     *  - 200    : (HTTP Status Code = 200) Message succesfully created.
     *  - 210    : (HTTP Status Code = 200) Argument error. See statusMessage for more info.
     *  - 400    : (HTTP Status Code = N/A) Malformed request string.
     *  - 500    : (HTTP Status Code = 500) Internal error.
     *
     * @return int the Facebook messenger status code.
     */
    public function getStatusCode();
    
    /**
     * Gets the Facebook messenger status message.
     *
     * @return string the Facebook messenger status message.
     */
    public function getStatusMessage();
    
    /**
     * Function used to indicate if the response represents a success.
     *
     * @return boolean true if the response represents a success, false otherwise.
     */
    public function isOk();

    public function setAttachmentId(/*string*/ $attachmentId);
    public function setMessageId(/*string*/ $messageId);
    public function setRecipientId(/*string*/ $recipientId);
    
    /**
     * Sets the Facebook messenger status code, the Facebook messenger API can return the following create message status codes :
     *  - 200    : (HTTP Status Code = 200) Message succesfully created.
     *  - 210    : (HTTP Status Code = 200) Argument error. See statusMessage for more info.
     *  - 400    : (HTTP Status Code = N/A) Malformed request string.
     *  - 500    : (HTTP Status Code = 500) Internal error.
     *
     * @param int $statusCode the Facebook messenger status code.
     */
    public function setStatusCode($statusCode);
    
    /**
     * Sets the Facebook messenger status message.
     *
     * @param string $statusMessage the Facebook messenger status message.
     */
    public function setStatusMessage($statusMessage);
}
