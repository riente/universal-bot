<?php

namespace Artooha\UniversalBot\Bot;

use Artooha\UniversalBot\Classes\Input;
use Artooha\UniversalBot\Classes\InputContainer;
use Artooha\UniversalBot\Interfaces\UniversalBotInterface;
use Artooha\UniversalBot\Traits\BotConstructorTrait;
use Artooha\UniversalBot\Traits\ConfigTrait;
use Artooha\UniversalBot\Traits\CurlRequestsTrait;
use Exception;

class FacebookBot implements UniversalBotInterface
{
    use BotConstructorTrait, ConfigTrait, CurlRequestsTrait;

    const API_ENDPOINT = 'https://graph.facebook.com/v3.3/me';

    protected $token;
    protected $userId;

    public function parseInput(string $input): InputContainer
    {
        $data = json_decode($input);
        $container = new InputContainer();

        if ($data->object === 'page') {
            // Iterates over each entry - there may be multiple if batched
            foreach ($data->entry as $entry) {
                $message = $entry->messaging[0];
                $result = new Input();

                $result->setUserId($message->sender->id);
                $result->setChatId($message->sender->id);
                $result->setBody($message->message->text);
                $result->setMessageId($message->message->mid);
                $result->setUserName('Facebook PSID#'.$message->sender->id);

                $container->addInputObject($result);
            }
        }

        return $container;
    }

    /**
     * @param string $text
     * @param array  $params
     * @return string
     * @throws Exception
     */
    public function sendMessage(string $text, array $params = []) : string
    {
        $url = self::API_ENDPOINT.'/messages?access_token='.$this->token;
        $params = [
            'recipient' => [
                'id' => $this->userId,
            ],
            'message' => [
                'text' => $text,
            ],
        ];

        $response = $this->sendPostRequest($url, $params, [
            'Content-Type: application/json',
        ]);
        $data = json_decode($response->body);

        if (empty($data)) {
            throw new Exception('Empty or incorrect response.');
        }

        return (string) $data->message_id;
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
