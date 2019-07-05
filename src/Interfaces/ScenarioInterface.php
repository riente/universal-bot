<?php

namespace Artooha\UniversalBot\Interfaces;

use Artooha\UniversalBot\Classes\Input;

interface ScenarioInterface
{
    /**
     * @param UniversalBotInterface $bot    Should be already configured bot (i.e. with preset token, etc.)
     * @param array                 $params Additional params you may want to pass to scenario
     */
    public function __construct(UniversalBotInterface $bot, array $params = []);

    /**
     * @param Input|null $input  You might want to run other scenarios from the current one,
     *                           so not to parse the input data once again, you can pass it along.
     *                           Or simply use $bot->parseInput() from inside run().
     * @return mixed
     */
    public function run(Input $input = null);
}
