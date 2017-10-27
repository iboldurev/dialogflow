<?php

namespace DialogFlow\Model;

/**
 * Class Query
 *
 * @package DialogFlow\Model
 */
class Query extends Base
{
    /**
     * Query constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        if ($data['timestamp'] instanceof \DateTime) {
            $data['timestamp'] = $data['timestamp']->format(DATE_ISO8601);
        }

        if (!empty($data['result'])) {
            $data['result'] = new QueryResult($data['result']);
        }

        if (!empty($data['status'])) {
            $data['status'] = new Status($data['status']);
        }

        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return parent::get('id');
    }

    /**
     * Return the timestamp in the ISO8601 format
     *
     * @return string
     */
    public function getTimestamp()
    {
        return parent::get('timestamp');
    }

    /**
     * @return QueryResult
     */
    public function getResult()
    {
        return parent::get('result');
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return parent::get('status');
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return parent::get('sessionId');
    }

}
