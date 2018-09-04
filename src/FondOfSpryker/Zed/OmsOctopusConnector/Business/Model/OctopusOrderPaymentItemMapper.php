<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\OctopusOrderPaymentItemTransfer;
use Generated\Shared\Transfer\OctopusOrderPaymentMethodTypeTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;

class OctopusOrderPaymentItemMapper implements OctopusOrderPaymentItemMapperInterface
{
    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $spySalesPayment
     *
     * @return \Generated\Shared\Transfer\OctopusOrderPaymentItemTransfer
     */
    public function mapSpySalesPaymentToOctopusOrderPaymentItem(SpySalesPayment $spySalesPayment): OctopusOrderPaymentItemTransfer
    {
        $octopusPaymentItem = new OctopusOrderPaymentItemTransfer();
        $octopusPaymentMethodType = new OctopusOrderPaymentMethodTypeTransfer();

        $spySalesPaymentMethodType = $spySalesPayment->getSalesPaymentMethodType();
        $octopusPaymentMethodType->setPaymentMethod($spySalesPaymentMethodType->getPaymentMethod());
        $octopusPaymentMethodType->setPaymentProvider($spySalesPaymentMethodType->getPaymentProvider());

        $octopusPaymentItem->setIdSalesPayment($spySalesPayment->getIdSalesPayment());
        $octopusPaymentItem->setAmount($spySalesPayment->getAmount());
        $octopusPaymentItem->setSalesPaymentMethodType($octopusPaymentMethodType);

        return $octopusPaymentItem;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTransfer $paymentTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderPaymentItemTransfer
     */
    public function mapPaymentTransferToOctopusOrderPaymentItem(PaymentTransfer $paymentTransfer): OctopusOrderPaymentItemTransfer
    {
        $octopusPaymentItem = new OctopusOrderPaymentItemTransfer();
        $octopusPaymentMethodType = new OctopusOrderPaymentMethodTypeTransfer();

        $octopusPaymentMethodType->setPaymentMethod($paymentTransfer->getPaymentMethod());
        $octopusPaymentMethodType->setPaymentProvider($paymentTransfer->getPaymentProvider());

        $octopusPaymentItem->setIdSalesPayment($paymentTransfer->getIdSalesPayment());
        $octopusPaymentItem->setAmount($paymentTransfer->getAmount());
        $octopusPaymentItem->setSalesPaymentMethodType($octopusPaymentMethodType);

        return $octopusPaymentItem;
    }
}
