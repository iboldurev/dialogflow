<?php

namespace ApiAi\Model\Step;

use ApiAi\Model\Step;

/**
 * Class Action
 *
 * @package ApiAi\Model\Step
 */
class Action implements Step
{
    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    private $parameters;

    /**
     * Action constructor.
     *
     * @param string $action
     * @param array $parameters
     */
    public function __construct($action, array $parameters)
    {
        $this->action = $action;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return Step::TYPE_ACTION;
    }

}
