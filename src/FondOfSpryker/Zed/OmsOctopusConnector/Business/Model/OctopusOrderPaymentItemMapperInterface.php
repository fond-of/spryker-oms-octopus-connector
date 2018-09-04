<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\PaymentTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;

interface OctopusOrderPaymentItemMapperInterface
{
    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $spySalesPayment
     *
     * @return array
     */
    public function mapSpySalesPaymentToOctopusOrderPaymentItem(SpySalesPayment $spySalesPayment): array;

    /**
     * @param \Generated\Shared\Transfer\PaymentTransfer $paymentTransfer
     *
     * @return array
     */
    public function mapPaymentTransferToOctopusOrderPaymentItem(PaymentTransfer $paymentTransfer): array;
}
