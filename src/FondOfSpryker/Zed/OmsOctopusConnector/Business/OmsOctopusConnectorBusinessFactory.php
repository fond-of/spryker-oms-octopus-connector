<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business;

use FondOfSpryker\Zed\OmsOctopusConnector\Business\Api\Adapter\AdapterInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Api\Adapter\OrderAdapter;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderAddressMapper;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderAddressMapperInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderDiscountItemMapper;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderDiscountItemMapperInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderItemMapper;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderItemMapperInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderMapper;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderMapperInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderPaymentItemMapper;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderPaymentItemMapperInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderShipmentItemMapper;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderShipmentItemMapperInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OrderExporter;
use FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OrderExporterInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Service\OmsOctopusConnectorToUtilEncodingServiceInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\OmsOctopusConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\OmsOctopusConnector\OmsOctopusConnectorConfig getConfig()
 */
class OmsOctopusConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesInterface
     */
    protected function getSalesFacade(): OmsOctopusConnectorToSalesInterface
    {
        return $this->getProvidedDependency(OmsOctopusConnectorDependencyProvider::FACADE_SALES);
    }

    /**
     * @return \FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Service\OmsOctopusConnectorToUtilEncodingServiceInterface
     */
    public function getUtilEncodingService(): OmsOctopusConnectorToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(OmsOctopusConnectorDependencyProvider::UTIL_ENCODING_SERVICE);
    }

    /**
     * @return \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OrderExporterInterface
     */
    public function createOrderExporter(): OrderExporterInterface
    {
        return new OrderExporter(
            $this->getSalesFacade(),
            $this->createOctopusOrderMapper(),
            $this->createOctopusOrderItemMapper()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\OmsOctopusConnector\Business\Api\Adapter\AdapterInterface
     */
    protected function createOctopusOrderApiAdapter(): AdapterInterface
    {
        return new OrderAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderMapperInterface
     */
    protected function createOctopusOrderMapper(): OctopusOrderMapperInterface
    {
        return new OctopusOrderMapper(
            $this->createOctopusOrderAddressMapper(),
            $this->createOctopusOrderDiscountItemMapper(),
            $this->createOctopusOrderShipmentItemMapper(),
            $this->createOctopusOrderPaymentItemMapper()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderAddressMapperInterface
     */
    protected function createOctopusOrderAddressMapper(): OctopusOrderAddressMapperInterface
    {
        return new OctopusOrderAddressMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderDiscountItemMapperInterface
     */
    protected function createOctopusOrderDiscountItemMapper(): OctopusOrderDiscountItemMapperInterface
    {
        return new OctopusOrderDiscountItemMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderShipmentItemMapperInterface
     */
    protected function createOctopusOrderShipmentItemMapper(): OctopusOrderShipmentItemMapperInterface
    {
        return new OctopusOrderShipmentItemMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderPaymentItemMapperInterface
     */
    protected function createOctopusOrderPaymentItemMapper(): OctopusOrderPaymentItemMapperInterface
    {
        return new OctopusOrderPaymentItemMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderMapperInterface
     */
    protected function createOctopusOrderItemMapper(): OctopusOrderItemMapperInterface
    {
        return new OctopusOrderItemMapper();
    }
}
