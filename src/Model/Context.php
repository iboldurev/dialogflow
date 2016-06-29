<?php

namespace ApiAi\Model;

/**
 * Class Context
 *
 * @package ApiAi\Model
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
