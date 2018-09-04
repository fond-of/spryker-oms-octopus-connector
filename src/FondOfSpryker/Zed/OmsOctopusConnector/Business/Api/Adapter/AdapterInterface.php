<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Api\Adapter;

use Psr\Http\Message\StreamInterface;

interface AdapterInterface
{
    /**
     * @param array $request
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function sendRequest(array $request): StreamInterface;
}
