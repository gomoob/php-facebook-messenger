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
namespace Gomoob\FacebookMessenger\Model\QuickReply;

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

use PHPUnit\Framework\TestCase;

/**
 * Test case used to test the `TextQuickReply` class.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group TextQuickReplyTest
 */
class TextQuickReplyTest extends TestCase
{
    /**
     * Test method for the `create()` function.
     */
    public function testCreate()
    {
        $textQuickReply = TextQuickReply::create();
        $this->assertNotNull($textQuickReply);
    }

    /**
     * Test method for the `getImageUrl()` and `setImageUrl($imageUrl)` functions.
     */
    public function testGetSetImageUrl()
    {
        $textQuickReply = new TextQuickReply();
        $this->assertNull($textQuickReply->getImageUrl());
        $this->assertSame($textQuickReply, $textQuickReply->setImageUrl('IMAGE_URL'));
        $this->assertSame('IMAGE_URL', $textQuickReply->getImageUrl());
    }

    /**
     * Test method for the `getPayload()` and `setPayload($payload)` functions.
     */
    public function testGetSetPayload()
    {
        $textQuickReply = new TextQuickReply();
        $this->assertNull($textQuickReply->getPayload());
        $this->assertSame($textQuickReply, $textQuickReply->setPayload('PAYLOAD'));
        $this->assertSame('PAYLOAD', $textQuickReply->getPayload());
    }

    /**
     * Test method for the `getTitle()` and `setTitle($title)` functions.
     */
    public function testGetSetTitle()
    {
        $textQuickReply = new TextQuickReply();
        $this->assertNull($textQuickReply->getTitle());
        $this->assertSame($textQuickReply, $textQuickReply->setTitle('TITLE'));
        $this->assertSame('TITLE', $textQuickReply->getTitle());
    }

    /**
     * Test method for the `jsonSerialize()` function.
     */
    public function testJsonSerialize()
    {
        $locationQuickReply = new TextQuickReply();

        // Test without the 'title' property
        try {
            $locationQuickReply->jsonSerialize();
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame('The \'title\' property is not set !', $fmex->getMessage());
        }

        // Test with only the 'title' property
        $locationQuickReply->setTitle('TITLE');

        $json = $locationQuickReply->jsonSerialize();
        $this->assertCount(2, $json);
        $this->assertSame('text', $json['content_type']);
        $this->assertSame('TITLE', $json['title']);

        // Test with the 'title' and the 'payload' properties
        $locationQuickReply->setPayload('PAYLOAD');

        $json = $locationQuickReply->jsonSerialize();
        $this->assertCount(3, $json);
        $this->assertSame('text', $json['content_type']);
        $this->assertSame('TITLE', $json['title']);
        $this->assertSame('PAYLOAD', $json['payload']);

        // Test with the 'title', 'payload' and 'imageUrl' properties
        $locationQuickReply->setImageUrl('IMAGE_URL');

        $json = $locationQuickReply->jsonSerialize();
        $this->assertCount(4, $json);
        $this->assertSame('text', $json['content_type']);
        $this->assertSame('TITLE', $json['title']);
        $this->assertSame('PAYLOAD', $json['payload']);
        $this->assertSame('IMAGE_URL', $json['image_url']);
    }
}
