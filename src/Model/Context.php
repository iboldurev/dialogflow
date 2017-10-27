<?php

namespace DialogFlow\Model;

/**
 * Class Context
 *
 * @package DialogFlow\Model
 */
class Context extends Base
{
    /**
     * @return string
     */
    public function getName()
    {
        return parent::get('name');
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return parent::get('parameters', []);
    }

    /**
     * @return integer
     */
    public function getLifespan()
    {
        return parent::get('lifespan');
    }

}
