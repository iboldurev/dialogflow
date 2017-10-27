<?php

namespace DialogFlow\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Class BadResponseException
 *
 * @package DialogFlow\Exception
 */
class BadResponseException extends \RuntimeException
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * BadResponseException constructor.
     *
     * @param string $message
     * @param ResponseInterface $response
     */
    public function __construct($message, ResponseInterface $response)
    {
        $code = $response ? $response->getStatusCode() : 0;

        parent::__construct($message, $code);
        $this->response = $response;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
