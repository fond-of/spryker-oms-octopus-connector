<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\CalculatedDiscountTransfer;
use Orm\Zed\Sales\Persistence\SpySalesDiscount;

interface OctopusOrderDiscountItemMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesDiscount $spySalesDiscount
     *
     * @return array
     */
    public function mapSpySalesDiscountToOctopusOrderDiscountItem(SpySalesDiscount $spySalesDiscount): array;

    /**
     * @param \Generated\Shared\Transfer\CalculatedDiscountTransfer $calculatedDiscountTransfer
     *
     * @return array
     */
    public function mapCalculatedDiscountTransferToOctopusOrderDiscountItem(CalculatedDiscountTransfer $calculatedDiscountTransfer): array;
}
