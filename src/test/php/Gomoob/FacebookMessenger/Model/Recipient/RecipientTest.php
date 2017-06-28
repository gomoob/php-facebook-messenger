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
namespace Gomoob\FacebookMessenger\Model\Recipient;

use PHPUnit\Framework\TestCase;

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

/**
 * Test case used to test the `Recipient` class.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @group RecipientTest
 */
class RecipientTest extends TestCase
{
    /**
     * Test method for the `create()` function.
     */
    public function testCreate()
    {
        $recipient = Recipient::create();
        $this->assertNotNull($recipient);
    }

    /**
     * Test method for the `getId()` and `setId($id)` functions.
     */
    public function testGetSetId()
    {
        $recipient = new Recipient();
        $this->assertNull($recipient->getId());
        $this->assertSame($recipient, $recipient->setId('ID'));
        $this->assertSame('ID', $recipient->getId());
    }

    /**
     * Test method for the `getName()` and `setName($name)` functions.
     */
    public function testGetSetName()
    {
        $recipient = new Recipient();
        $name = new Name();

        $this->assertNull($recipient->getName());

        $recipient->setName($name);

        $this->assertSame($name, $recipient->getName());
    }

    /**
     * Test method for the `getPhoneNumber()` and `setPhoneNumber($phoneNumber)` functions.
     */
    public function testGetSetPhoneNumber()
    {
        $recipient = new Recipient();
        $this->assertNull($recipient->getPhoneNumber());
        $this->assertSame($recipient, $recipient->setPhoneNumber('0102030405'));
        $this->assertSame('0102030405', $recipient->getPhoneNumber());
    }

    /**
     * Test method for the `jsonSerialize()` function.
     */
    public function testJsonSerialize()
    {
        $recipient = new Recipient();

        // Test without the 'id' and 'phoneNumber' property
        try {
            $recipient->jsonSerialize();
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame('None of the \'id\' or \'phoneNumber\' properties are set !', $fmex->getMessage());
        }

        // Test with only the 'id'
        $recipient->setId('ID');

        $json = $recipient->jsonSerialize();
        $this->assertCount(1, $json);
        $this->assertSame('ID', $json['id']);

        // Test with only the 'phoneNumber'
        $recipient = new Recipient();
        $recipient->setPhoneNumber('0102030405');

        $json = $recipient->jsonSerialize();
        $this->assertCount(1, $json);
        $this->assertSame('0102030405', $json['phone_number']);

        // Test with the 'id' and 'phoneNumber'
        $recipient = new Recipient();
        $recipient->setId('ID');
        $recipient->setPhoneNumber('0102030405');

        $json = $recipient->jsonSerialize();
        $this->assertCount(2, $json);
        $this->assertSame('ID', $json['id']);
        $this->assertSame('0102030405', $json['phone_number']);

        // Test with the 'id' and 'phoneNumber' and 'name'
        $name = new Name();
        $name->setFirstName('John');
        $name->setLastName('Doe');
        $recipient->setName($name);

        $json = $recipient->jsonSerialize();
        $this->assertCount(3, $json);
        $this->assertSame('ID', $json['id']);
        $this->assertSame('0102030405', $json['phone_number']);
        $this->assertSame(['first_name' => 'John', 'last_name' => 'Doe'], $json['name']);
    }
}
