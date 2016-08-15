<?php

namespace ApiAi;

use ApiAi\Method\QueryApi;
use ApiAi\Model\Query;
use ApiAi\Model\Step;
use ApiAi\Model\Step\Action;
use ApiAi\Model\Step\Speech;
use ApiAi\Exception\DialogException;
use ApiAi\Exception\InvalidStepException;

/**
 * Class Dialog
 *
 * @package ApiAi
 */
class Dialog
{
    /**
     * @var QueryApi
     */
    private $queryApi;

    /**
     * @var ActionMapping
     */
    private $actionMapping;

    /**
     * Dialog constructor.
     *
     * @param QueryApi $queryApi
     * @param ActionMapping $actionMapping
     */
    public function __construct(QueryApi $queryApi, ActionMapping $actionMapping)
    {
        $this->queryApi = $queryApi;
        $this->actionMapping = $actionMapping;
    }

    /**
     * @param string $sessionId
     * @param string $message
     * @param array $contexts
     *
     * @return bool|void
     */
    public function create($sessionId, $message, $contexts = [])
    {
        try {
            $step = $this->getStep($sessionId, $message, $contexts);
        } catch (\Exception $error) {
            return $this->actionMapping->error($sessionId, $error);
        }

        return $this->performStep($sessionId, $step);
    }

    /**
     * @param string $sessionId
     * @param string $message
     * @param array $contexts
     *
     * @return Action|Speech
     */
    private function getStep($sessionId, $message, $contexts = [])
    {
        $query = $this->queryApi->extractMeaning($message, [
            'sessionId' => $sessionId,
            'contexts' => $contexts,
        ]);

        $query = new Query($query);

        if (null === $query) {
            $query = new Query();
        }

        if ($query->getStatus()->getCode() !== 200) {
            throw new DialogException($query->getStatus()->getErrorDetails(), $sessionId, $query);
        }

        try {
            $step = StepFactory::create($query);
        } catch (InvalidStepException $error) {
            throw new DialogException($error->getMessage(), $sessionId, $error->getQuery());
        }

        return $step;
    }

    /**
     * @param string $sessionId
     * @param Step $step
     *
     * @return bool
     */
    private function performStep($sessionId, Step $step)
    {
        switch (true) {
            case $step instanceof Action:
                return $this->actionMapping->action($sessionId, $step->getAction(), $step->getParameters(), $step->getContexts());
                break;
            case $step instanceof Speech:
                return $this->actionMapping->speech($sessionId, $step->getSpeech(), $step->getContexts());
                break;
        }

        return false;
    }

}
