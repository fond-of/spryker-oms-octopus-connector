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

    public const OCTOPUS_ORDER_PAYMENT_ITEM_TRANSFER_EXPANDER_PLUGINS = 'OCTOPUS_ORDER_PAYMENT_ITEM_TRANSFER_EXPANDER_PLUGINS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addSalesFacade($container);
        $container = $this->addUtilEncodingService($container);
        $container = $this->addOctopusOrderPaymentItemTransferExpanderPlugins($container);

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

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addOctopusOrderPaymentItemTransferExpanderPlugins(Container $container): Container
    {
        $container[static::OCTOPUS_ORDER_PAYMENT_ITEM_TRANSFER_EXPANDER_PLUGINS] = function (Container $container) {
            return $this->getOctopusOrderPaymentItemTransferExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\OmsOctopusConnectorExtension\Dependency\Plugin\OctopusOrderPaymentItemTransferExpanderPluginInterface[]
     */
    protected function getOctopusOrderPaymentItemTransferExpanderPlugins(): array
    {
        return [];
    }
}
