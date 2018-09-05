<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector;

use FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesBridge;
use FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Service\OmsOctopusConnectorToUtilEncodingServiceBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class OmsOctopusConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_SALES = 'FACADE_SALES';
    public const UTIL_ENCODING_SERVICE = 'UTIL_ENCODING_SERVICE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $this->addSalesFacade($container);
        $this->addUtilEncodingService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesFacade(Container $container): Container
    {
        $container[static::FACADE_SALES] = function (Container $container) {
            return new OmsOctopusConnectorToSalesBridge($container->getLocator()->sales()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilEncodingService(Container $container): Container
    {
        $container[static::UTIL_ENCODING_SERVICE] = function (Container $container) {
            return new OmsOctopusConnectorToUtilEncodingServiceBridge(
                $container->getLocator()->utilEncoding()->service()
            );
        };

        return $container;
    }
}
