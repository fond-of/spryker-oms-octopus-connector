<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\PaymentTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;

class OctopusOrderPaymentItemMapper implements OctopusOrderPaymentItemMapperInterface
{

    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $spySalesPayment
     *
     * @return array
     */
    public function mapSpySalesPaymentToOctopusOrderPaymentItem(SpySalesPayment $spySalesPayment): array
    {
        $octopusPaymentItem = [];

        $octopusPaymentItem['id_sales_payment'] = $spySalesPayment->getIdSalesPayment();
        $octopusPaymentItem['amount'] = $spySalesPayment->getAmount();
        $octopusPaymentItem['sales_payment_method_type'] = [
            'payment_provider' => $spySalesPayment->getSalesPaymentMethodType()->getPaymentProvider(),
            'payment_method' => $spySalesPayment->getSalesPaymentMethodType()->getPaymentMethod(),
        ];

        return $octopusPaymentItem;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTransfer $paymentTransfer
     *
     * @return array
     */
    public function mapPaymentTransferToOctopusOrderPaymentItem(PaymentTransfer $paymentTransfer): array
    {
        $octopusPaymentItem = [];

        $octopusPaymentItem['id_sales_payment'] = $paymentTransfer->getIdSalesPayment();
        $octopusPaymentItem['amount'] = $paymentTransfer->getAmount();
        $octopusPaymentItem['sales_payment_method_type'] = [
            'payment_provider' => $paymentTransfer->getPaymentProvider(),
            'payment_method' => $paymentTransfer->getPaymentMethod(),
        ];

        return $octopusPaymentItem;
    }
}
