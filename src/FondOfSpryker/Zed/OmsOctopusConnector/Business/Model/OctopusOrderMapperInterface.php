<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\OctopusOrderTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface OctopusOrderMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return \Generated\Shared\Transfer\OctopusOrderTransfer
     */
    public function mapSpySalesOrderToOctopusOrder(SpySalesOrder $spySalesOrder): OctopusOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderTransfer
     */
    public function mapOrderTransferToOctopusOrder(OrderTransfer $orderTransfer): OctopusOrderTransfer;
}
