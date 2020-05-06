<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\OctopusOrderPaymentItemTransfer;
use Generated\Shared\Transfer\OctopusOrderPaymentMethodTypeTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;

class OctopusOrderPaymentItemMapper implements OctopusOrderPaymentItemMapperInterface
{
    /**
     * @var array|\FondOfSpryker\Zed\OmsOctopusConnectorExtension\Dependency\Plugin\OctopusOrderPaymentItemTransferExpanderPluginInterface[]
     */
    protected $octopusOrderPaymentItemTransferExpanderPlugins;

    /**
     * OctopusOrderPaymentItemMapper constructor.
     *
     * @param \FondOfSpryker\Zed\OmsOctopusConnectorExtension\Dependency\Plugin\OctopusOrderPaymentItemTransferExpanderPluginInterface[] $octopusOrderPaymentItemTransferExpanderPlugins
     */
    public function __construct(
        array $octopusOrderPaymentItemTransferExpanderPlugins
    ) {
        $this->octopusOrderPaymentItemTransferExpanderPlugins = $octopusOrderPaymentItemTransferExpanderPlugins;
    }

    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $spySalesPayment
     *
     * @return \Generated\Shared\Transfer\OctopusOrderPaymentItemTransfer
     */
    public function mapSpySalesPaymentToOctopusOrderPaymentItem(SpySalesPayment $spySalesPayment): OctopusOrderPaymentItemTransfer
    {
        $spySalesOrder = $spySalesPayment->getSalesOrder();
        $customerName = sprintf('%s %s', $spySalesOrder->getFirstName(), $spySalesOrder->getLastName());

        $octopusPaymentItem = new OctopusOrderPaymentItemTransfer();
        $octopusPaymentMethodType = new OctopusOrderPaymentMethodTypeTransfer();

        $spySalesPaymentMethodType = $spySalesPayment->getSalesPaymentMethodType();
        $octopusPaymentMethodType->setPaymentMethod($spySalesPaymentMethodType->getPaymentMethod());
        $octopusPaymentMethodType->setPaymentProvider($spySalesPaymentMethodType->getPaymentProvider());

        $octopusPaymentItem->setIdSalesPayment($spySalesPayment->getIdSalesPayment());
        $octopusPaymentItem->setAmount($spySalesPayment->getAmount());
        $octopusPaymentItem->setSalesPaymentMethodType($octopusPaymentMethodType);
        $octopusPaymentItem->setCustomerName($customerName);
        $octopusPaymentItem->setCustomerEmail($spySalesOrder->getEmail());

        $octopusPaymentItem = $this->expandOctopusOrderPaymentItemTransfer(
            $this->mapSpySalesPaymentToPaymentTransfer($spySalesPayment),
            $octopusPaymentItem
        );

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
        $octopusPaymentItem = $this->expandOctopusOrderPaymentItemTransfer($octopusPaymentItem, $paymentTransfer);

        return $octopusPaymentItem;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function expandOctopusOrderPaymentItemTransfer(
        PaymentTransfer $paymentTransfer,
        OctopusOrderPaymentItemTransfer $octopusOrderPaymentItemTransfer
    ): OctopusOrderPaymentItemTransfer {
        foreach ($this->octopusOrderPaymentItemTransferExpanderPlugins as $octopusOrderPaymentItemTransferExpanderPlugin) {
            $octopusPaymentItem = $octopusOrderPaymentItemTransferExpanderPlugin
                ->expandOctopusOrderPaymentItemTransfer($octopusOrderPaymentItemTransfer, $paymentTransfer);
        }

        return $octopusPaymentItem;
    }

    /**
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment $spySalesPayment
     *
     * @return \Generated\Shared\Transfer\PaymentTransfer
     */
    protected function mapSpySalesPaymentToPaymentTransfer(SpySalesPayment $spySalesPayment): PaymentTransfer
    {
        $paymentTransfer = new PaymentTransfer();
        $paymentTransfer->setPaymentMethod($spySalesPayment->getSalesPaymentMethodType()->getPaymentMethod());
        $paymentTransfer->fromArray($spySalesPayment->toArray(), true);

        return $paymentTransfer;
    }
}
