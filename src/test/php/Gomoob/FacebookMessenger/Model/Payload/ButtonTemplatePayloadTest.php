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

use PHPUnit\Framework\TestCase;

use Gomoob\FacebookMessenger\Model\Button\WebUrlButton;
use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

/**
 * Test case used to test the `ButtonTemplatePayload` class.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 * @group ButtonTemplatePayloadTest
 */
class ButtonTemplatePayloadTest extends TestCase
{
    /**
     * Test method for the `getTemplateType()` and `setTemplateType($templateType)` functions.
     */
    public function testGetSetTemplateType()
    {
        $buttonTemplatePayload = new ButtonTemplatePayload();
        $button = new WebUrlButton();
        $button->setTitle("Voir le Moment");
        $button->setUrl("www.google.com");
        $button->setType("web_url");

        $buttonTemplatePayload->setText('Template message button test.');
        $buttonTemplatePayload->setSharable(false);
        $buttonTemplatePayload->setButtons($button);

        $this->assertSame("Template message button test.", $buttonTemplatePayload->getText());
        $this->assertSame(false, $buttonTemplatePayload->isSharable());
    }

    /**
     * Test method for the `jsonSerialize()` function.
     */
    public function testJsonSerialize()
    {

        $buttonTemplatePayload = new ButtonTemplatePayload();

        // Test with valid settings
        $button = new WebUrlButton();
        $button->setTitle('Voir le moment');
        $button->setType('web_url');
        $button->setUrl("www.google.com");

        $buttonTemplatePayload->setText('ButtonTemplate payload test.');
        $buttonTemplatePayload->setButtons($button);


        $json = $buttonTemplatePayload->jsonSerialize();
        $this->assertCount(3, $json);
    }
}
