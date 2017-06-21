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
use Gomoob\FacebookMessenger\Model\AttachmentInterface;
use Gomoob\FacebookMessenger\Model\ImageMessageInterface;

/**
 * Class which represents a a Facebook Messenger image message.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @see https://developers.facebook.com/docs/messenger-platform/send-api-reference/image-attachment
 */
class ImageMessage extends AbstractMessage implements ImageMessageInterface
{

	/**
	 * The attachment of the image message.
	 * @var MessageInterface
	 */
	private $attachment;
	
	/**
	 * Utility function used to create a new instance of the <tt>ImageMessage</tt> class.
	 *
	 * @return \Gomoob\FacebookMessenger\Model\Message\ImageMessage the new created instance.
	 */
	public static function create()
	{
		return new ImageMessage();
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getAttachment() {
		return $this->attachment;
	}

	/**
	 * {@inheritDoc}
	 */
	public function jsonSerialize()
	{
		// The 'attachment' property must have been defined
		if(!isset($this->attachment)) {
			throw new FacebookMessengerException('The \'attachment\' property is not set !');
		}

		return [
		    'attachment' => $this->attachment
		];
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function setAttachment(/*AttachmentInterface*/ $attachment) {
		$this->attachment = $attachment;
		return $this;
	}
	
}