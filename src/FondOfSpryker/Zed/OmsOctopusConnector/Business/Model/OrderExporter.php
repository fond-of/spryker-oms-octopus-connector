<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use FondOfSpryker\Zed\OmsOctopusConnector\Business\Api\Adapter\AdapterInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesInterface;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class OrderExporter implements OrderExporterInterface
{
    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesInterface
     */
    protected $salesFacade;

    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderMapperInterface
     */
    protected $octopusOrderMapper;

    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderItemMapperInterface
     */
    protected $octopusOrderItemMapper;

    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Business\Api\Adapter\AdapterInterface
     */
    protected $apiAdapter;

    /**
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesInterface $salesFacade
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderMapperInterface $octopusOrderMapper
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderItemMapperInterface $octopusOrderItemMapper
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Business\Api\Adapter\AdapterInterface $apiAdapter
     */
    public function __construct(
        OmsOctopusConnectorToSalesInterface $salesFacade,
        OctopusOrderMapperInterface $octopusOrderMapper,
        OctopusOrderItemMapperInterface $octopusOrderItemMapper,
        AdapterInterface $apiAdapter
    ) {
        $this->salesFacade = $salesFacade;
        $this->octopusOrderMapper = $octopusOrderMapper;
        $this->octopusOrderItemMapper = $octopusOrderItemMapper;
        $this->apiAdapter = $apiAdapter;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     * @param array $spySalesOrderItems
     *
     * @return void
     */
    public function export(SpySalesOrder $spySalesOrder, array $spySalesOrderItems): void
    {
        $octopusOrder = $this->octopusOrderMapper->mapSpySalesOrderToOctopusOrder($spySalesOrder);
        $octopusOrder['order_items'] = [];

        foreach ($spySalesOrderItems as $orderItem) {
            $octopusOrder['order_items'][] = $this->octopusOrderItemMapper
                ->mapSpySalesOrderItemEntityToOctopusOrderItem($orderItem);
        }

        // TODO: send to octopus;
    }

    /**
     * @param int $idSalesOrder
     *
     * @return void
     */
    public function exportByIdSalesOrder(int $idSalesOrder): void
    {
        $orderTransfer = $this->salesFacade->getOrderByIdSalesOrder($idSalesOrder);

        $octopusOrder = $this->octopusOrderMapper->mapOrderTransferToOctopusOrder($orderTransfer);
        $octopusOrder['order_items'] = [];

        foreach ($orderTransfer->getItems() as $itemTransfer) {
            $octopusOrder['order_items'][] = $this->octopusOrderItemMapper
                ->mapItemTransferToOctopusOrderItem($itemTransfer);
        }

        // TODO: send to octopus;
    }
}
