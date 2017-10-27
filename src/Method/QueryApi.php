<?php

namespace DialogFlow\Method;

use DialogFlow\Client;
use DialogFlow\ResponseHandler;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class QueryApi
 *
 * @package DialogFlow\Method
 */
class QueryApi
{
    use ResponseHandler;

    /**
     * @var Client
     */
    private $client;

    /**
     * Query constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $query
     * @param array $extraParams
     *
     * @return mixed
     */
    public function extractMeaning($query, $extraParams = [])
    {
        $query = array_merge($extraParams, [
            'lang' => $this->client->getApiLanguage(),
            'query' => $query,
        ]);

        $response = $this->client->post('query', $query);

        return $this->decodeResponse($response);
    }

    /**
     * @param $query
     * @param array $extraParams
     *
     * @return PromiseInterface
     */
    public function extractMeaningAsync($query, $extraParams = [])
    {
        $query = array_merge($extraParams, [
            'lang' => $this->client->getApiLanguage(),
            'query' => $query,
        ]);

        return $this->client->postAsync('query', $query)->then([$this, 'decodeResponse']);
    }
}
