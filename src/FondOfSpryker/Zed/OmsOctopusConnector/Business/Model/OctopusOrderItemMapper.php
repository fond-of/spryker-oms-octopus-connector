<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\OctopusOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class OctopusOrderItemMapper implements OctopusOrderItemMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $spySalesOrderItem
     *
     * @return \Generated\Shared\Transfer\OctopusOrderItemTransfer
     */
    public function mapSpySalesOrderItemEntityToOctopusOrderItem(SpySalesOrderItem $spySalesOrderItem): OctopusOrderItemTransfer
    {
        $octopusOrderItem = new OctopusOrderItemTransfer();

        $octopusOrderItem->setSku($spySalesOrderItem->getSku());
        $octopusOrderItem->setName($spySalesOrderItem->getName());
        $octopusOrderItem->setQuantity($spySalesOrderItem->getQuantity());
        $octopusOrderItem->setPrice($spySalesOrderItem->getPrice());
        $octopusOrderItem->setGrossPrice($spySalesOrderItem->getGrossPrice());
        $octopusOrderItem->setNetPrice($spySalesOrderItem->getNetPrice());
        $octopusOrderItem->setTaxAmount($spySalesOrderItem->getTaxAmount());
        $octopusOrderItem->setTaxAmountFullAggregation($spySalesOrderItem->getTaxAmountFullAggregation());
        $octopusOrderItem->setTaxRate($spySalesOrderItem->getTaxRate());
        $octopusOrderItem->setTaxRateAverageAggregation($spySalesOrderItem->getTaxRateAverageAggregation());
        $octopusOrderItem->setRefundableAmount($spySalesOrderItem->getRefundableAmount());
        $octopusOrderItem->setDiscountAmountAggregation($spySalesOrderItem->getDiscountAmountAggregation());
        $octopusOrderItem->setDiscountAmountFullAggregation($spySalesOrderItem->getDiscountAmountFullAggregation());
        $octopusOrderItem->setSubtotalAggregation($spySalesOrderItem->getSubtotalAggregation());
        $octopusOrderItem->setPriceToPayAggregation($spySalesOrderItem->getPriceToPayAggregation());
        $octopusOrderItem->setProductOptionPriceAggregation($spySalesOrderItem->getProductOptionPriceAggregation());
        $octopusOrderItem->setGroupKey($spySalesOrderItem->getGroupKey());

        return $octopusOrderItem;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderItemTransfer
     */
    public function mapItemTransferToOctopusOrderItem(ItemTransfer $itemTransfer): OctopusOrderItemTransfer
    {
        $octopusOrderItem = new OctopusOrderItemTransfer();

        $octopusOrderItem->setSku($itemTransfer->getSku());
        $octopusOrderItem->setName($itemTransfer->getName());
        $octopusOrderItem->setQuantity($itemTransfer->getQuantity());
        $octopusOrderItem->setPrice($itemTransfer->getUnitPrice());
        $octopusOrderItem->setGrossPrice($itemTransfer->getUnitGrossPrice());
        $octopusOrderItem->setNetPrice($itemTransfer->getUnitNetPrice());
        $octopusOrderItem->setTaxAmount($itemTransfer->getUnitTaxAmount());
        $octopusOrderItem->setTaxAmountFullAggregation($itemTransfer->getUnitTaxAmountFullAggregation());
        $octopusOrderItem->setTaxRate($itemTransfer->getTaxRate());
        $octopusOrderItem->setTaxRateAverageAggregation($itemTransfer->getTaxRateAverageAggregation());
        $octopusOrderItem->setRefundableAmount($itemTransfer->getRefundableAmount());
        $octopusOrderItem->setDiscountAmountAggregation($itemTransfer->getUnitDiscountAmountAggregation());
        $octopusOrderItem->setDiscountAmountFullAggregation($itemTransfer->getUnitDiscountAmountFullAggregation());
        $octopusOrderItem->setSubtotalAggregation($itemTransfer->getUnitSubtotalAggregation());
        $octopusOrderItem->setPriceToPayAggregation($itemTransfer->getUnitPriceToPayAggregation());
        $octopusOrderItem->setProductOptionPriceAggregation($itemTransfer->getUnitProductOptionPriceAggregation());
        $octopusOrderItem->setGroupKey($itemTransfer->getGroupKey());

        return $octopusOrderItem;
    }
}
