<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business;

use FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\OmsOctopusConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class OmsOctopusConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesInterface
     */
    protected function getSalesFacade(): OmsOctopusConnectorToSalesInterface
    {
        return $this->getProvidedDependency(OmsOctopusConnectorDependencyProvider::FACADE_SALES);
    }
}
