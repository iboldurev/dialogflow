<?php

namespace ApiAi\Exception;

use ApiAi\Model\Query;

/**
 * Class InvalidStepException
 *
 * @package ApiAi\Exception
 */
class InvalidStepException extends \RuntimeException
{
    /**
     * @var Query
     */
    private $query;

    /**
     * InvalidStepException constructor.
     *
     * @param string $message
     * @param Query $query
     */
    public function __construct($message, Query $query)
    {
        parent::__construct($message);

        $this->query = $query;
    }

    /**
     * @return Query
     */
    public function getQuery()
    {
        return $this->query;
    }

}
