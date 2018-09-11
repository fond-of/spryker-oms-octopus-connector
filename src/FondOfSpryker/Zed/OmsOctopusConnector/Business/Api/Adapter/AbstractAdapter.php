<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Api\Adapter;

use FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Service\OmsOctopusConnectorToUtilEncodingServiceInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\OmsOctopusConnectorConfig;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Log\LoggerTrait;

abstract class AbstractAdapter implements AdapterInterface
{
    use LoggerTrait;

    protected const DEFAULT_TIMEOUT = 45;
    protected const DEFAULT_HEADERS = [
        'Content-Type' => 'application/json',
    ];

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\OmsOctopusConnectorConfig
     */
    protected $config;

    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Service\OmsOctopusConnectorToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\OmsOctopusConnectorConfig $config
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Service\OmsOctopusConnectorToUtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(
        OmsOctopusConnectorConfig $config,
        OmsOctopusConnectorToUtilEncodingServiceInterface $utilEncodingService
    ) {
        $this->config = $config;
        $this->utilEncodingService = $utilEncodingService;
        $this->client = new Client([
            RequestOptions::TIMEOUT => static::DEFAULT_TIMEOUT,
        ]);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function sendRequest(AbstractTransfer $transfer): ?StreamInterface
    {
        $this->getLogger()->info(sprintf(
            'Before API request [%s]: %s',
            $this->getUrl(),
            $this->utilEncodingService->encodeJson($transfer->toArray())
        ));

        if (!$this->canSendRequest()) {
            return null;
        }

        $options = $this->createOptions($transfer);
        $response = $this->send($options);

        $this->handleResponse($response, $transfer);

        return $response->getBody();
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @return array
     */
    protected function createOptions(AbstractTransfer $transfer): array
    {
        $options = [];

        $options[RequestOptions::HEADERS] = static::DEFAULT_HEADERS;
        $options[RequestOptions::BODY] = $this->utilEncodingService->encodeJson($transfer->toArray());

        return $options;
    }

    /**
     * @param array $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function send(array $options = []): ResponseInterface
    {
        $this->getLogger()->info(sprintf('API request [%s]: %s', $this->getUrl(), $options));

        $response = $this->client->post(
            $this->getUrl(),
            $options
        );

        return $response;
    }

    /**
     * @return string
     */
    abstract protected function getUrl(): string;

    /**
     * @return bool
     */
    abstract protected function canSendRequest(): bool;

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @return void
     */
    abstract protected function handleResponse(ResponseInterface $response, AbstractTransfer $transfer): void;
}
