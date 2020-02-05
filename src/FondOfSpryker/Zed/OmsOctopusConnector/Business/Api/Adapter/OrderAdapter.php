<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Api\Adapter;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class OrderAdapter extends AbstractAdapter
{
    /**
     * @return string
     */
    protected function getUrl(): string
    {
        return $this->config->getOctopusOrderApiUrl();
    }

    /**
     * @return bool
     */
    protected function canSendRequest(): bool
    {
        return $this->config->isExportEnabled();
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @throws \Exception
     *
     * @return void
     */
    protected function handleResponse(ResponseInterface $response, AbstractTransfer $transfer): void
    {
        if ($response->getStatusCode() !== 204) {
            throw new Exception(sprintf(
                'Order #%s could not be exported to octopus.',
                $transfer->getOrderReference()
            ));
        }
    }
}
