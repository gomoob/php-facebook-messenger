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
namespace Gomoob\FacebookMessenger\Model\Payload;

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

use PHPUnit\Framework\TestCase;

/**
 * Test case used to test the `AudioAttachmentPayload` class.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group AudioAttachmentPayloadTest
 */
class AudioAttachmentPayloadTest extends TestCase
{
    /**
     * Test method for the `create()` function.
     */
    public function testCreate()
    {
        $audioAttachmentPayload = AudioAttachmentPayload::create();
        $this->assertNotNull($audioAttachmentPayload);
    }

    /**
     * Test method for the `getUrl()` and `setUrl($url)` functions.
     */
    public function testGetSetUrl()
    {
        $videoAttachmentPayload = new AudioAttachmentPayload();
        $this->assertNull($videoAttachmentPayload->getUrl());
        $this->assertSame($videoAttachmentPayload, $videoAttachmentPayload->setUrl('URL'));
        $this->assertSame('URL', $videoAttachmentPayload->getUrl());
    }

    /**
     * Test method for the `jsonSerialize()` function.
     */
    public function testJsonSerialize()
    {
        $videoAttachmentPayload = new AudioAttachmentPayload();

        // Test without the 'url' property
        try {
            $videoAttachmentPayload->jsonSerialize();
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame('The \'url\' property is not set !', $fmex->getMessage());
        }

        // Test with valid settings
        $videoAttachmentPayload->setUrl('URL');

        $json = $videoAttachmentPayload->jsonSerialize();
        $this->assertCount(1, $json);
        $this->assertSame('URL', $json['url']);
    }
}
