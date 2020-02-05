<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\OctopusOrderTotalTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderTotals;

class OctopusOrderTotalMapper implements OctopusOrderTotalMapperInterface
{
    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $spySalesPayment
     *
     * @return \Generated\Shared\Transfer\OctopusOrderPaymentItemTransfer
     */
    public function mapSpySalesOrderTotalToOctopusOrderTotal(SpySalesOrderTotals $spySalesOrderTotals): OctopusOrderTotalTransfer
    {
        $octopusOrderTotal = new OctopusOrderTotalTransfer();

        $octopusOrderTotal->setCreatedAt($spySalesOrderTotals->getCreatedAt()->format('Y-m-d H:i:s.u'));
        $octopusOrderTotal->setUpdatedAt($spySalesOrderTotals->getUpdatedAt()->format('Y-m-d H:i:s.u'));
        $octopusOrderTotal->setSubTotal($spySalesOrderTotals->getSubtotal());
        $octopusOrderTotal->setOrderExpenseTotal($spySalesOrderTotals->getOrderExpenseTotal());
        $octopusOrderTotal->setDiscountTotal($spySalesOrderTotals->getDiscountTotal());
        $octopusOrderTotal->setGrandTotal($spySalesOrderTotals->getGrandTotal());
        $octopusOrderTotal->setRefundTotal($spySalesOrderTotals->getRefundTotal());
        $octopusOrderTotal->setCanceledTotal($spySalesOrderTotals->getCanceledTotal());
        $octopusOrderTotal->setTaxTotal($spySalesOrderTotals->getTaxTotal());

        return $octopusOrderTotal;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderTotalTransfer
     */
    public function mapOrderTransferToOctopusOrderTotal(OrderTransfer $orderTransfer): OctopusOrderTotalTransfer
    {
        $octopusOrderTotal = new OctopusOrderTotalTransfer();
        $totalsTransfer = $orderTransfer->getTotals();

        $octopusOrderTotal->setCreatedAt($orderTransfer->getCreatedAt());
        $octopusOrderTotal->setUpdatedAt($orderTransfer->getCreatedAt());
        $octopusOrderTotal->setSubTotal($totalsTransfer->getSubtotal());
        $octopusOrderTotal->setOrderExpenseTotal($totalsTransfer->getExpenseTotal());
        $octopusOrderTotal->setDiscountTotal($totalsTransfer->getDiscountTotal());
        $octopusOrderTotal->setGrandTotal($totalsTransfer->getGrandTotal());
        $octopusOrderTotal->setRefundTotal($totalsTransfer->getRefundTotal());
        $octopusOrderTotal->setCanceledTotal($totalsTransfer->getCanceledTotal());
        $octopusOrderTotal->setTaxTotal($totalsTransfer->getTaxTotal()->getAmount());

        return $octopusOrderTotal;
    }
}
