<?php

namespace DialogFlow\HttpClient;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use DialogFlow\Client;

/**
 * Class GuzzleHttpClient
 *
 * @package DialogFlow\HttpClient
 */
class GuzzleHttpClient implements HttpClient
{
    /**
     * @var GuzzleClient
     */
    private $guzzleClient;

    /**
     * GuzzleHttpClient constructor.
     *
     * @param ClientInterface|null $guzzleClient
     */
    public function __construct(ClientInterface $guzzleClient = null)
    {
        $this->guzzleClient = $guzzleClient ?: new GuzzleClient([
            'base_uri' => Client::API_BASE_URI . Client::DEFAULT_API_ENDPOINT,
            'timeout' => Client::DEFAULT_TIMEOUT,
            'connect_timeout' => Client::DEFAULT_TIMEOUT,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function send($method, $uri, $body = null, array $query = [], array $headers = [], array $options = [])
    {
        $options = $this->prepareOptions($body, $query, $headers, $options);
        return $this->guzzleClient->request($method, $uri, $options);
    }

    /**
     * @inheritdoc
     */
    public function sendAsync($method, $uri, $body = null, array $query = [], array $headers = [], array $options = [])
    {
        $options = $this->prepareOptions($body, $query, $headers, $options);
        return $this->guzzleClient->requestAsync($method, $uri, $options);
    }

    /**
     * @param mixed $body
     * @param array $query
     * @param array $headers
     * @param array $options
     *
     * @return array
     */
    private function prepareOptions($body, array $query, array $headers, array $options)
    {
        $options = array_merge($options, [
            RequestOptions::QUERY => $query,
            RequestOptions::HEADERS => $headers,
        ]);

        if (!empty($body) && (is_array($body) || $body instanceof \JsonSerializable)) {
            $options[RequestOptions::JSON] = $body;
        } else {
            $options[RequestOptions::BODY] = $body;
        }

        return $options;
    }
}
