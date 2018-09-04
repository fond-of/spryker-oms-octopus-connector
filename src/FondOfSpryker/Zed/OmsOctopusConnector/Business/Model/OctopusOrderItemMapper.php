<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\ItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class OctopusOrderItemMapper implements OctopusOrderItemMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $spySalesOrderItem
     *
     * @return array
     */
    public function mapSpySalesOrderItemEntityToOctopusOrderItem(SpySalesOrderItem $spySalesOrderItem): array
    {
        $octopusOrderItem = [];

        $octopusOrderItem['sku'] = $spySalesOrderItem->getSku();
        $octopusOrderItem['name'] = $spySalesOrderItem->getName();
        $octopusOrderItem['quantity'] = $spySalesOrderItem->getQuantity();
        $octopusOrderItem['price'] = $spySalesOrderItem->getPrice();
        $octopusOrderItem['gross_price'] = $spySalesOrderItem->getGrossPrice();
        $octopusOrderItem['net_price'] = $spySalesOrderItem->getNetPrice();
        $octopusOrderItem['tax_amount'] = $spySalesOrderItem->getTaxAmount();
        $octopusOrderItem['tax_amount_full_aggregation'] = $spySalesOrderItem->getTaxAmountFullAggregation();
        $octopusOrderItem['tax_rate'] = $spySalesOrderItem->getTaxRate();
        $octopusOrderItem['tax_rate_average_aggregation'] = $spySalesOrderItem->getTaxRateAverageAggregation();
        $octopusOrderItem['refundable_amount'] = $spySalesOrderItem->getRefundableAmount();
        $octopusOrderItem['discount_amount_aggregation'] = $spySalesOrderItem->getDiscountAmountAggregation();
        $octopusOrderItem['discount_amount_full_aggregation'] = $spySalesOrderItem->getDiscountAmountFullAggregation();
        $octopusOrderItem['subtotal_aggregation'] = $spySalesOrderItem->getSubtotalAggregation();
        $octopusOrderItem['price_to_pay_aggregation'] = $spySalesOrderItem->getPriceToPayAggregation();
        $octopusOrderItem['product_option_price_aggregation'] = $spySalesOrderItem->getProductOptionPriceAggregation();
        $octopusOrderItem['group_key'] = $spySalesOrderItem->getGroupKey();

        return $octopusOrderItem;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return array
     */
    public function mapItemTransferToOctopusOrderItem(ItemTransfer $itemTransfer): array
    {
        $octopusOrderItem = [];

        $octopusOrderItem['id_sales_order_item'] = $itemTransfer->getIdSalesOrderItem();
        $octopusOrderItem['sku'] = $itemTransfer->getSku();
        $octopusOrderItem['name'] = $itemTransfer->getName();
        $octopusOrderItem['quantity'] = $itemTransfer->getQuantity();
        $octopusOrderItem['price'] = $itemTransfer->getUnitPrice();
        $octopusOrderItem['gross_price'] = $itemTransfer->getUnitGrossPrice();
        $octopusOrderItem['net_price'] = $itemTransfer->getUnitNetPrice();
        $octopusOrderItem['tax_amount'] = $itemTransfer->getUnitTaxAmount();
        $octopusOrderItem['tax_amount_full_aggregation'] = $itemTransfer->getUnitTaxAmountFullAggregation();
        $octopusOrderItem['tax_rate'] = $itemTransfer->getTaxRate();
        $octopusOrderItem['tax_rate_average_aggregation'] = $itemTransfer->getTaxRateAverageAggregation();
        $octopusOrderItem['refundable_amount'] = $itemTransfer->getRefundableAmount();
        $octopusOrderItem['discount_amount_aggregation'] = $itemTransfer->getUnitDiscountAmountAggregation();
        $octopusOrderItem['discount_amount_full_aggregation'] = $itemTransfer->getUnitDiscountAmountFullAggregation();
        $octopusOrderItem['subtotal_aggregation'] = $itemTransfer->getUnitSubtotalAggregation();
        $octopusOrderItem['price_to_pay_aggregation'] = $itemTransfer->getUnitPriceToPayAggregation();
        $octopusOrderItem['product_option_price_aggregation'] = $itemTransfer->getUnitProductOptionPriceAggregation();
        $octopusOrderItem['group_key'] = $itemTransfer->getGroupKey();

        return $octopusOrderItem;
    }
}
