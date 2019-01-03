<?php

namespace Railken\Mangadex;

use GuzzleHttp\Client;
use Symfony\Component\Cache\Simple\FilesystemCache;

abstract class MangadexReader
{
    /**
     * Base url Mangadex.
     *
     * @var string
     */
    protected $url = 'https://mangadex.org/';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var \Symfony\Component\Cache\Simple\FilesystemCache
     */
    protected $cache;

    /**
     * @var string
     */
    protected $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36';

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->url, 'query_array_format' => 1]);
        $this->cache = new FilesystemCache('kissmanga.com', 3600);
    }

    /**
     * Retrieve base url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Send a request.
     *
     * @param string       $method
     * @param string       $url
     * @param array|string $data
     */
    public function request($method, $url, $data, $retry = 2)
    {
        $params = [];
        $params['http_errors'] = false;

        $params['headers'] = [
            'User-Agent' => $this->agent,
        ];

        switch ($method) {
            case 'POST': case 'PUT':
                if (is_string($data)) {
                    $params['headers']['Content-Type'] = 'application/x-www-form-urlencoded';
                    $params['body'] = $data;
                } else {
                    $params['form_params'] = $data;
                }
            break;

            default:
                $params['query'] = $data;
            break;
        }

        $response = $this->client->request($method, $url, $params);
        $contents = $response->getBody()->getContents();

        if ($response->getStatusCode() === 502 && $retry > 0) {
            sleep(10);

            return $this->request($method, $url, $data, $retry - 1);
        }

        if ($response->getStatusCode() === 500 && $retry > 0) {
            sleep(30);

            return $this->request($method, $url, $data, $retry - 1);
        }

        if ($response->getStatusCode() === 200) {
            return $contents;
        }

        throw new \Exception($contents);
    }

    public function getUserAgent()
    {
        return $this->agent;
    }
}
