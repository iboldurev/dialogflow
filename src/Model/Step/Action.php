<?php

namespace DialogFlow\Model\Step;

use DialogFlow\Model\Context;
use DialogFlow\Model\Step;

/**
 * Class Action
 *
 * @package DialogFlow\Model\Step
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
     * @var Context[]
     */
    private $contexts;

    /**
     * Action constructor.
     *
     * @param string $action
     * @param array $parameters
     * @param Context[] $contexts
     */
    public function __construct($action, array $parameters, array $contexts)
    {
        $this->action = $action;
        $this->parameters = $parameters;
        $this->contexts = $contexts;
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
     * @return Context[]
     */
    public function getContexts()
    {
        return $this->contexts;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return Step::TYPE_ACTION;
    }

}
