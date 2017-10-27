<?php

namespace DialogFlow;

use DialogFlow\HttpClient\HttpClient;
use DialogFlow\HttpClient\GuzzleHttpClient;
use DialogFlow\Exception\BadResponseException;
use GuzzleHttp\Promise\PromiseInterface;
use function GuzzleHttp\Promise\rejection_for;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 *
 * @package DialogFlow
 */
class Client
{
    /**
     * API Base url
     */
    const API_BASE_URI = 'https://api.dialogflow.com/';

    /**
     * API Version
     */
    const DEFAULT_API_VERSION = '20150910';

    /**
     * API Endpoint
     */
    const DEFAULT_API_ENDPOINT = 'v1/';

    /**
     * API Default Language
     */
    const DEFAULT_API_LANGUAGE = 'en';

    /**
     * API Default Source
     */
    const DEFAULT_API_SOURCE = 'php';

    /**
     * Request default timeout
     */
    const DEFAULT_TIMEOUT = 5;

    /**
     * @var array
     */
    public static $allowedMethod = ['GET', 'POST'];

    /**
     * @var string Dialogflow token
     */
    private $accessToken;

    /**
     * @var string
     */
    private $apiLanguage;

    /**
     * @var string
     */
    private $apiVersion;

    /**
     * @var HttpClient client
     */
    private $client;

    /**
     * @var ResponseInterface|null
     */
    private $lastResponse;

    /**
     * Client constructor.
     *
     * @param string $accessToken
     * @param HttpClient|null $httpClient
     * @param string $apiLanguage
     * @param string $apiVersion
     */
    public function __construct($accessToken, HttpClient $httpClient = null, $apiLanguage = self::DEFAULT_API_LANGUAGE, $apiVersion = self::DEFAULT_API_VERSION)
    {
        if (is_null($accessToken)) {
            throw new \InvalidArgumentException('Client Access token is missing.');
        }

        $this->accessToken = $accessToken;
        $this->apiLanguage = $apiLanguage;
        $this->apiVersion = $apiVersion;
        $this->client = $httpClient ?: $this->defaultHttpClient();
    }

    /**
     * @return GuzzleHttpClient
     */
    private function defaultHttpClient()
    {
        return new GuzzleHttpClient();
    }

    /**
     * @return string
     */
    public function getApiLanguage()
    {
        return $this->apiLanguage;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return GuzzleHttpClient|HttpClient
     */
    public function getHttpClient()
    {
        return $this->client;
    }

    /**
     * @return null|ResponseInterface
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * @param string $uri
     * @param array $params
     *
     * @return ResponseInterface
     */
    public function get($uri, array $params = [])
    {
        return $this->send('GET', $uri, null, $params);
    }

    /**
     * @param string $url
     * @param array $params
     *
     * @return PromiseInterface
     */
    public function getAsync($url, array $params = [])
    {
        return $this->sendAsync('GET', $uri, null, $params);
    }

    /**
     * @param string $uri
     * @param array $params
     *
     * @return ResponseInterface
     */
    public function post($uri, array $params = [])
    {
        return $this->send('POST', $uri, $params);
    }

    /**
     * @param string $uri
     * @param array $params
     *
     * @return PromiseInterface
     */
    public function postAsync($uri, array $params = [])
    {
        return $this->sendAsync('POST', $uri, $params);
    }

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
    public function send($method, $uri, $body = null, array $query = [], array $headers = [], array $options = [])
    {
        $this->validateMethod($method);

        $query = array_merge($this->getDefaultQuery(), $query);
        $headers = array_merge($this->getDefaultHeaders(), $headers);

        $this->lastResponse = $this->client->send($method, $uri, $body, $query, $headers, $options);

        $this->validateResponse($this->lastResponse);

        return $this->lastResponse;
    }

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
    public function sendAsync($method, $uri, $body = null, array $query = [], array $headers = [], array $options = [])
    {
        try {
            $this->validateMethod($method);
        } catch (\InvalidArgumentException $e) {
            return rejection_for($e);
        }

        $query = array_merge($this->getDefaultQuery(), $query);
        $headers = array_merge($this->getDefaultHeaders(), $headers);

        return $this->client->sendAsync($method, $uri, $body, $query, $headers, $options)->then(
            function (ResponseInterface $response) {
                $this->lastResponse = $response;

                $this->validateResponse($this->lastResponse);

                return $this->lastResponse;
            }
        );
    }

    /**
     * @param string $method
     * @throw \InvalidArgumentException
     */
    private function validateMethod($method)
    {
        if (!in_array(strtoupper($method), self::$allowedMethod)) {
            throw new \InvalidArgumentException(sprintf('"%s" is not in the allowed methods "%s"', $method, implode(', ', self::$allowedMethod)));
        }
    }

    /**
     * @param ResponseInterface $response
     * @throws BadResponseException
     */
    private function validateResponse(ResponseInterface $response)
    {
        if ($response->getStatusCode() !== 200) {
            $message = empty($response->getReasonPhrase()) ? 'Bad response status code' : $response->getReasonPhrase();
            throw new BadResponseException($message, $response);
        }
    }

    /**
     * Get the defaults query
     *
     * @return array
     */
    private function getDefaultQuery()
    {
        return [
            'v' => $this->apiVersion,
            'lang' => $this->apiLanguage,
        ];
    }

    /**
     * Get the defaults headers
     *
     * @return array
     */
    private function getDefaultHeaders()
    {
        return [
            'Content-Type' => 'application/json; charset=utf-8',
            'Authorization' => 'Bearer ' . $this->accessToken,
            'api-request-source' => self::DEFAULT_API_SOURCE,
        ];
    }

}
