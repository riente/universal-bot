<?php

namespace Artooha\UniversalBot\Traits;

use Artooha\UniversalBot\Classes\Input;

trait ConfigTrait
{
    function setConfig(array $config = [])
    {
        foreach ($config as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    function setConfigFromInput(Input $input)
    {
        $this->setConfig([
            'chatId' => $input->getChatId(),
            'userId' => $input->getUserId(),
        ]);
    }
}
