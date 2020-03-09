<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use ArrayObject;
use FondOfSpryker\Shared\OmsOctopusConnector\OmsOctopusConnectorConstants;
use Generated\Shared\Transfer\OctopusOrderPaymentItemTransfer;
use Generated\Shared\Transfer\OctopusOrderShipmentItemTransfer;
use Generated\Shared\Transfer\OctopusOrderTotalTransfer;
use Generated\Shared\Transfer\OctopusOrderTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Shipment\ShipmentConstants;

class OctopusOrderMapper implements OctopusOrderMapperInterface
{
    /**
     * @see \Spryker\Shared\Shipment\ShipmentConfig::SHIPMENT_EXPENSE_TYPE|\Spryker\Shared\Shipment\ShipmentConstants::SHIPMENT_EXPENSE_TYPE
     */
    protected const SHIPMENT_EXPENSE_TYPE = 'SHIPMENT_EXPENSE_TYPE';

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
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderTotalMapperInterface
     */
    protected $octopusOrderTotalMapper;

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
        OctopusOrderPaymentItemMapperInterface $octopusOrderPaymentItemMapper,
        OctopusOrderTotalMapperInterface $octopusOrderTotalMapper
    ) {
        $this->octopusOrderAddressMapper = $octopusOrderAddressMapper;
        $this->octopusOrderDiscountItemMapper = $octopusOrderDiscountItemMapper;
        $this->octopusOrderShipmentItemMapper = $octopusOrderShipmentItemMapper;
        $this->octopusOrderPaymentItemMapper = $octopusOrderPaymentItemMapper;
        $this->octopusOrderTotalMapper = $octopusOrderTotalMapper;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return \Generated\Shared\Transfer\OctopusOrderTransfer
     */
    public function mapSpySalesOrderToOctopusOrder(SpySalesOrder $spySalesOrder): OctopusOrderTransfer
    {
        $octopusOrder = $this->mapOctopusOrderHeaderBySpySalesOrder($spySalesOrder);

        $octopusOrder->setBillingAddress($this->octopusOrderAddressMapper
            ->mapSpySalesOrderAddressToOctopusOrderAddress($spySalesOrder->getBillingAddress()));
        $octopusOrder->setShippingAddress($this->octopusOrderAddressMapper
            ->mapSpySalesOrderAddressToOctopusOrderAddress($spySalesOrder->getShippingAddress()));

        $octopusOrder->setShipmentItem($this->getOctopusOrderShipmentItemBySpySalesOrder($spySalesOrder));
        $octopusOrder->setDiscountItems($this->getOctopusOrderDiscountItemsBySpySalesOrder($spySalesOrder));
        $octopusOrder->setPaymentItem($this->getOctopusOrderPaymentItemBySpySalesOrder($spySalesOrder));
        $octopusOrder->setOrderTotal($this->getOctopusOrderTotalBySpySalesOrder($spySalesOrder));

        return $octopusOrder;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return \Generated\Shared\Transfer\OctopusOrderTransfer
     */
    protected function mapOctopusOrderHeaderBySpySalesOrder(SpySalesOrder $spySalesOrder): OctopusOrderTransfer
    {
        $octopusOrderHeader = new OctopusOrderTransfer();

        $octopusOrderHeader->setTest($spySalesOrder->getIsTest());
        $octopusOrderHeader->setCreatedAt($spySalesOrder->getCreatedAt()->format('Y-m-d H:i:s.u'));
        $octopusOrderHeader->setIdSalesOrder($spySalesOrder->getIdSalesOrder());
        $octopusOrderHeader->setCustomerReference($spySalesOrder->getCustomerReference());
        $octopusOrderHeader->setOrderReference($spySalesOrder->getOrderReference());
        $octopusOrderHeader->setCurrencyIsoCode($spySalesOrder->getCurrencyIsoCode());
        $octopusOrderHeader->setLanguageCode($spySalesOrder->getLocale()->getLocaleName());
        $octopusOrderHeader->setPriceMode($spySalesOrder->getPriceMode());
        $octopusOrderHeader->setStore($spySalesOrder->getStore());
        $octopusOrderHeader->setEmail($spySalesOrder->getEmail());
        $octopusOrderHeader->setSalutation($spySalesOrder->getSalutation());
        $octopusOrderHeader->setFirstName($spySalesOrder->getFirstName());
        $octopusOrderHeader->setLastName($spySalesOrder->getLastName());
        $octopusOrderHeader->setSystemCode(Config::get(OmsOctopusConnectorConstants::SYSTEM_CODE));

        return $octopusOrderHeader;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return \Generated\Shared\Transfer\OctopusOrderShipmentItemTransfer
     */
    protected function getOctopusOrderShipmentItemBySpySalesOrder(
        SpySalesOrder $spySalesOrder
    ): OctopusOrderShipmentItemTransfer {
        // ToDo SprykerUpgrade Workaround
        $expanses = $spySalesOrder->getExpenses();

        if ($expanses === null){
            foreach ($spySalesOrder->getItems() as $orderItem){
                if ($orderItem->getSpySalesShipment() !== null && $orderItem->getSpySalesShipment()->getExpense() !== null){
                    $expanses = $orderItem->getSpySalesShipment()->getExpense();
                    break;
                }
            }
        }
        //ToDo End
        foreach ($expanses as $spySalesExpense) {
            if ($spySalesExpense->getType() !== static::SHIPMENT_EXPENSE_TYPE) {
                continue;
            }

            return $this->octopusOrderShipmentItemMapper
                ->mapSpySalesExpenseToOctopusOrderShipmentItem($spySalesExpense);
        }
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return \Generated\Shared\Transfer\OctopusOrderDiscountItemTransfer[]
     */
    protected function getOctopusOrderDiscountItemsBySpySalesOrder(SpySalesOrder $spySalesOrder): ArrayObject
    {
        $octopusOrderDiscountItems = new ArrayObject();

        foreach ($spySalesOrder->getDiscounts() as $spySalesDiscount) {
            $octopusOrderDiscountItems->append(
                $this->octopusOrderDiscountItemMapper
                    ->mapSpySalesDiscountToOctopusOrderDiscountItem($spySalesDiscount)
            );
        }

        return $octopusOrderDiscountItems;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return \Generated\Shared\Transfer\OctopusOrderPaymentItemTransfer
     */
    protected function getOctopusOrderPaymentItemBySpySalesOrder(
        SpySalesOrder $spySalesOrder
    ): OctopusOrderPaymentItemTransfer {
        $spySalesPayment = $spySalesOrder->getOrdersJoinSalesPaymentMethodType()->getFirst();

        return $this->octopusOrderPaymentItemMapper->mapSpySalesPaymentToOctopusOrderPaymentItem($spySalesPayment);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderTransfer
     */
    public function mapOrderTransferToOctopusOrder(OrderTransfer $orderTransfer): OctopusOrderTransfer
    {
        $octopusOrder = $this->mapOctopusOrderHeaderByOrderTransfer($orderTransfer);

        $octopusOrder->setBillingAddress($this->octopusOrderAddressMapper
            ->mapAddressTransferToOctopusOrderAddress($orderTransfer->getBillingAddress()));

        //ToDo SprykerUpgrade remove workaround!
        $address = null;
        foreach ($orderTransfer->getItems() as $itemTransfer) {
            if ($address !== null) {
                continue;
            }
            if ($itemTransfer !== null && $itemTransfer->getShipment() !== null && $itemTransfer->getShipment()->getShippingAddress() !== null){
                $address = $itemTransfer->getShipment()->getShippingAddress();
            }
        }

        if ($address === null && method_exists($orderTransfer, 'getShippingAddress')){
            $address = $orderTransfer->getShippingAddress();
        }
        //End ToDo

        $octopusOrder->setShippingAddress($this->octopusOrderAddressMapper
            ->mapAddressTransferToOctopusOrderAddress($address));

        $octopusOrder->setShipmentItem($this->getOctopusOrderShipmentItemByOrderTransfer($orderTransfer));
        $octopusOrder->setDiscountItems($this->getOctopusOrderDiscountItemsByOrderTransfer($orderTransfer));
        $octopusOrder->setPaymentItem($this->getOctopusOrderPaymentItemByOrderTransfer($orderTransfer));
        $octopusOrder->setOrderTotal($this->getOctopusOrderTotalByOrderTransfer($orderTransfer));

        return $octopusOrder;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderTransfer
     */
    protected function mapOctopusOrderHeaderByOrderTransfer(OrderTransfer $orderTransfer): OctopusOrderTransfer
    {
        $octopusOrderHeader = new OctopusOrderTransfer();

        $octopusOrderHeader->setTest($orderTransfer->getIsTest());
        $octopusOrderHeader->setCreatedAt($orderTransfer->getCreatedAt());
        $octopusOrderHeader->setIdSalesOrder($orderTransfer->getIdSalesOrder());
        $octopusOrderHeader->setCustomerReference($orderTransfer->getCustomerReference());
        $octopusOrderHeader->setOrderReference($orderTransfer->getOrderReference());
        $octopusOrderHeader->setCurrencyIsoCode($orderTransfer->getCurrencyIsoCode());
        $octopusOrderHeader->setLanguageCode($orderTransfer->getLocale()->getLocaleName());
        $octopusOrderHeader->setPriceMode($orderTransfer->getPriceMode());
        $octopusOrderHeader->setStore($orderTransfer->getStore());
        $octopusOrderHeader->setEmail($orderTransfer->getEmail());
        $octopusOrderHeader->setSalutation($orderTransfer->getSalutation());
        $octopusOrderHeader->setFirstName($orderTransfer->getFirstName());
        $octopusOrderHeader->setLastName($orderTransfer->getLastName());
        $octopusOrderHeader->setSystemCode(Config::get(OmsOctopusConnectorConstants::SYSTEM_CODE));

        return $octopusOrderHeader;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderShipmentItemTransfer
     */
    protected function getOctopusOrderShipmentItemByOrderTransfer(
        OrderTransfer $orderTransfer
    ): OctopusOrderShipmentItemTransfer {
        foreach ($orderTransfer->getExpenses() as $expenseTransfer) {
            if ($expenseTransfer->getType() !== static::SHIPMENT_EXPENSE_TYPE) {
                continue;
            }

            return $this->octopusOrderShipmentItemMapper
                ->mapExpenseTransferToOctopusOrderShipmentItem($expenseTransfer);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderDiscountItemTransfer[]|\ArrayObject
     */
    protected function getOctopusOrderDiscountItemsByOrderTransfer(OrderTransfer $orderTransfer): ArrayObject
    {
        $octopusOrderDiscountItems = new ArrayObject();

        foreach ($orderTransfer->getItems() as $orderItem) {
            if ($orderItem->getCalculatedDiscounts()->count() === 0) {
                continue;
            }

            foreach ($orderItem->getCalculatedDiscounts() as $calculatedDiscountTransfer) {
                $octopusOrderDiscountItems->append($this->octopusOrderDiscountItemMapper
                    ->mapCalculatedDiscountTransferToOctopusOrderDiscountItem($calculatedDiscountTransfer));
            }
        }

        return $octopusOrderDiscountItems;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderPaymentItemTransfer
     */
    protected function getOctopusOrderPaymentItemByOrderTransfer(
        OrderTransfer $orderTransfer
    ): OctopusOrderPaymentItemTransfer {
        $paymentTransfer = $orderTransfer->getPayments()->offsetGet(0);

        return $this->octopusOrderPaymentItemMapper->mapPaymentTransferToOctopusOrderPaymentItem($paymentTransfer);
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return \Generated\Shared\Transfer\OctopusOrderTotalTransfer
     */
    protected function getOctopusOrderTotalBySpySalesOrder(SpySalesOrder $spySalesOrder): OctopusOrderTotalTransfer
    {
        $spySalesOrderTotals = $spySalesOrder->getOrderTotals()->getFirst();

        return $this->octopusOrderTotalMapper->mapSpySalesOrderTotalToOctopusOrderTotal($spySalesOrderTotals);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderTotalTransfer
     */
    protected function getOctopusOrderTotalByOrderTransfer(OrderTransfer $orderTransfer): OctopusOrderTotalTransfer
    {
        return $this->octopusOrderTotalMapper->mapOrderTransferToOctopusOrderTotal($orderTransfer);
    }
}
