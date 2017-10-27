<?php

namespace DialogFlow\Model\Step;

use DialogFlow\Model\Context;
use DialogFlow\Model\Step;

/**
 * Class Speech
 *
 * @package DialogFlow\Model\Step
 */
class Speech implements Step
{
    /**
     * @var string
     */
    private $speech;

    /**
     * @var Context[]
     */
    private $contexts = [];

    /**
     * Speech constructor.
     *
     * @param string $speech
     * @param Context[] $contexts
     */
    public function __construct($speech, array $contexts)
    {
        $this->speech = $speech;
        $this->contexts = $contexts;
    }

    /**
     * @return string
     */
    public function getSpeech()
    {
        return $this->speech;
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
        return Step::TYPE_SPEECH;
    }

}
