<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\OctopusOrderTotalTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderTotals;

interface OctopusOrderTotalMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderTotals $spySalesOrderTotals
     *
     * @return \Generated\Shared\Transfer\OctopusOrderTotalTransfer
     */
    public function mapSpySalesOrderTotalToOctopusOrderTotal(SpySalesOrderTotals $spySalesOrderTotals): OctopusOrderTotalTransfer;

    /**
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderTotalTransfer
     */
    public function mapOrderTransferToOctopusOrderTotal(OrderTransfer $orderTransfer): OctopusOrderTotalTransfer;
}
