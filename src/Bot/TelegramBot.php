<?php

namespace Artooha\UniversalBot\Bot;

use Artooha\UniversalBot\Classes\Input;
use Artooha\UniversalBot\Interfaces\UniversalBotInterface;
use Artooha\UniversalBot\Traits\BotConstructorTrait;
use Artooha\UniversalBot\Traits\ConfigTrait;
use Artooha\UniversalBot\Traits\CurlRequestsTrait;

class TelegramBot implements UniversalBotInterface
{
    use BotConstructorTrait, ConfigTrait, CurlRequestsTrait;

    const API_ENDPOINT = 'https://api.telegram.org';

    protected $token;

    protected $chatId;

    /**
     * @param string $input
     * @return Input
     * @link https://core.telegram.org/bots/api#update
     */
    public function parseInput(string $input): Input
    {
        $result = new Input();
        $data = json_decode($input);

        $result->setUserId($data->from->id);
        $result->setChatId($data->chat->id);
        $result->setBody($data->text);

        return $result;
    }

    /**
     * @link https://core.telegram.org/bots/api#sendmessage
     * @param string $text
     * @param array  $params Additional params for message (like parse_mode, reply_to_message_id, etc.)
     * @return \stdClass
     */
    public function sendMessage(string $text, array $params = []) : string
    {
        $url = self::API_ENDPOINT.'/bot'.$this->token.'/sendMessage';

        $params = [
            'chat_id' => $this->chatId,
            'text' => $text,

            'parse_mode' => $params['parse_mode'] ?? 'HTML',
            'disable_web_page_preview' => $params['disable_web_page_preview'] ?? true,
        ];

        return $this->sendPostRequest($url, $params);
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
