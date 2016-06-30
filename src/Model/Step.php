<?php

namespace ApiAi\Model;

/**
 * Interface Step
 *
 * @package ApiAi\Model
 */
interface Step
{
    const TYPE_ACTION = 'action';
    const TYPE_SPEECH = 'speech';

    /**
     * @return string
     */
    public function getType();

}
