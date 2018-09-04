<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\OctopusOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

interface OctopusOrderItemMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $spySalesOrderItem
     *
     * @return \Generated\Shared\Transfer\OctopusOrderItemTransfer
     */
    public function mapSpySalesOrderItemEntityToOctopusOrderItem(SpySalesOrderItem $spySalesOrderItem): OctopusOrderItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderItemTransfer
     */
    public function mapItemTransferToOctopusOrderItem(ItemTransfer $itemTransfer): OctopusOrderItemTransfer;
}
