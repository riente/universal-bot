<?php

namespace Artooha\UniversalBot\Bot;

use Artooha\UniversalBot\Classes\Input;
use Artooha\UniversalBot\Interfaces\UniversalBotInterface;
use Artooha\UniversalBot\Traits\BotConstructorTrait;
use Artooha\UniversalBot\Traits\ConfigTrait;

class FacebookBot implements UniversalBotInterface
{
    use BotConstructorTrait, ConfigTrait;

    protected $token;

    public function parseInput(string $input): Input
    {
        // TODO: Implement parseInput() method.
    }

    public function sendMessage(string $text, array $params = []) : string
    {
        // TODO: Implement sendMessage() method.
    }

    public function sendKeyboard()
    {
        // TODO: Implement sendKeyboard() method.
    }

    public function sendImage()
    {
        // TODO: Implement sendImage() method.
    }

    public function stickerOk()
    {
        // TODO: Implement stickerOk() method.
    }

    public function stickerThumbUp()
    {
        // TODO: Implement stickerThumbUp() method.
    }

    public function stickerThumbDown()
    {
        // TODO: Implement stickerThumbDown() method.
    }
}
