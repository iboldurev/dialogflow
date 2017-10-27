<?php

namespace DialogFlow\Model;

/**
 * Interface Step
 *
 * @package DialogFlow\Model
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
