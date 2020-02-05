<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Service;

interface OmsOctopusConnectorToUtilEncodingServiceInterface
{
    /**
     * @param array $value
     * @param int|null $options
     * @param int|null $depth
     *
     * @return string|null
     */
    public function encodeJson($value, $options = null, $depth = null): ?string;

    /**
     * @param string $jsonValue
     * @param bool $assoc
     * @param int|null $depth
     * @param int|null $options
     *
     * @return mixed|null
     */
    public function decodeJson($jsonValue, $assoc = false, $depth = null, $options = null);
}
