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

use Gomoob\FacebookMessenger\Exception\FacebookMessengerException;

/**
 * Class which represents a Facebook Messenger button template payload.
 *
 * @author Arnaud Lavallée (arnaud.lavallee@gomoob.com)
 */
class ButtonTemplatePayload extends AbstractTemplatePayload {
	
	/**
	 * UTF-8 coded text with a maximum of 640 characters that appears above the buttons.
	 *
	 * @var string
	 */
	private $text;
	
	/**
	 * Set of 1 to 3 buttons that appear as calls to action.
	 *
	 * @var \Gomoob\FacebookMessenger\Model\ButtonInterface
	 */
	private $buttons = [];
	
	/**
	 * Set to false to disable the native sharing button in Messenger for the message template..
	 *
	 * @var boolean
	 */
	private $sharable;
	
	/**
	 * Utility function used to create a new instance of the <tt>ButtonTemplatePayload</tt> class.
	 *
	 * @return \Gomoob\FacebookMessenger\Model\Message\ButtonTemplatePayload the new created instance.
	 */
	public static function create()
	{
		return new ButtonTemplatePayload();
	}

	/**
	 * Gets the buttons to display.
	 *
	 * @return \Gomoob\FacebookMessenger\Model\ButtonInterface The buttons to display.
	 */
	public function getButtons() {
		return $this->buttons;
	}
	
	/**
	 * Defines if the message is shareable.
	 *
	 * @return boolean True if the message is shareable.
	 */
	public function isSharable() {
		return $this->sharable;
	}
	
	/**
	 * Gets the template type of the payload.
	 *
	 * @return \Gomoob\FacebookMessenger\Model\PayloadInterface The template type of the payload.
	 */
	public function getText() {
		return $this->text;
	}

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        // The 'text' and 'buttons' properties must have been defined
        if(!isset($this->text) && !isset($this->buttons)) {
            throw new FacebookMessengerException('None of the \'text\' and \'buttons\' properties are not set !');
        }
        
        // The template type must have been defined
        if($this->getTemplateType() === null) {
            throw new FacebookMessengerException('The \'templateType\' property is not set !');
        }

        return [
            'text' => $this->text,
        	'template_type' => $this->getTemplateType(),
        	'buttons' => $this->buttons
        ];
    }
	
	/**
	 * Set the buttons to display.
	 *
	 * @param \Gomoob\FacebookMessenger\Model\ButtonInterface[] $buttons the buttons to display.
	 */
	public function setButtons($buttons) {
		$this->buttons = $buttons;
		return $this;
	}
	
	/**
	 * Set the sharable option to define if the message is sharable.
	 *
	 * @param string $sharable the template type of the payload.
	 */
	public function setSharable($sharable) {
		$this->sharable = $sharable;
		return $this;
	}
	
	/**
	 * Set the text to display above the buttons.
	 *
	 * @param string $text the text to display above the buttons.
	 */
	public function setText($text) {
		$this->text = $text;
		return $this;
	}
	
	
	
	
}