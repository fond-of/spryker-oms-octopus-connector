<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\CalculatedDiscountTransfer;
use Generated\Shared\Transfer\OctopusOrderDiscountItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesDiscount;

interface OctopusOrderDiscountItemMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesDiscount $spySalesDiscount
     *
     * @return \Generated\Shared\Transfer\OctopusOrderDiscountItemTransfer
     */
    public function mapSpySalesDiscountToOctopusOrderDiscountItem(SpySalesDiscount $spySalesDiscount): OctopusOrderDiscountItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\CalculatedDiscountTransfer $calculatedDiscountTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderDiscountItemTransfer
     */
    public function mapCalculatedDiscountTransferToOctopusOrderDiscountItem(CalculatedDiscountTransfer $calculatedDiscountTransfer): OctopusOrderDiscountItemTransfer;
}
