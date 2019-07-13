<?php

namespace Artooha\UniversalBot\Bot;

use Artooha\UniversalBot\Classes\InputContainer;
use Artooha\UniversalBot\Interfaces\UniversalBotInterface;
use Artooha\UniversalBot\Traits\BotConstructorTrait;
use Artooha\UniversalBot\Traits\CacheTrait;
use Artooha\UniversalBot\Traits\ConfigTrait;
use Artooha\UniversalBot\Traits\CurlRequestsTrait;
use stdClass;

class SkypeBot implements UniversalBotInterface
{
    use BotConstructorTrait, CacheTrait, ConfigTrait, CurlRequestsTrait;

    protected $botUserId;
    protected $botUserName;
    protected $microsoftAppId;
    protected $microsoftAppPassword;

    private $token;

    public function parseInput(string $input): InputContainer
    {
        // TODO: Implement parseInput() method.

        return new InputContainer();
    }

    /**
     * @param string $text
     * @param array  $params
     * @throws \Exception
     */
    public function sendMessage(string $text, array $params = []) : string
    {
        // TODO: use method like skypeRequest() instead of generating headers in every method
        $headers = [
            'Authorization: Bearer '.$this->getToken(),
        ];

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
     * @return stdClass
     * @throws \Exception
     */
    protected function auth() : stdClass
    {
        $response = $this->sendPostRequest(
            'https://login.microsoftonline.com/botframework.com/oauth2/v2.0/token',
            [
                'grant_type' => 'client_credentials',
                'client_id' => $this->microsoftAppId,
                'client_secret' => $this->microsoftAppPassword,
                'scope' => 'https://api.botframework.com/.default',
            ]
            // No headers, so we avoid double encoding and thus errors
        );

        $data = json_decode($response->body, true);

        if (!isset($data['access_token'])) {
            $error = $data['error_description'] ?? $data['error'] ?? json_encode($data);
            throw new \Exception('Failed to refresh Skype access token: '.$error);
        }

        $token = $data['access_token'];
        $expiration = (int) $data['expires_in'];
        if ($expiration > 1800) {
            $expiration -= 600;
        }

        $result = new stdClass();
        $result->token = $token;
        $result->expiresIn = $expiration;

        return $result;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    protected function getToken()
    {
        if (!empty($this->token)) {
            return $this->token;
        }

        $this->token = $this->cacheGet('token.skype');

        if (empty($this->token)) {
            $tokenData = $this->auth();
            $this->cacheSet('token.skype', $tokenData->token, $tokenData->expiresIn);
            $this->token = $tokenData->token;
        }

        return $this->token;
    }
}
