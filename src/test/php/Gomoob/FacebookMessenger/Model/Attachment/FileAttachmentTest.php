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
use Gomoob\FacebookMessenger\Model\Payload\FileAttachmentPayload;

use PHPUnit\Framework\TestCase;

/**
 * Test case used to test the `FileAttachment` class.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group FileAttachmentTest
 */
class FileAttachmentTest extends TestCase
{
    /**
     * Test method for the `create()` function.
     */
    public function testCreate()
    {
        $fileAttachment = FileAttachment::create();
        $this->assertNotNull($fileAttachment);
    }

    /**
     * Test method for the `getAttachment()` and `setAttachment($attachment)` functions.
     */
    public function testGetSetAttachment()
    {
        $fileAttachment = FileAttachment::create();

        // Test with an attachment having a bad typ
        try {
            $fileAttachment->setPayload(VideoAttachment::create());
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame(
                'The \'payload\' attached to a file attachment must be intance of class \'FileAttachmentPayload\' !',
                $fmex->getMessage()
            );
        }

        $payload = FileAttachmentPayload::create();

        $this->assertNull($fileAttachment->getPayload());
        $this->assertSame($fileAttachment, $fileAttachment->setPayload($payload));
        $this->assertSame($payload, $fileAttachment->getPayload());
    }

    /**
     * Test method for the `jsonSerialize()` function.
     */
    public function testJsonSerialize()
    {
        $fileAttachment = FileAttachment::create();

        // Test without the 'payload' property
        try {
            $fileAttachment->jsonSerialize();
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame('The \'payload\' property is not set !', $fmex->getMessage());
        }

        // Test with valid settings
        $fileAttachment->setPayload(FileAttachmentPayload::create()->setUrl('URL'));

        $json = $fileAttachment->jsonSerialize();
        $this->assertCount(2, $json);
        $this->assertSame('file', $json['type']);
        $this->assertSame(['url' => 'URL'], $json['payload']);
    }
}
