<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\ItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

interface OctopusOrderItemMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $spySalesOrderItem
     *
     * @return array
     */
    public function mapSpySalesOrderItemEntityToOctopusOrderItem(SpySalesOrderItem $spySalesOrderItem): array;

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return array
     */
    public function mapItemTransferToOctopusOrderItem(ItemTransfer $itemTransfer): array;
}
