<?php

namespace DialogFlow\Model;

/**
 * Class Fulfillment
 *
 * @package DialogFlow\Model
 */
class Fulfillment extends Base
{
    /**
     * @return string
     */
    public function getSpeech()
    {
        return parent::get('speech');
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return parent::get('source');
    }

    /**
     * @return string
     */
    public function getDisplayText()
    {
        return parent::get('displayText');
    }

    /**
     * @return array
     */
    public function getData()
    {
        return parent::get('data', []);
    }

    /**
     * @return array
     */
    public function getContextOut()
    {
        return parent::get('contextOut');
    }

}
