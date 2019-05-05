<?php

namespace Artooha\UniversalBot\Bot;

use Artooha\UniversalBot\Classes\Input;
use Artooha\UniversalBot\Interfaces\UniversalBotInterface;
use Artooha\UniversalBot\Traits\BotConstructorTrait;
use Artooha\UniversalBot\Traits\ConfigTrait;
use Artooha\UniversalBot\Traits\CurlRequestsTrait;
use Exception;

class ViberBot implements UniversalBotInterface
{
    use BotConstructorTrait, ConfigTrait, CurlRequestsTrait;

    const TYPE_TEXT = 'text';

    /** @var string $botName For indicating sender's name when posting messages */
    protected $botName = 'Viber Bot';
    protected $userId;
    protected $token;

    public function parseInput(string $input): Input
    {
        $result = new Input();

        $data = json_decode($input);

        $type = $data->message->type;
        switch ($type) {
            case 'sticker':
                $result->setType(Input::TYPE_STICKER);
                break;

            case 'picture':
                $result->setType(Input::TYPE_IMAGE);
                break;

            case 'text':
                $result->setType(Input::TYPE_MESSAGE);
                $result->setBody($data->message->text);
                break;

            case 'video':
                $result->setType(Input::TYPE_VIDEO);
                break;
        }

        return $result;
    }

    /**
     * @param string $text
     * @param array  $params
     * @return string
     * @throws Exception
     * @link https://developers.viber.com/docs/api/rest-bot-api/#send-message
     */
    public function sendMessage(string $text, array $params = []) : string
    {
        $result = $this->standardViberRequest('https://chatapi.viber.com/pa/send_message', [
            'receiver' => $this->userId,
            'sender' => [
                'name' => $this->botName,
                //'avatar' => '',
            ],
            'text' => $text,
        ]);

        return $result->message_token;
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
     * @param string $url
     * @param array  $data
     * @return array|mixed|\stdClass
     * @throws Exception
     */
    protected function standardViberRequest($url, array $data = [])
    {
        $result = $this->sendPostRequest($url, $data, [
            'Content-Type' => 'application/json',
            'X-Viber-Auth-Token' => $this->token,
        ]);

        if ($result->code != 200) {
            throw new Exception("Non-successful HTTP response code: {$result->code}\n{$result->response}");
        }

        $data = json_decode($result->response);
        if ($data->status > 0) {
            throw new Exception($data->status_message, $data->status);
        }

        /*
        OK response:

        {
          "status": 0,
          "status_message": "ok",
          "message_token": 5303153994370539487,
          "chat_hostname": "SN-CHAT-08_"
        }

        Error response:

        {
          "status": 999,
          "status_message": "Bad receiver ID",
          "message_token": 53031...547186,
          "chat_hostname": "SN-CHAT-08_"
        }
        */

        return $data;
    }
}
