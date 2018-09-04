<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\OctopusOrderPaymentItemTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;

interface OctopusOrderPaymentItemMapperInterface
{
    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $spySalesPayment
     *
     * @return \Generated\Shared\Transfer\OctopusOrderPaymentItemTransfer
     */
    public function mapSpySalesPaymentToOctopusOrderPaymentItem(SpySalesPayment $spySalesPayment): OctopusOrderPaymentItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\PaymentTransfer $paymentTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderPaymentItemTransfer
     */
    public function mapPaymentTransferToOctopusOrderPaymentItem(PaymentTransfer $paymentTransfer): OctopusOrderPaymentItemTransfer;
}
