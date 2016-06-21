<?php

namespace Api\HttpClient;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface HttpClient
 *
 * @package Api\HttpClient
 */
interface HttpClient
{
    /**
     * @param string $method
     * @param string $uri
     * @param mixed $body
     * @param array $query
     * @param array $headers
     * @param array $options
     *
     * @return ResponseInterface
     */
    public function send($method, $uri, $body = null, array $query = [], array $headers = [], array $options = []);
}
