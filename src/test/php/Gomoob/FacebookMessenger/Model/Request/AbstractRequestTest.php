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

use PHPUnit\Framework\TestCase;
use Gomoob\FacebookMessenger\Model\RequestInterface;
use Gomoob\FacebookMessenger\Model\Recipient\Recipient;
use Gomoob\FacebookMessenger\Model\Message\TextMessage;
use Gomoob\FacebookMessenger\Model\Message\VideoAttachmentMessage;

/**
 * Test case used to test the `AbstractRequest` class.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group AbstractRequestTest
 */
class AbstractRequestTest extends TestCase
{
    /**
     * Test method for the `getMessage()` and `setMessage($message)` functions.
     */
    public function testGetSetMessage()
    {
        $request = TextMessageRequest::create();
        $message = TextMessage::create();

        // Test with a message which is not of the right type for the request
        // This is tester in test cases associated to concrete requests)

        // Test with a message when a sender action is attached to the request
        $request->setSenderAction(RequestInterface::SENDER_ACTION_MARK_SEEN);
        try {
            $request->setMessage($message);
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame(
                'The message cannot be defined because a sender action has been associated to this request ! If you ' .
                'want to set a message then you must first set the sender action to \'null\'.',
                $fmex->getMessage()
            );
        }
        $request->setSenderAction(null);

        // Test with a not null message
        $this->assertNull($request->getMessage());
        $this->assertSame($request, $request->setMessage($message));
        $this->assertSame($message, $request->getMessage());

        // Test with a null message
        $this->assertSame($request, $request->setMessage(null));
        $this->assertSame(null, $request->getMessage());
    }

    /**
     * Test method for the `getNotificationType()` and `setNotificationType($notificationType)` functions.
     */
    public function testGetSetNotificationType()
    {
        $request = TextMessageRequest::create();

        // Test with an invalid notification type
        try {
            $request->setNotificationType('UNKNOWN');
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame(
                'Invalid notification type \'UNKNOWN\' ! The notification type can only be equal to \'NO_PUSH\', ' .
                '\'REGULAR\' or \'SILENT_PUSH\'.',
                $fmex->getMessage()
            );
        }

        // Test with a not null notification type
        $this->assertNull($request->getNotificationType());
        $this->assertSame($request, $request->setNotificationType(RequestInterface::NOTIFICATION_TYPE_NO_PUSH));
        $this->assertSame(RequestInterface::NOTIFICATION_TYPE_NO_PUSH, $request->getNotificationType());

        // Test with a null notification type
        $this->assertSame($request, $request->setNotificationType(null));
        $this->assertSame(null, $request->getNotificationType());
    }

    /**
     * Test method for the `getRecipient()` and `setRecipient($recipient)` functions.
     */
    public function testGetSetRecipient()
    {
        $request = TextMessageRequest::create();
        $recipient = Recipient::create();

        $this->assertNull($request->getRecipient());
        $this->assertSame($request, $request->setRecipient($recipient));
        $this->assertSame($recipient, $request->getRecipient());
    }

    /**
     * Test method for the `getSenderAction()` and `setSenderAction($senderAction)` functions.
     */
    public function testGetSetSenderAction()
    {
        $request = TextMessageRequest::create();

        // Test with an invalid sender action
        try {
            $request->setSenderAction('UNKNOWN');
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame(
                'Invalid sender action \'UNKNOWN\' ! The sender action can only be equal to \'mark_seen\', '.
                '\'typing_off\' or \'typing_on\'.',
                $fmex->getMessage()
            );
        }

        // Test with a sender action when a message is attached to the request
        $request->setMessage(TextMessage::create());
        try {
            $request->setSenderAction(RequestInterface::SENDER_ACTION_MARK_SEEN);
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame(
                'The sender action cannot be defined because a message has been associated to this request ! If you ' .
                'want to set a sender action then you must first set the message to \'null\'.',
                $fmex->getMessage()
            );
        }
        $request->setMessage(null);

        // Test with a not null sender action
        $this->assertNull($request->getSenderAction());
        $this->assertSame($request, $request->setSenderAction(RequestInterface::SENDER_ACTION_MARK_SEEN));
        $this->assertSame(RequestInterface::SENDER_ACTION_MARK_SEEN, $request->getSenderAction());

        // Test with a null sender action
        $this->assertSame($request, $request->setSenderAction(null));
        $this->assertSame(null, $request->getSenderAction());
    }
}
