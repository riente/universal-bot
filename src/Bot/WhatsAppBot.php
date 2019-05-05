<?php

namespace Artooha\UniversalBot\Bot;

use Artooha\UniversalBot\Classes\Input;
use Artooha\UniversalBot\Interfaces\UniversalBotInterface;
use Artooha\UniversalBot\Traits\BotConstructorTrait;
use Artooha\UniversalBot\Traits\CacheTrait;
use Artooha\UniversalBot\Traits\ConfigTrait;
use Artooha\UniversalBot\Traits\CurlRequestsTrait;

class WhatsAppBot implements UniversalBotInterface
{
    use BotConstructorTrait, CacheTrait, ConfigTrait, CurlRequestsTrait;

    protected $login;
    protected $password;
    protected $appUrl;
    protected $appPort;

    private $token;

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

    /**
     * @todo
     * @return \stdClass
     * @link https://developers.facebook.com/docs/whatsapp/api/users/login
     */
    protected function auth()
    {
        /*
         * All generated tokens expire in 7 days.
         */

        $result = new \stdClass();

        return $result;
    }

    protected function getToken()
    {
        // todo
    }
}
