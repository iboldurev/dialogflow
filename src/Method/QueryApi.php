<?php

namespace ApiAi\Method;

use ApiAi\Client;
use ApiAi\ResponseHandler;

/**
 * Class QueryApi
 *
 * @package ApiAi\Method
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

}
