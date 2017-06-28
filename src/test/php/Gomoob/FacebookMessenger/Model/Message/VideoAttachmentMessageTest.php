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
namespace Gomoob\FacebookMessenger\Model\Message;

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;
use Gomoob\FacebookMessenger\Model\Attachment\ImageAttachment;
use Gomoob\FacebookMessenger\Model\Attachment\VideoAttachment;
use Gomoob\FacebookMessenger\Model\Payload\VideoAttachmentPayload;

use PHPUnit\Framework\TestCase;

/**
 * Test case used to test the `VideoAttachmentMessage` class.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group VideoAttachmentMessageTest
 */
class VideoAttachmentMessageTest extends TestCase
{
    /**
     * Test method for the `create()` function.
     */
    public function testCreate()
    {
        $videoAttachmentMessage = VideoAttachmentMessage::create();
        $this->assertNotNull($videoAttachmentMessage);
    }

    /**
     * Test method for the `getAttachment()` and `setAttachment($attachment)` functions.
     */
    public function testGetSetAttachment()
    {
        $videoAttachmentMessage = VideoAttachmentMessage::create();

        // Test with an attachment having a bad type
        try {
            $videoAttachmentMessage->setAttachment(ImageAttachment::create());
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame(
                'The \'attachment\' associated to a video attachment message must be intance of class ' .
                '\'VideoAttachment\' !',
                $fmex->getMessage()
            );
        }

        $attachment = VideoAttachment::create();

        $this->assertNull($videoAttachmentMessage->getAttachment());
        $this->assertSame($videoAttachmentMessage, $videoAttachmentMessage->setAttachment($attachment));
        $this->assertSame($attachment, $videoAttachmentMessage->getAttachment());
    }

    /**
     * Test method for the `jsonSerialize()` function.
     */
    public function testJsonSerialize()
    {
        $videoAttachmentMessage = VideoAttachmentMessage::create();

        // Test without the 'attachment' property
        try {
            $videoAttachmentMessage->jsonSerialize();
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame('The \'attachment\' property is not set !', $fmex->getMessage());
        }

        // Test with valid settings
        $videoAttachmentMessage->setAttachment(
            VideoAttachment::create()->setPayload(VideoAttachmentPayload::create()->setUrl('URL'))
        );

        $json = $videoAttachmentMessage->jsonSerialize();
        $this->assertCount(1, $json);
        $this->assertSame(
            [
                'type' => 'video',
                'payload' => [
                    'url' => 'URL'
                ]
            ],
            $json['attachment']
        );
    }
}
