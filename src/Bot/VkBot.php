<?php

namespace Artooha\UniversalBot\Bot;

use Artooha\UniversalBot\Classes\Input;
use Artooha\UniversalBot\Interfaces\UniversalBotInterface;
use Artooha\UniversalBot\Traits\BotConstructorTrait;
use Artooha\UniversalBot\Traits\ConfigTrait;
use Artooha\UniversalBot\Traits\CurlRequestsTrait;
use Exception;

class VkBot implements UniversalBotInterface
{
    use BotConstructorTrait, ConfigTrait, CurlRequestsTrait;

    const API_ENDPOINT = 'https://api.vk.com/method/';
    const API_VERSION = '5.92';

    protected $peerId;
    protected $userId;
    protected $token;

    public function parseInput(string $input) : Input
    {
        $result = new Input();
        $data = json_decode($input);

        $result->setUserId($data->object->from_id);
        $result->setChatId($data->object->peer_id);
        $result->setBody($data->object->text);
        $result->setMessageId($data->object->id ?? $data->object->conversation_message_id ?? 0); // May be improved
        $result->setUserName('VK user #'.$data->object->from_id); // We can get it from a separate API call

        // TODO: check secret, test reply and forward messages

        return $result;
    }

    /**
     * @param string $text
     * @param array  $params
     * @return string
     * @throws Exception
     * @link https://vk.com/dev/messages.send
     */
    public function sendMessage(string $text, array $params = []) : string
    {
        // random_id is a required parameter
        $randomId = $params['messageId'] ?? str_replace(' ', '', microtime());

        $request = $this->sendGetRequest(self::API_ENDPOINT.'messages.send', [
            'peer_id' => $this->peerId,
            'random_id' => $randomId,
            'message' => $text,
            'user_id' => $this->userId,

            'access_token' => $this->token,
            'v' => self::API_VERSION,
        ]);

        $data = json_decode($request->body);
        if (empty($data)) {
            throw new Exception('Empty or incorrect response.');
        }

        return (string) $data->response;
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