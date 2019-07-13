<?php

namespace Artooha\UniversalBot\Classes;

/**
 * Input items may come in bulk with webhooks (at least with Facebook),
 * so it's better to keep them in an array.
 *
 * Class InputContainer
 * @package Artooha\UniversalBot\Classes
 */
class InputContainer
{
    /**
     * @var array|Input[] $inputItems
     */
    protected $inputItems = [];

    /**
     * @param Input $object
     */
    public function addInputObject(Input $object)
    {
        $this->inputItems[] = $object;
    }

    /**
     * @return array|Input[]
     */
    public function getInputObjects()
    {
        return $this->inputItems;
    }
}
