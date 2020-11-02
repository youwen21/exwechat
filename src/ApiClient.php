<?php

namespace youwen\exwechat;

use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;

class ApiClient
{

    /**
     * ClientInterface
     * if you need log request and response params, set http client logger handler
     */
    protected $httpClient;

    /**
     * contract JsonProcessInterface, must have method jsonEncode ,jsonDecode
     */
    protected $jsonProcessor;

    /**
     * contract implement XmlProcessInterface, must have method xmlToArray, arrayToXml
     */
    protected $xmlProcessor;

    public function __construct()
    {
        $this->httpClient = new Client();

        $this->jsonProcessor = new JsonProcess();
        $this->xmlProcessor = new XmlProcess();
    }

    public function getHttpClient()
    {
        return $this->httpClient;
    }

    public function setHttpClient($client)
    {
        $this->httpClient = $client;
    }

    public function getJsonProcessor()
    {
        return $this->jsonProcessor;
    }

    public function setJsonProcessor($jsonProcessor): void
    {
        $this->jsonProcessor = $jsonProcessor;
    }

    public function getXmlProcessor()
    {
        return $this->xmlProcessor;
    }

    public function setXmlProcessor($xmlProcessor): void
    {
        $this->xmlProcessor = $xmlProcessor;
    }


    public function requestHandleJson(RequestInterface $request)
    {
        $json = $this->send($request);

        return $this->jsonProcessor->jsonDecode($json);
    }

    public function requestHandleXml(RequestInterface $request)
    {
        $xml = $this->send($request);

        return $this->xmlProcessor->xmlToArray($xml);
    }

    public function send(RequestInterface $request)
    {
        $response = $this->httpClient->send($request);

        return $response->getBody()->getContents();
    }
}
