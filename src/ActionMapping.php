<?php

namespace DialogFlow;

use DialogFlow\Model\Context;

/**
 * Class ActionMapping
 *
 * @package DialogFlow
 */
abstract class ActionMapping
{
    /**
     * @param string $sessionId
     * @param string $action
     * @param array $parameters
     * @param Context[] $contexts
     * @return
     */
    abstract public function action($sessionId, $action, $parameters, $contexts);

    /**
     * @param string $sessionId
     * @param string $speech
     * @param Context[] $contexts
     */
    abstract public function speech($sessionId, $speech, $contexts);

    /**
     * @param string $sessionId
     * @param \Exception|string $error
     */
    abstract public function error($sessionId, $error);

}
