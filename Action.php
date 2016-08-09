<?php

namespace pimax;


/**
 * Class Action
 *
 * @package pimax\Action
 */
class Action
{
    /**
     * @var integer|null
     */
    protected $recipient = null;

    /**
     * @var string
     */
    protected $sender_action = null;

    /**
     * Action constructor.
     *
     * @param $recipient
     * @param $text
	 * @param $quick_replies
     */
    public function __construct($recipient, $sender_action)
    {
        $this->recipient = $recipient;
        $this->sender_action = $sender_action;
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
			'sender_action' => $this->sender_action
        ];
		
        return $result;
    }
}