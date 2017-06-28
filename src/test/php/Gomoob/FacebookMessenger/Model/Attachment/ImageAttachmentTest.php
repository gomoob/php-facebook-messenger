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
namespace Gomoob\FacebookMessenger\Model\Attachment;

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;
use Gomoob\FacebookMessenger\Model\Payload\ImageAttachmentPayload;
use Gomoob\FacebookMessenger\Model\Payload\VideoAttachmentPayload;

use PHPUnit\Framework\TestCase;

/**
 * Test case used to test the `ImageAttachment` class.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group ImageAttachmentTest
 */
class ImageAttachmentTest extends TestCase
{
    /**
     * Test method for the `create()` function.
     */
    public function testCreate()
    {
        $imageAttachment = ImageAttachment::create();
        $this->assertNotNull($imageAttachment);
    }

    /**
     * Test method for the `getPayload()` and `setPayload($payload)` functions.
     */
    public function testGetSetPayload()
    {
        $imageAttachment = ImageAttachment::create();

        // Test with a payload having a bad type
        try {
            $imageAttachment->setPayload(VideoAttachmentPayload::create());
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame(
                'The \'payload\' attached to an image attachment must be intance of class \'ImageAttachmentPayload\' !',
                $fmex->getMessage()
            );
        }

        $payload = ImageAttachmentPayload::create();

        $this->assertNull($imageAttachment->getPayload());
        $this->assertSame($imageAttachment, $imageAttachment->setPayload($payload));
        $this->assertSame($payload, $imageAttachment->getPayload());
    }

    /**
     * Test method for the `jsonSerialize()` function.
     */
    public function testJsonSerialize()
    {
        $imageAttachment = ImageAttachment::create();

        // Test without the 'payload' property
        try {
            $imageAttachment->jsonSerialize();
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame('The \'payload\' property is not set !', $fmex->getMessage());
        }

        // Test with valid settings
        $imageAttachment->setPayload(ImageAttachmentPayload::create()->setUrl('URL'));

        $json = $imageAttachment->jsonSerialize();
        $this->assertCount(2, $json);
        $this->assertSame('image', $json['type']);
        $this->assertSame(['url' => 'URL'], $json['payload']);
    }
}
