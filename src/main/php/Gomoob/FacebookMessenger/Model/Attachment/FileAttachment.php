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
 *   disclaimer.
 *
 * * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following
 *   disclaimer in the documentation and/or other materials provided with the distribution.
 *
 * * Neither the name of the copyright holder nor the names of its contributors may be used to endorse or promote
 *   products derived from this software without specific prior written permission.
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

/**
 * Class which represents a Facebook Messenger file attachment.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference/file-attachment
 */
class FileAttachment extends AbstractAttachment
{
    /**
     * Utility function used to create a new instance of the <tt>FileAttachment</tt> class.
     *
     * @return \Gomoob\FacebookMessenger\Model\Attachment\FileAttachment the new created instance.
     */
    public static function create()
    {
        return new FileAttachment();
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        // The 'payload' property must have been defined
        if (!isset($this->payload)) {
            throw new FacebookMessengerException('The \'payload\' property is not set !');
        }

        return [
            'type' => 'file',
            'payload' => $this->payload->jsonSerialize()
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function doCheckPayloadType(/* PayloadInterface */ $payload)
    {
        // The payload must be an 'FileAttachmentPayload'
        if (!($payload instanceof FileAttachmentPayload)) {
            throw new FacebookMessengerException(
                'The \'payload\' attached to a file attachment must be intance of class \'FileAttachmentPayload\' !'
            );
        }
    }
}