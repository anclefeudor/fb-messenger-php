<?php

namespace pimax\Messages;


/**
 * Class Message
 *
 * @package pimax\Messages
 */
class Message
{
    /**
     * @var integer|null
     */
    protected $recipient = null;

    /**
     * @var string
     */
    protected $text = null;

	/**
     * @var string
     */
    protected $metadata = null;

	/**
     * @var array
     */
    protected $quick_replies = null;

    /**
     * Message constructor.
     *
     * @param $recipient
     * @param $text
	 * @param $quick_replies
     */
    public function __construct($recipient, $text, $quick_replies = null, $metadata = null)
    {
        $this->recipient = $recipient;
        $this->text = $text;
		$this->quick_replies = $quick_replies;
		$this->metadata = $metadata;
    }

    /**
     * Get message data
     *
     * @return array
     */
    public function getData()
    {
		$result = [
            'recipient' =>  [
                'id' => $this->recipient
            ],
            'message' => [
                'text' => $this->text
            ]
        ];

		if($this->quick_replies != null){
			$result['message']['quick_replies'] = $this->quick_replies;
		}
		
		if($this->metadata != null){
			$result['message']['metadata'] = $this->metadata;
		}
		
        return $result;
    }
}