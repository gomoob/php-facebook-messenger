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
namespace Gomoob\FacebookMessenger\Model\Request;

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;
use Gomoob\FacebookMessenger\Model\Message\TextMessage;
use Gomoob\FacebookMessenger\Model\Message\VideoAttachmentMessage;
use Gomoob\FacebookMessenger\Model\Recipient\Recipient;

use PHPUnit\Framework\TestCase;

/**
 * Test case used to test the `TextMessageRequest` class.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @group TextMessageRequestTest
 */
class TextMessageRequestTest extends TestCase
{
    /**
     * Test method for the `create()` function.
     */
    public function testCreate()
    {
        $textMessageRequest = TextMessageRequest::create();
        $this->assertNotNull($textMessageRequest);
    }

    /**
     * Test method for the `getMessage()` and `setMessage($text)` functions.
     */
    public function testGetSetMessage()
    {
        // Test with a message having a bad type
        // Please note that other tests for `getMessage()` and `setMessage($text)` are written in `AbstractRequestTest`
        try {
             TextMessageRequest::create()->setMessage(VideoAttachmentMessage::create());
             $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame(
                'The \'message\' attached to a text message request must be intance of class \'TextMessage\' !',
                $fmex->getMessage()
            );
        }
    }

    /**
     * Test method for the `jsonSerialize()` function.
     */
    public function testJsonSerialize()
    {
        // Test with the sample on the Facebook Messenger documentation
        $json = TextMessageRequest::create()
            ->setRecipient(Recipient::create()->setId('USER_ID'))
            ->setMessage(
                TextMessage::create()->setText('hello, world !')
            )->jsonSerialize();

        $this->assertSame(
            [
                'recipient' => [
                    'id' => 'USER_ID'
                ],
                'message' => [
                    'text' => 'hello, world !'
                ]
            ],
            $json
        );
    }
}
