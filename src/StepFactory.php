<?php

namespace DialogFlow;

use DialogFlow\Model\Query;
use DialogFlow\Model\Step;
use DialogFlow\Model\Step\Action;
use DialogFlow\Model\Step\Speech;
use DialogFlow\Exception\InvalidStepException;

/**
 * Class StepFactory
 *
 * @package DialogFlow
 */
class StepFactory
{
    /**
     * @param Query $query
     *
     * @return Action|Speech
     */
    public static function create(Query $query)
    {
        $type = null;

        if ($result = $query->getResult()) {
            if (!$result->getActionIncomplete()) {
                if (strlen(trim($result->getAction())) > 0) {
                    $type = Step::TYPE_ACTION;
                }
            }

            if ($result->getFulfillment()->getSpeech()) {
                $type = Step::TYPE_SPEECH;
            }
        }

        switch ($type) {
            case Step::TYPE_ACTION:
                return self::createActionStep($query);
            case Step::TYPE_SPEECH:
                return self::createSpeechStep($query);
            default:
                throw new InvalidStepException('Invalid Step', $query);
        }
    }

    /**
     * @param Query $query
     *
     * @return Action
     */
    public static function createActionStep(Query $query)
    {
        return new Action(
            $query->getResult()->getAction(),
            $query->getResult()->getParameters(),
            $query->getResult()->getContexts()
        );
    }

    /**
     * @param Query $query
     *
     * @return Speech
     */
    public static function createSpeechStep(Query $query)
    {
        return new Speech(
            $query->getResult()->getFulfillment()->getSpeech(),
            $query->getResult()->getContexts()
        );
    }

}
