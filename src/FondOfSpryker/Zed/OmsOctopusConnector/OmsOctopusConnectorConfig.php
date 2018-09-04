<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector;

use FondOfSpryker\Shared\OmsOctopusConnector\OmsOctopusConnectorConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class OmsOctopusConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return bool
     */
    public function isExportEnabled(): bool
    {
        return $this->get(OmsOctopusConnectorConstants::EXPORT_ENABLED, false);
    }

    /**
     * @return string
     */
    public function getOctopusOrderApiUrl(): string
    {
        return $this->get(OmsOctopusConnectorConstants::API_ORDER_URL);
    }
}
