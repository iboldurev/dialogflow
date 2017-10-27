<?php

namespace DialogFlow\Exception;

use DialogFlow\Model\Query;

/**
 * Class DialogException
 *
 * @package DialogFlow\Exception
 */
class DialogException extends \RuntimeException
{
    /**
     * @var string
     */
    private $sessionId;

    /**
     * @var Query
     */
    private $query;

    public function __construct($message, $sessionId, Query $query)
    {
        parent::__construct($message);

        $this->sessionId = $sessionId;
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @return Query
     */
    public function getQuery()
    {
        return $this->query;
    }

}
