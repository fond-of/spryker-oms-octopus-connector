<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business;

use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface OmsOctopusConnectorFacadeInterface
{
    /**
     * @param int $idSalesOrder
     *
     * @return void
     */
    public function exportOrderByIdSalesOrder(int $idSalesOrder): void;

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     * @param array $spySalesOrderItems
     *
     * @return void
     */
    public function exportOrder(SpySalesOrder $spySalesOrder, array $spySalesOrderItems): void;
}
