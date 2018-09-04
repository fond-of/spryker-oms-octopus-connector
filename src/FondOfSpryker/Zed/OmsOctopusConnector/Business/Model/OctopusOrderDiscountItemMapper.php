<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\CalculatedDiscountTransfer;
use Orm\Zed\Sales\Persistence\SpySalesDiscount;

class OctopusOrderDiscountItemMapper implements OctopusOrderDiscountItemMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesDiscount $spySalesDiscount
     *
     * @return array
     */
    public function mapSpySalesDiscountToOctopusOrderDiscountItem(
        SpySalesDiscount $spySalesDiscount
    ): array {
        $octopusOrderDiscountItem = [];

        $octopusOrderDiscountItem['description'] = $spySalesDiscount->getDescription();
        $octopusOrderDiscountItem['display_name'] = $spySalesDiscount->getDisplayName();
        $octopusOrderDiscountItem['amount'] = $spySalesDiscount->getAmount();

        return $octopusOrderDiscountItem;
    }

    /**
     * @param \Generated\Shared\Transfer\CalculatedDiscountTransfer $calculatedDiscountTransfer
     *
     * @return array
     */
    public function mapCalculatedDiscountTransferToOctopusOrderDiscountItem(
        CalculatedDiscountTransfer $calculatedDiscountTransfer
    ): array {
        $octopusOrderDiscountItem = [];

        $octopusOrderDiscountItem['description'] = $calculatedDiscountTransfer->getDescription();
        $octopusOrderDiscountItem['display_name'] = $calculatedDiscountTransfer->getDisplayName();
        $octopusOrderDiscountItem['amount'] = $calculatedDiscountTransfer->getUnitAmount();

        return $octopusOrderDiscountItem;
    }
}
