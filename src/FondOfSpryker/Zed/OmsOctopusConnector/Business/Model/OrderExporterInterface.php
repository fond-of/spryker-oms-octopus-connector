<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface OrderExporterInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $order
     * @param array $orderItems
     *
     * @return void
     */
    public function export(SpySalesOrder $order, array $orderItems): void;

    /**
     * @param int $idSalesOrder
     *
     * @return void
     */
    public function exportByIdSalesOrder(int $idSalesOrder): void;
}
