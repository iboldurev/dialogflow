<?php

namespace DialogFlow\Exception;

use DialogFlow\Model\Query;

/**
 * Class InvalidStepException
 *
 * @package DialogFlow\Exception
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
