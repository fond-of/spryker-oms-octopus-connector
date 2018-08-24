<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\OrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface OctopusOrderMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     *
     * @return string
     */
    public function mapOrderEntityToOctopusOrder(SpySalesOrder $orderEntity): string;

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return string
     */
    public function mapOrderTransferToOctopusOrder(OrderTransfer $orderTransfer): string;
}
