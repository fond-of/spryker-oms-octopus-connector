<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface OrderExporterInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     * @param array $spySalesOrderItems
     *
     * @return void
     */
    public function export(SpySalesOrder $spySalesOrder, array $spySalesOrderItems): void;

    /**
     * @param int $idSalesOrder
     *
     * @return void
     */
    public function exportByIdSalesOrder(int $idSalesOrder): void;
}
