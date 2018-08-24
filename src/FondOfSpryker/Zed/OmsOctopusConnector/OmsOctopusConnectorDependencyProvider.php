<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector;

use FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class OmsOctopusConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    const FACADE_SALES = 'FACADE_SALES';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $this->addSalesFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesFacade(Container $container)
    {
        $container[static::FACADE_SALES] = function (Container $container) {
            return new OmsOctopusConnectorToSalesBridge($container->getLocator()->sales()->facade());
        };

        return $container;
    }
}
