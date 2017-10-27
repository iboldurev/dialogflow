<?php

namespace DialogFlow\Model;

/**
 * Class Status
 *
 * @package DialogFlow\Model
 */
class Status extends Base
{
    /**
     * @return integer
     */
    public function getCode()
    {
        return parent::get('code');
    }

    /**
     * @return string
     */
    public function getErrorType()
    {
        return parent::get('errorType');
    }

    /**
     * @return string
     */
    public function getErrorId()
    {
        return parent::get('errorId');
    }

    /**
     * @return string
     */
    public function getErrorDetails()
    {
        return parent::get('errorDetails');
    }

}
