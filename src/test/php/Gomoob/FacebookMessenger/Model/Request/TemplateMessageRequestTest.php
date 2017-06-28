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
use Gomoob\FacebookMessenger\Model\Recipient\Recipient;
use Gomoob\FacebookMessenger\Model\Attachment\TemplateAttachment;

/**
 * Test case used to test the `TextMessageRequest` class.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @group TemplateMessageRequestTest
 */
class TemplateMessageRequestTest extends TestCase
{
    /**
     * Test method for the `jsonSerialize()` function and a `button` template type.
     *
     * @group TemplateMessageRequestTest.testJsonSerialize
     */
    public function testJsonSerializeWithButtonTemplateType()
    {
        // Test with the sample on the Facebook Messenger documentation
        $json = TemplateMessageRequest::create()
            ->setRecipient(Recipient::create()->setId('USER_ID'))
            ->setMessage(
                TemplateMessage::create()->setAttachment(
                    TemplateAttachment::create()->setPayload(
                        ButtonTemplatePayload::create()
                            ->setText('What do you want to do next?')
                            ->setButtons(
                                [
                                    WebUrlButton::create()
                                        ->setUrl('https://petersapparel.parseapp.com')
                                        ->setTitle('Show Website'),
                                    // TODO: Continuer avec le PostbackButton
                                ]
                            )
                    )
                )
            )->jsonSerialize();

        $this->assertSame(
            [
                'recipient' => [
                    'id' => 'USER_ID'
                ],
                'message' => [
                    'attachment' => [
                        'type' => 'template',
                        'payload' => [
                            'template_type' => 'button',
                            'text' => 'What do you want to do next?',
                            'buttons' => [
                                [
                                    'type' => 'web_url',
                                    'url' => 'https://petersapparel.parseapp.com',
                                    'title' => 'Show Website'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            $json
        );
    }
}
