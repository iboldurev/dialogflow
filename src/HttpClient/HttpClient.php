<?php

namespace DialogFlow\HttpClient;

use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface HttpClient
 *
 * @package DialogFlow\HttpClient
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

    /**
     * @param string $method
     * @param string $uri
     * @param mixed $body
     * @param array $query
     * @param array $headers
     * @param array $options
     *
     * @return PromiseInterface
     */
    public function sendAsync($method, $uri, $body = null, array $query = [], array $headers = [], array $options = []);
}
