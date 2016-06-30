<?php

namespace ApiAi;

/**
 * Class ActionMapping
 *
 * @package ApiAi
 */
abstract class ActionMapping
{
    /**
     * @param string $sessionId
     * @param string $action
     * @param array $parameters
     */
    abstract public function action($sessionId, $action, $parameters);

    /**
     * @param string $sessionId
     * @param string $speech
     */
    abstract public function speech($sessionId, $speech);

    /**
     * @param string $sessionId
     * @param \Exception|string $error
     */
    abstract public function error($sessionId, $error);

}
