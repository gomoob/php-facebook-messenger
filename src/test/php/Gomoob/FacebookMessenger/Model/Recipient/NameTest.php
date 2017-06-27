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

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

use PHPUnit\Framework\TestCase;

/**
 * Test case used to test the `Name` class.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @group NameTest
 */
class NameTest extends TestCase
{
    /**
     * Test method for the `getFirstName()` and `setFirstName($firstName)` functions.
     */
    public function testGetSetFirstNameandLastName()
    {
        $name = new Name();

        $this->assertNull($name->getFirstName());
        $this->assertNull($name->getLastName());

        $this->assertSame($name, $name->setFirstName('Toto'));
        $this->assertSame($name, $name->setLastName('Tata'));
        $this->assertSame('Toto', $name->getFirstName());
        $this->assertSame('Tata', $name->getLastName());
    }

    /**
     * Test method for the `jsonSerialize()` function.
     */
    public function testJsonSerialize()
    {
        $name = new Name();

        // Test without the 'firstName' and 'lastName' property
        try {
            $name->jsonSerialize();
            $this->fail('Must have thrown a FacebookMessengerException !');
        } catch (FacebookMessengerException $fmex) {
            $this->assertSame('None of the \'firstName\' and \'lastName\' properties are set !', $fmex->getMessage());
        }

        // Test with valid settings
        $name->setFirstName('Toto');
        $name->setLastName('Tata');

        $json = $name->jsonSerialize();
        $this->assertCount(2, $json);
        $this->assertSame('Toto', $json['first_name']);
        $this->assertSame('Tata', $json['last_name']);
    }
}
