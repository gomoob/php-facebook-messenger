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
use Gomoob\FacebookMessenger\Model\Message\TextMessage;

use PHPUnit\Framework\TestCase;
use Gomoob\FacebookMessenger\Model\Button\WebUrlButton;
use Gomoob\FacebookMessenger\Model\Payload\ButtonTemplatePayload;

/**
 * Test case used to test the `Attachment` class.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @group WebUrlButtonTest
 */
class AttachmentTest extends TestCase
{
    /**
     * Test method for the `getType()` and `setType($type)` functions.
     */
    public function testGetSetType()
    {
        $button = new WebUrlButton();
        $button->setTitle('Voir le moment');
        $button->setType('web_url');
        $button->setUrl("www.google.com");
        
        $button2 = new WebUrlButton();
        $button2->setTitle('Mon compte');
        $button2->setType('web_url');
        $button2->setUrl("www.google.com");
        
        $buttons[] = $button;
        $buttons[] = $button2;
        
        $buttonTemplatePayload = new ButtonTemplatePayload();
        $buttonTemplatePayload->setTemplateType("button");
        $buttonTemplatePayload->setText('ButtonTemplate payload test.');
        $buttonTemplatePayload->setButtons($buttons);
        
        $attachment = new Attachment();
        $attachment->setPayload($buttonTemplatePayload);
        $attachment->setType('template');
        $this->assertSame($buttonTemplatePayload, $attachment->getPayload());
        $this->assertSame("template", $attachment->getType());
    }

    /**
     * Test method for the `jsonSerialize()` function.
     */
    public function testJsonSerialize()
    {
    	$attachment = new Attachment();
    	
    	// Test without the 'payload' and 'type' property
    	try {
    		$attachment->jsonSerialize();
    		$this->fail('Must have thrown a FacebookMessengerException !');
    	} catch (FacebookMessengerException $fmex) {
    		$this->assertSame('None of the \'type\' and \'payload\' properties are not set !', $fmex->getMessage());
    	}
    	
    	// Test with valid settings
    	$button = new WebUrlButton();
    	$button->setTitle('Voir le moment');
    	$button->setType('web_url');
    	$button->setUrl("www.google.com");
    	
    	$button2 = new WebUrlButton();
    	$button2->setTitle('Mon compte');
    	$button2->setType('web_url');
    	$button2->setUrl("www.google.com");
    	
    	$buttons[] = $button;
    	$buttons[] = $button2;
    	
    	$buttonTemplatePayload = new ButtonTemplatePayload();
    	$buttonTemplatePayload->setTemplateType("button");
    	$buttonTemplatePayload->setText('ButtonTemplate payload test.');
    	$buttonTemplatePayload->setButtons($buttons);
    	
    	$attachment->setPayload($buttonTemplatePayload);
    	$attachment->setType('template');
    	
    	$json = $attachment->jsonSerialize();
    	$this->assertCount(2, $json);
    	$this->assertSame($buttonTemplatePayload, $json['payload']);
    	$this->assertSame('template', $json['type']);
    }
}