<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\OrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Shared\Shipment\ShipmentConstants;

class OctopusOrderMapper implements OctopusOrderMapperInterface
{
    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderAddressMapperInterface
     */
    protected $octopusOrderAddressMapper;

    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderDiscountItemMapperInterface
     */
    protected $octopusOrderDiscountItemMapper;

    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderShipmentItemMapperInterface
     */
    protected $octopusOrderShipmentItemMapper;

    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderPaymentItemMapperInterface
     */
    protected $octopusOrderPaymentItemMapper;

    /**
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderAddressMapperInterface $octopusOrderAddressMapper
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderDiscountItemMapperInterface $octopusOrderDiscountItemMapper
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderShipmentItemMapperInterface $octopusOrderShipmentItemMapper
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderPaymentItemMapperInterface $octopusOrderPaymentItemMapper
     */
    public function __construct(
        OctopusOrderAddressMapperInterface $octopusOrderAddressMapper,
        OctopusOrderDiscountItemMapperInterface $octopusOrderDiscountItemMapper,
        OctopusOrderShipmentItemMapperInterface $octopusOrderShipmentItemMapper,
        OctopusOrderPaymentItemMapperInterface $octopusOrderPaymentItemMapper
    ) {
        $this->octopusOrderAddressMapper = $octopusOrderAddressMapper;
        $this->octopusOrderDiscountItemMapper = $octopusOrderDiscountItemMapper;
        $this->octopusOrderShipmentItemMapper = $octopusOrderShipmentItemMapper;
        $this->octopusOrderPaymentItemMapper = $octopusOrderPaymentItemMapper;
    }


    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return string
     */
    public function mapSpySalesOrderToOctopusOrder(SpySalesOrder $spySalesOrder): array
    {
        $octopusOrder = $this->getOctopusOrderHeaderBySpySalesOrder($spySalesOrder);

        $octopusOrder['billing_address'] = $this->octopusOrderAddressMapper
            ->mapSpySalesOrderAddressToOctopusOrderAddress($spySalesOrder->getBillingAddress());
        $octopusOrder['shipping_address'] = $this->octopusOrderAddressMapper
            ->mapSpySalesOrderAddressToOctopusOrderAddress($spySalesOrder->getShippingAddress());

        $octopusOrder['shipment_item'] = $this->getOctopusOrderShipmentItemBySpySalesOrder($spySalesOrder);
        $octopusOrder['discount_items'] = $this->getOctopusOrderDiscountItemsBySpySalesOrder($spySalesOrder);
        $octopusOrder['payment_item'] = $this->getOctopusOrderPaymentItemBySpySalesOrder($spySalesOrder);

        return $octopusOrder;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return array
     */
    protected function getOctopusOrderHeaderBySpySalesOrder(SpySalesOrder $spySalesOrder): array
    {
        $octopusOrderHeader = [];

        $octopusOrderHeader['test'] = $spySalesOrder->getIsTest();
        $octopusOrderHeader['is_test'] = $spySalesOrder->getIsTest();
        $octopusOrderHeader['created_at'] = $spySalesOrder->getCreatedAt();
        $octopusOrderHeader['updated_at'] = $spySalesOrder->getUpdatedAt();
        $octopusOrderHeader['id_sales_order'] = $spySalesOrder->getIdSalesOrder();
        $octopusOrderHeader['customer_reference'] = $spySalesOrder->getCustomerReference();
        $octopusOrderHeader['order_reference'] = $spySalesOrder->getOrderReference();
        $octopusOrderHeader['currency_iso_code'] = $spySalesOrder->getCurrencyIsoCode();
        $octopusOrderHeader['language_code'] = $spySalesOrder->getLocale()->getLocaleName();
        $octopusOrderHeader['price_mode'] = $spySalesOrder->getPriceMode();
        $octopusOrderHeader['store'] = $spySalesOrder->getStore();
        $octopusOrderHeader['email'] = $spySalesOrder->getEmail();
        $octopusOrderHeader['salutation'] = $spySalesOrder->getSalutation();
        $octopusOrderHeader['first_name'] = $spySalesOrder->getFirstName();
        $octopusOrderHeader['last_name'] = $spySalesOrder->getLastName();


        return $octopusOrderHeader;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return array
     */
    protected function getOctopusOrderShipmentItemBySpySalesOrder(SpySalesOrder $spySalesOrder): array
    {
        foreach ($spySalesOrder->getExpenses() as $spySalesExpense) {
            if ($spySalesExpense->getType() !== ShipmentConstants::SHIPMENT_EXPENSE_TYPE) {
                continue;
            }

            return $this->octopusOrderShipmentItemMapper
                        ->mapSpySalesExpenseToOctopusOrderShipmentItem($spySalesExpense);
        }
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return array
     */
    protected function getOctopusOrderDiscountItemsBySpySalesOrder(SpySalesOrder $spySalesOrder): array
    {
        $octopusOrderDiscountItems = [];

        foreach ($spySalesOrder->getDiscounts() as $spySalesDiscount) {
            $octopusOrderDiscountItems[] = $this->octopusOrderDiscountItemMapper
                ->mapSpySalesDiscountToOctopusOrderDiscountItem($spySalesDiscount);
        }

        return $octopusOrderDiscountItems;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return array
     */
    protected function getOctopusOrderPaymentItemBySpySalesOrder(SpySalesOrder $spySalesOrder): array
    {
        $spySalesPayment = $spySalesOrder->getOrdersJoinSalesPaymentMethodType()->getFirst();

        return $this->octopusOrderPaymentItemMapper->mapSpySalesPaymentToOctopusOrderPaymentItem($spySalesPayment);
    }


    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return string
     */
    public function mapOrderTransferToOctopusOrder(OrderTransfer $orderTransfer): array
    {
        $orderTransfer->getPayments();
        return [];
    }
}
