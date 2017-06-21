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
namespace Gomoob\FacebookMessenger\Model\Response;

use PHPUnit\Framework\TestCase;
use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

/**
 * Test case used to test the `Response` class.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @group ResponseTest
 */
class ResponseTest extends TestCase
{
    /**
     * Test method for the `getRecipientId()` and `setRecipientId($recipientId)` functions.
     */
    public function testGetSetRecipientIdAndMessageId()
    {
        $response = new Response();
        
        $this->assertNull($response->getRecipientId());
        
        $this->assertSame($response, $response->setRecipientId('1008372609250235'));
        $this->assertSame('1008372609250235', $response->getRecipientId());
    }

    /**
     * Test method for the `jsonSerialize()` function.
     */
    public function testJsonSerialize()
    {
    	$response = new Response();

        // Test without the 'recipientId' and 'messageId' properties
        try {
        	$response->jsonSerialize();
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame('The \'recipientId\' or \'messageId\' property is not set !', $fmex->getMessage());
        }

        // Test with valid settings
        $response->setRecipientId('1008372609250235');
        $response->setMessageId('mid.1456970487936:c34767dfe57ee6e339');

        $json = $response->jsonSerialize();
        $this->assertCount(2, $json);
        $this->assertSame('1008372609250235', $json['recipient_id']);
        $this->assertSame('mid.1456970487936:c34767dfe57ee6e339', $json['message_id']);
    }
}