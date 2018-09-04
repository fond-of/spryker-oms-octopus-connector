<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\ExpenseTransfer;
use Generated\Shared\Transfer\OctopusOrderShipmentItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesExpense;

class OctopusOrderShipmentItemMapper implements OctopusOrderShipmentItemMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesExpense $spySalesExpense
     *
     * @return \Generated\Shared\Transfer\OctopusOrderShipmentItemTransfer
     */
    public function mapSpySalesExpenseToOctopusOrderShipmentItem(SpySalesExpense $spySalesExpense): OctopusOrderShipmentItemTransfer
    {
        $octopusOrderShipmentItem = new OctopusOrderShipmentItemTransfer();

        $octopusOrderShipmentItem->setIdSalesExpense($spySalesExpense->getIdSalesExpense());
        $octopusOrderShipmentItem->setName($spySalesExpense->getName());
        $octopusOrderShipmentItem->setGrossPrice($spySalesExpense->getGrossPrice());
        $octopusOrderShipmentItem->setNetPrice($spySalesExpense->getNetPrice());
        $octopusOrderShipmentItem->setPrice($spySalesExpense->getPrice());
        $octopusOrderShipmentItem->setTaxRate($spySalesExpense->getTaxRate());
        $octopusOrderShipmentItem->setTaxAmount($spySalesExpense->getTaxAmount());
        $octopusOrderShipmentItem->setRefundableAmount($spySalesExpense->getRefundableAmount());
        $octopusOrderShipmentItem->setPriceToPayAggregation($spySalesExpense->getPriceToPayAggregation());

        return $octopusOrderShipmentItem;
    }

    /**
     * @param \Generated\Shared\Transfer\ExpenseTransfer $expenseTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderShipmentItemTransfer
     */
    public function mapExpenseTransferToOctopusOrderShipmentItem(ExpenseTransfer $expenseTransfer): OctopusOrderShipmentItemTransfer
    {
        $octopusOrderShipmentItem = new OctopusOrderShipmentItemTransfer();

        $octopusOrderShipmentItem->setIdSalesExpense($expenseTransfer->getIdSalesExpense());
        $octopusOrderShipmentItem->setName($expenseTransfer->getName());
        $octopusOrderShipmentItem->setGrossPrice($expenseTransfer->getUnitGrossPrice());
        $octopusOrderShipmentItem->setNetPrice($expenseTransfer->getUnitNetPrice());
        $octopusOrderShipmentItem->setPrice($expenseTransfer->getUnitPrice());
        $octopusOrderShipmentItem->setTaxRate($expenseTransfer->getTaxRate());
        $octopusOrderShipmentItem->setTaxAmount($expenseTransfer->getUnitTaxAmount());
        $octopusOrderShipmentItem->setRefundableAmount($expenseTransfer->getRefundableAmount());
        $octopusOrderShipmentItem->setPriceToPayAggregation($expenseTransfer->getUnitPriceToPayAggregation());

        return $octopusOrderShipmentItem;
    }
}
