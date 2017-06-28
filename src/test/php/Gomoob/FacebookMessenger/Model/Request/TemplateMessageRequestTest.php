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

use Gomoob\FacebookMessenger\Model\Message\TemplateMessage;
use Gomoob\FacebookMessenger\Model\Payload\ButtonTemplatePayload;
use Gomoob\FacebookMessenger\Model\Button\WebUrlButton;

use PHPUnit\Framework\TestCase;

/**
 * Test case used to test the `TextMessageRequest` class.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @group TemplateMessageRequestTest
 */
class TemplateMessageRequestTest extends TestCase
{
    /**
     * Test method for the `getMessage()` and `setMessage($text)` functions.
     * @group TemplateMessageRequestTest.testGetSetMessage
     */
    public function testGetSetMessage()
    {
        $templateMessageRequest = new TemplateMessageRequest();
        $templateMessage = new TemplateMessage();

        $button = new WebUrlButton();
        $button->setTitle("Voir le Moment");
        $button->setUrl("www.google.com");
        $button->setType("web_url");

        $buttonTemplatePayload = new ButtonTemplatePayload();
        $buttonTemplatePayload->setText('ButtonTemplate payload test.');
        $buttonTemplatePayload->setButtons($button);

        /*
        $attachment = new Attachment();
        $attachment->setType('template');
        $attachment->setPayload($buttonTemplatePayload);

        $templateMessage->setAttachment($attachment);
        $this->assertNull($templateMessageRequest->getMessage());
        $templateMessageRequest->setMessage($templateMessage);
        $this->assertSame($templateMessage, $templateMessageRequest->getMessage());
        */
    }


    /**
     * Test method for the `jsonSerialize()` function.
     * @group TemplateMessageRequestTest.testJsonSerialize
     */
    public function testJsonSerialize()
    {
        $templateMessageRequest = new TemplateMessageRequest();

        // Test without the 'message' property
        try {
            $templateMessageRequest->jsonSerialize();
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame('The \'message\' property is not set !', $fmex->getMessage());
        }

        // Test with valid settings
        $button = new WebUrlButton();
        $button->setTitle('Voir le moment');
        $button->setType('web_url');
        $button->setUrl("www.google.com");

        $payload = new ButtonTemplatePayload();
        $payload->setText("Payload de test");
        $payload->setButtons($button);

        $buttonTemplatePayload = new ButtonTemplatePayload();
        $buttonTemplatePayload->setText('ButtonTemplate payload test.');
        $buttonTemplatePayload->setButtons($button);

        /*
        $attachment = new Attachment();
        $attachment->setPayload($payload);
        $attachment->setType('template');
        $attachment->setPayload($buttonTemplatePayload);

        $templateMessageRequest->setRecipient(Recipient::create()->setPhoneNumber('+33760647186'));
        $templateMessageRequest->setMessage(TemplateMessage::create()->setAttachment($attachment));

        $json = $templateMessageRequest->jsonSerialize();
        $this->assertCount(2, $json);
        $this->assertSame($attachment, $json['message']->getAttachment());
        $this->assertSame('+33760647186', $json['recipient']->getPhoneNumber());
        */
    }
}
