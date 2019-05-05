<?php

namespace Artooha\UniversalBot\Interfaces;

use Artooha\UniversalBot\Classes\Input;

interface UniversalBotInterface
{
    const TYPE_TELEGRAM = 'telegram';
    const TYPE_VK = 'vk';
    const TYPE_WHATSAPP = 'whatsapp';
    const TYPE_VIBER = 'viber';
    const TYPE_FACEBOOK = 'facebook';
    const TYPE_SKYPE = 'skype';

    /**
     * @param CacheDriverInterface|null $cacheDriver Some messengers use authorization to obtain tokens,
     *                                               so we need a way to store them for some time.
     */
    public function __construct(CacheDriverInterface $cacheDriver = null);

    public function setConfig(array $config = []);
    public function parseInput(string $input) : Input;

    /**
     * @param string $text
     * @param array  $params Possible keys:
     *                       messageId - you can pass message ID from your DB or it'll be randomly generated
     * @return string Message ID from messenger (may be empty)
     */
    public function sendMessage(string $text, array $params = []) : string;
    public function sendKeyboard();
    public function sendImage();
    
    public function stickerOk();
    public function stickerThumbUp();
    public function stickerThumbDown();
}
