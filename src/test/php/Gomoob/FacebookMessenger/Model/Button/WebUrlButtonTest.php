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
use Gomoob\FacebookMessenger\Model\Message\TextMessage;

use PHPUnit\Framework\TestCase;
use Gomoob\FacebookMessenger\Model\Button\WebUrlButton;

/**
 * Test case used to test the `WebUrlButton` class.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @group WebUrlButtonTest
 */
class WebUrlButtonTest extends TestCase
{
    /**
     * Test method for the `getType()` and `setType($type)` functions.
     */
    public function testGetSetType()
    {
        $webUrlButton = new WebUrlButton();
        $webUrlButton->setType("web_url");
        $this->assertSame("web_url", $webUrlButton->getType());
    }

    /**
     * Test method for the `jsonSerialize()` function.
     */
    public function testJsonSerialize()
    {
    	$webUrlButton = new WebUrlButton();
    	
    	// Test without the 'type' and 'title' property
    	try {
    		$webUrlButton->jsonSerialize();
    		$this->fail('Must have thrown a FacebookMessengerException !');
    	} catch (FacebookMessengerException $fmex) {
    		$this->assertSame('None of the \'type\', \'title\' or \'url\' properties are set !', $fmex->getMessage());
    	}
    	
    	// Test with valid settings
    	$webUrlButton->setType('web_url');
    	$webUrlButton->setTitle("Vor le moment");
    	$webUrlButton->setUrl("www.google.com");
    	
    	$json = $webUrlButton->jsonSerialize();
    	$this->assertCount(3, $json);
    	$this->assertSame('web_url', $json['type']);
    }
}