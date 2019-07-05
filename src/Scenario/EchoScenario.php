<?php

namespace Artooha\UniversalBot\Scenario;

use Artooha\UniversalBot\Classes\Input;
use Artooha\UniversalBot\Interfaces\ScenarioInterface;
use Artooha\UniversalBot\Interfaces\UniversalBotInterface;

class EchoScenario implements ScenarioInterface
{
    protected $bot;
    protected $params = [];

    /**
     * EchoScenario constructor.
     *
     * @param UniversalBotInterface $bot
     * @param array                 $params Additional params you may want to pass to scenario
     */
    public function __construct(UniversalBotInterface $bot, array $params = [])
    {
        $this->bot = $bot;
        $this->params = $params;
    }

    /**
     * @param Input|null $input
     * @return mixed|void
     */
    public function run(Input $input = null)
    {
        if (empty($input)) {
            $data = file_get_contents('php://input');
            $input = $this->bot->parseInput($data);

            $this->bot->setConfig([
                'chatId' => $input->getChatId(),
                'userId' => $input->getUserId(),
            ]);
        }

        $this->bot->sendMessage('You said "'.$input->getBody().'"');
    }
}