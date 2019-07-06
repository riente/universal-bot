<?php

namespace Artooha\UniversalBot\Classes;

/**
 * Class Input
 *
 * @package Artooha\UniversalBot\Classes
 *
 * @method mixed getUserId()
 * @method mixed setUserId($userId)
 * @method mixed getUserName()
 * @method mixed setUserName($userName)
 * @method mixed getChatId()
 * @method mixed setChatId($chatId)
 * @method mixed getBody()
 * @method mixed setBody($body)
 * @method mixed getType()
 * @method mixed setType($type)
 * @method mixed getMessageId()
 * @method mixed setMessageId($id)
 * @method mixed setHasAudios($value)
 * @method mixed setHasFiles($value)
 * @method mixed setHasImages($value)
 * @method mixed setHasVideos($value)
 */
class Input
{
    const TYPE_AUDIO = 'audio';
    const TYPE_IMAGE = 'image';
    const TYPE_FILE = 'file';
    const TYPE_MESSAGE = 'message';
    const TYPE_STICKER = 'sticker';
    const TYPE_VIDEO = 'video';

    const TYPE_COMMAND = 'command';

    /**
     * @var mixed $userId User ID of the person who sent the message. It will be the recipient when sending.
     *                    References: user_id (VK), recipient.id (i.e. page scoped user ID, Facebook),
     *                    recipient_id (Skype), receiver (Viber), from (Telegram), from (WhatsApp).
     */
    protected $userId;

    /**
     * @var mixed $chatId ID of the conversation where the message came from.
     *                    References: peer_id (VK), chat_id (Telegram),
     *                    conversation_id (Skype), group_id (WhatsApp).
     *                    In Telegram chat_id is used to send messages, it's mostly the same as user_id.
     */
    protected $chatId;

    /**
     * @var string $userName Some messengers provide a user name with messages.
     */
    protected $userName;

    protected $type;
    protected $messageId;
    protected $body;

    protected $hasAudios = false;
    protected $hasFiles = false;
    protected $hasImages = false;
    protected $hasVideos = false;

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (preg_match('/^(g|s)et([A-Z][A-Za-z0-9]*)$/', $name, $matches)) {
            $property = $matches[2];
            $property = lcfirst($property);

            if (property_exists($this, $property)) {
                if ($matches[1] == 'g') {
                    return $this->$property;
                } elseif (count($arguments) > 0) {
                    $this->$property = $arguments[0];
                } else {
                    $this->$property = null;
                }

                return $this->$property;
            }
        }

        return null;
    }

    /**
     * @return bool
     */
    public function hasAudios()
    {
        return $this->hasAudios;
    }

    /**
     * @return bool
     */
    public function hasFiles()
    {
        return $this->hasFiles;
    }

    /**
     * @return bool
     */
    public function hasImages()
    {
        return $this->hasImages;
    }

    /**
     * @return bool
     */
    public function hasVideos()
    {
        return $this->hasVideos;
    }

    /**
     * @return bool
     */
    public function isCommand()
    {
        return self::TYPE_COMMAND == $this->type;
    }

    /**
     * @return bool
     */
    public function isSticker()
    {
        return self::TYPE_STICKER == $this->type;
    }
}
