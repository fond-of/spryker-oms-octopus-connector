<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\CalculatedDiscountTransfer;
use Generated\Shared\Transfer\OctopusOrderDiscountItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesDiscount;

class OctopusOrderDiscountItemMapper implements OctopusOrderDiscountItemMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesDiscount $spySalesDiscount
     *
     * @return \Generated\Shared\Transfer\OctopusOrderDiscountItemTransfer
     */
    public function mapSpySalesDiscountToOctopusOrderDiscountItem(
        SpySalesDiscount $spySalesDiscount
    ): OctopusOrderDiscountItemTransfer {
        $octopusOrderDiscountItem = new OctopusOrderDiscountItemTransfer();
        $octopusOrderDiscountItem->setCode($spySalesDiscount->getDiscountCodes()->getFirst()->getCode());
        $octopusOrderDiscountItem->setDescription($spySalesDiscount->getDescription());
        $octopusOrderDiscountItem->setDisplayName($spySalesDiscount->getDisplayName());
        $octopusOrderDiscountItem->setAmount($spySalesDiscount->getAmount());

        return $octopusOrderDiscountItem;
    }

    /**
     * @param \Generated\Shared\Transfer\CalculatedDiscountTransfer $calculatedDiscountTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderDiscountItemTransfer
     */
    public function mapCalculatedDiscountTransferToOctopusOrderDiscountItem(
        CalculatedDiscountTransfer $calculatedDiscountTransfer
    ): OctopusOrderDiscountItemTransfer {
        $octopusOrderDiscountItem = new OctopusOrderDiscountItemTransfer();
        $octopusOrderDiscountItem->setCode($calculatedDiscountTransfer->getVoucherCode());
        $octopusOrderDiscountItem->setDescription($calculatedDiscountTransfer->getDescription());
        $octopusOrderDiscountItem->setDisplayName($calculatedDiscountTransfer->getDisplayName());
        $octopusOrderDiscountItem->setAmount($calculatedDiscountTransfer->getUnitAmount());

        return $octopusOrderDiscountItem;
    }
}
