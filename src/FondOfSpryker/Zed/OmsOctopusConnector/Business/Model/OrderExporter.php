<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesInterface;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class OrderExporter implements OrderExporterInterface
{
    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesInterface
     */
    protected $salesFacade;

    /**
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesInterface $salesFacade
     */
    public function __construct(
        OmsOctopusConnectorToSalesInterface $salesFacade
    ) {
        $this->salesFacade = $salesFacade;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $order
     * @param array $orderItems
     *
     * @return void
     */
    public function export(SpySalesOrder $order, array $orderItems): void
    {
        // TODO: Implement export() method.
    }

    /**
     * @param int $idSalesOrder
     *
     * @return void
     */
    public function exportByIdSalesOrder(int $idSalesOrder): void
    {
        $order = $this->salesFacade->getOrderByIdSalesOrder($idSalesOrder);
    }
}
