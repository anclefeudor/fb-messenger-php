<?php

namespace pimax\Messages;
/**
 * Class QuickReply
 *
 * @package pimax\Messages
 */
class QuickReply extends Message{
	
	/**
     * Quick reply text type
     */
    const TYPE_TEXT = "text";

    /**
     * Quick reply attachment type
     */
    const TYPE_ATTACHMENT = "attachment";
	
	/**
     * @var array
     */
    protected $quick_replies = null;
	
	/**
     * @var array
     */
    protected $attachment = null;

	/**
     * @var string
     */
    protected $type = null;

    /**
     * Message constructor.
     *
     * @param $recipient
     * @param $text - string
     * @param $quick_replies - array of array("content_type","title","payload"),..,..
     * @param $type - string
     */
    public function __construct($recipient, $data, $quick_replies, $type = self::TYPE_TEXT)
    {
		$this->type = $type;

		switch ($type)
        {
            case self::TYPE_TEXT:
               parent::__construct($recipient, $data, $quick_replies);
            break;

            case self::TYPE_ATTACHMENT:
                parent::__construct($recipient, "", $quick_replies);
		        $this->attachment = $data;
            break;
        } 
    }

	/**
     * Get message data
     *
     * @return array
     */
    public function getData() {
	
		$result = [
            'recipient' =>  [
                'id' => $this->recipient
            ],
            'message' => [
                'quick_replies' => $this->quick_replies
            ]
        ];
	
		switch ($this->type)
        {
            case self::TYPE_TEXT:
                $result['message']['text'] = $this->text;
            break;

            case self::TYPE_ATTACHMENT:
                $result['message']['attachment'] = $this->attachment;
            break;
        }
	
        return $result;
    }
}

