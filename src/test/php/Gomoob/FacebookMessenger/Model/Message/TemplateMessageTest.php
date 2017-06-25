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

use Gomoob\FacebookMessenger\Model\Attachment\Attachment;
use Gomoob\FacebookMessenger\Model\Button\WebUrlButton;
use Gomoob\FacebookMessenger\Model\Payload\ButtonTemplatePayload;
use PHPUnit\Framework\TestCase;
use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

/**
 * Test case used to test the `TemplateMessage` class.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @group TemplateMessageTest
 */
class TemplateMessageTest extends TestCase
{
    /**
     * Test method for the `getAttachment()` and `setAttachment($attachment)` functions.
     * @group TemplateMessageTest.testGetSetAttachment
     */
    public function testGetSetAttachment() {
        $button = new WebUrlButton();
        $button->setTitle("Voir le moment");
        $button->setType('web_url');
        $button->setUrl("www.google.com");
        
        $payload = new ButtonTemplatePayload();
        $payload->setTemplateType('button');
        $payload->setText('Test');
        $payload->setButtons($button);
        
        $attachment = new Attachment();
        $attachment->setPayload($payload);
        $attachment->setType('template');

        $templateMessage = new TemplateMessage();
        $this->assertNull($templateMessage->getAttachment());
        $templateMessage->setAttachment($attachment);
        $this->assertSame($attachment, $templateMessage->getAttachment());
    }

    /**
     * Test method for the `jsonSerialize()` function.
     * @group TemplateMessageTest.testJsonSerialize
     */
    public function testJsonSerialize() {
    	$templateMessage = new TemplateMessage();
    	
    	// Test without the 'attachment' property
    	try {
    		$templateMessage->jsonSerialize();
    		$this->fail('Must have thrown a FacebookMessengerException !');
    	} catch (FacebookMessengerException $fmex) {
    		$this->assertSame('The \'attachment\' property is not set !', $fmex->getMessage());
    	}
    	$button = new WebUrlButton();
    	$button->setTitle('Voir le moment');
    	$button->setType('web_url');
    	$button->setUrl("www.google.com");
    	
    	$payload = new ButtonTemplatePayload();
    	$payload->setTemplateType('button');
    	$payload->setText("Payload de test");
    	$payload->setButtons($button);
    	
    	$buttonTemplatePayload = new ButtonTemplatePayload();
    	$buttonTemplatePayload->setTemplateType("button");
    	$buttonTemplatePayload->setText('ButtonTemplate payload test.');
    	$buttonTemplatePayload->setButtons($button);
    	
    	$attachment = new Attachment();
    	$attachment->setPayload($payload);
    	$attachment->setType('template');
    	$attachment->setPayload($buttonTemplatePayload);
    	
    	// Test with valid settings
    	$templateMessage->setAttachment($attachment);
    	
    	$json = $templateMessage->jsonSerialize();
    	$this->assertCount(1, $json);
    	$this->assertSame($attachment, $json['attachment']);
    	$this->assertSame("template", $json['attachment']->getType());
    	$this->assertSame("ButtonTemplate payload test.", $json['attachment']->getPayload()->getText());
    	$this->assertSame("button", $json['attachment']->getPayload()->getTemplateType());
    }
}