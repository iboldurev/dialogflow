<?php

namespace ApiAi\Model\Step;

use ApiAi\Model\Step;

/**
 * Class Speech
 *
 * @package ApiAi\Model\Step
 */
class Speech implements Step
{
    /**
     * @var string
     */
    private $speech;

    /**
     * Speech constructor.
     *
     * @param string $speech
     */
    public function __construct($speech)
    {
        $this->speech = $speech;
    }

    /**
     * @return string
     */
    public function getSpeech()
    {
        return $this->speech;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return Step::TYPE_SPEECH;
    }

}
