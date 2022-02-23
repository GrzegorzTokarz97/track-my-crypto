<?php

declare(strict_types=1);

namespace App\Classes\Request;

use App\Classes\Response\CollectionResponseInterface;
use App\Classes\Response\ResponseInterface;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\SerializerInterface;

abstract class AbstractRequest
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly SerializerInterface $serializer
    ) {}

    public function executeRequest(array $urlParams = [], array $query = []): ResponseInterface
    {
        $response = $this->client->request(
            'GET',
            $this->getUrl($urlParams),
            [
                'http_errors' => true,
                'query' => $query,
            ]
        );

        $content = $response->getBody()->getContents();
        $responseClass = $this->getResponseClass();

        if (is_subclass_of($responseClass, CollectionResponseInterface::class) && null !== $responseClass::COLLECTION_NAME) {
            $content = $this->prepareCollectionResponseData($content, $responseClass::COLLECTION_NAME);
        }

        return $this->createResponse($this->getResponseClass(), $content);
    }

    private function getUrl(array $urlParams): string
    {
        return vsprintf($this->getUri(), $urlParams);
    }

    private function createResponse(string $class, string $response): ResponseInterface
    {
        return $this->serializer->deserialize($response, $class, 'json');
    }

    private function prepareCollectionResponseData(string $response, string $collectionName): string
    {
        return json_encode(
            [$collectionName => json_decode($response, true, 512, JSON_THROW_ON_ERROR)],
            JSON_THROW_ON_ERROR
        );
    }

    abstract protected function getUri(): string;

    abstract protected function getResponseClass(): string;
}
