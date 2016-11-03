<?php

namespace pimax\Messages;

/**
 * Class MessageButton
 * @package pimax\Messages
 */
class MessageButton
{
    /**
     * Web url button type
     */
    const TYPE_WEB = "web_url";

    /**
     * Postback button type
     */
    const TYPE_POSTBACK = "postback";

	/**
     * Account linking button type
     */
    const TYPE_ACCOUNT_LINK = "account_link";

	/**
     * Share button type
     */
    const TYPE_SHARE = "element_share";

    /**
     * Button type
     *
     * @var string|null
     */
    protected $type = null;

    /**
     * Button title
     *
     * @var string|null
     */
    protected $title = null;

    /**
     * Button url
     *
     * @var null|string
     */
    protected $url = null;

	/**
     * Button webview_height_ratio
     *
     * @var null|compact|tall|full
     */
    protected $webview_height_ratio = null;

	/**
     * Button messenger_extensions
     *
     * @var null|true|false
     */
    protected $messenger_extensions = null;

	/**
     * Button fallback_url
     *
     * @var null|string
     */
    protected $fallback_url = null;

    /**
     * MessageButton constructor.
     *
     * @param $type Type
     * @param $title Title
     * @param string $url Url or postback
	* @param string $webview_height_ratio Height of the Webview. compact, tall, full
	* @param string $messenger_extensions Must be true if using Messenger Extensions.
	* @param string $fallback_url URL to use on clients that don't support Messenger Extensions. If this is not defined, the url will be used as the fallback.
     */
    public function __construct($type, $title, $url = '', $webview_height_ratio = NULL, $messenger_extensions = NULL, $fallback_url = NULL)
    {
        $this->type = $type;
        $this->title = $title;

        if (!$url) {
            $url = $title;
        }

        $this->url = $url;

		if($type == self::TYPE_WEB){
			if($webview_height_ratio){$this->webview_height_ratio = $webview_height_ratio;}
			if($messenger_extensions){$this->messenger_extensions = $messenger_extensions;}
			if($fallback_url){$this->fallback_url = $fallback_url;}
		}

    }

    /**
     * Get Button data
     * 
     * @return array
     */
    public function getData()
    {
        $result = [
            'type' => $this->type
        ];

        switch($this->type)
        {
            case self::TYPE_POSTBACK:
                $result['payload'] = $this->url;
				$result['title'] = $this->title;
            break;

            case self::TYPE_WEB:
                $result['url'] = $this->url;
				$result['title'] = $this->title;
				if($this->webview_height_ratio){
					$result['webview_height_ratio'] = $this->webview_height_ratio;
				}
				if($this->messenger_extensions){
					$result['messenger_extensions'] = $this->messenger_extensions;
				}
				if($this->fallback_url){
					$result['fallback_url'] = $this->fallback_url;
				}
            break;

			case self::TYPE_ACCOUNT_LINK:
                $result['url'] = $this->url;
            break;
			case self::TYPE_SHARE:
            break;
        }

        return $result;
    }
}