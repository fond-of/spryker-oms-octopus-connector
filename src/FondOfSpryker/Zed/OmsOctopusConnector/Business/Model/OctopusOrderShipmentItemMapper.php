<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\ExpenseTransfer;
use Orm\Zed\Sales\Persistence\SpySalesExpense;

class OctopusOrderShipmentItemMapper implements OctopusOrderShipmentItemMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesExpense $spySalesExpense
     *
     * @return array
     */
    public function mapSpySalesExpenseToOctopusOrderShipmentItem(SpySalesExpense $spySalesExpense): array
    {
        $octopusOrderShipmentItem = [];

        $octopusOrderShipmentItem['id_sales_expense'] = $spySalesExpense->getIdSalesExpense();
        $octopusOrderShipmentItem['name'] = $spySalesExpense->getName();
        $octopusOrderShipmentItem['gross_price'] = $spySalesExpense->getGrossPrice();
        $octopusOrderShipmentItem['net_price'] = $spySalesExpense->getNetPrice();
        $octopusOrderShipmentItem['price'] = $spySalesExpense->getPrice();
        $octopusOrderShipmentItem['tax_rate'] = $spySalesExpense->getTaxRate();
        $octopusOrderShipmentItem['tax_amount'] = $spySalesExpense->getTaxAmount();
        $octopusOrderShipmentItem['refundable_amount'] = $spySalesExpense->getRefundableAmount();
        $octopusOrderShipmentItem['price_to_pay_aggregation'] = $spySalesExpense->getPriceToPayAggregation();

        return $octopusOrderShipmentItem;
    }

    /**
     * @param \Generated\Shared\Transfer\ExpenseTransfer $expenseTransfer
     *
     * @return array
     */
    public function mapExpenseTransferToOctopusOrderShipmentItem(ExpenseTransfer $expenseTransfer): array
    {
        $octopusOrderShipmentItem = [];

        $octopusOrderShipmentItem['id_sales_expense'] = $expenseTransfer->getIdSalesExpense();
        $octopusOrderShipmentItem['name'] = $expenseTransfer->getName();
        $octopusOrderShipmentItem['gross_price'] = $expenseTransfer->getUnitGrossPrice();
        $octopusOrderShipmentItem['net_price'] = $expenseTransfer->getUnitNetPrice();
        $octopusOrderShipmentItem['price'] = $expenseTransfer->getUnitPrice();
        $octopusOrderShipmentItem['tax_rate'] = $expenseTransfer->getTaxRate();
        $octopusOrderShipmentItem['tax_amount'] = $expenseTransfer->getUnitTaxAmount();
        $octopusOrderShipmentItem['refundable_amount'] = $expenseTransfer->getRefundableAmount();
        $octopusOrderShipmentItem['price_to_pay_aggregation'] = $expenseTransfer->getUnitPriceToPayAggregation();

        return $octopusOrderShipmentItem;
    }
}
