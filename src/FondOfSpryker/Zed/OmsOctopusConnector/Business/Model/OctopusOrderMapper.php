<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

class OctopusOrderMapper implements OctopusOrderMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     *
     * @return string
     */
    public function mapOrderEntityToOctopusOrder(SpySalesOrder $orderEntity): string
    {
        $orderEntity->getBillingAddress();
    }

    protected function mapOrderAddressEntityToOctopusOrderAddress(SpySalesOrderAddress $orderAddressEntity): array {
        $octopusOrderAddress = [];

        $octopusOrderAddress['id_sales_order_address'] = $orderAddressEntity->getIdSalesOrderAddress();
        $octopusOrderAddress['email'] = $orderAddressEntity->getEmail();
        $octopusOrderAddress['salutation'] = $orderAddressEntity->getSalutation();
        $octopusOrderAddress['first_name'] = $orderAddressEntity->getFirstName();
        $octopusOrderAddress['middle_name'] = $orderAddressEntity->getMiddleName();
        $octopusOrderAddress['last_name'] = $orderAddressEntity->getLastName();
        $octopusOrderAddress['address1'] = $orderAddressEntity->getAddress1();
        $octopusOrderAddress['address2'] = $orderAddressEntity->getAddress2();
        $octopusOrderAddress['address3'] = $orderAddressEntity->getAddress3();
        $octopusOrderAddress['additional_address'] = $orderAddressEntity->getAdditionalAddress();
        $octopusOrderAddress['city'] = $orderAddressEntity->getCity();
        $octopusOrderAddress['zip_code'] = $orderAddressEntity->getZipCode();
        $octopusOrderAddress['phone'] = $orderAddressEntity->getPhone();
        $octopusOrderAddress['cell_phone'] = $orderAddressEntity->getCellPhone();
        $octopusOrderAddress['country_iso_code'] = $orderAddressEntity->getCountry()->getIso2Code();

        return $octopusOrderAddress;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return string
     */
    public function mapOrderTransferToOctopusOrder(OrderTransfer $orderTransfer): string
    {
        $octopusOrder['billing_address'] = $this->mapAddressTransferToOctopusOrderAddress(
            $orderTransfer->getBillingAddress()
        );

        $octopusOrder['shipping_address'] = $this->mapAddressTransferToOctopusOrderAddress(
            $orderTransfer->getShippingAddress()
        );
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return array
     */
    protected function mapAddressTransferToOctopusOrderAddress(AddressTransfer $addressTransfer): array
    {
        $octopusOrderAddress = [];

        $octopusOrderAddress['id_sales_order_address'] = $addressTransfer->getIdSalesOrderAddress();
        $octopusOrderAddress['email'] = $addressTransfer->getEmail();
        $octopusOrderAddress['salutation'] = $addressTransfer->getSalutation();
        $octopusOrderAddress['first_name'] = $addressTransfer->getFirstName();
        $octopusOrderAddress['middle_name'] = $addressTransfer->getMiddleName();
        $octopusOrderAddress['last_name'] = $addressTransfer->getLastName();
        $octopusOrderAddress['address1'] = $addressTransfer->getAddress1();
        $octopusOrderAddress['address2'] = $addressTransfer->getAddress2();
        $octopusOrderAddress['address3'] = $addressTransfer->getAddress3();
        $octopusOrderAddress['additional_address'] = $addressTransfer->getAdditionalAddress();
        $octopusOrderAddress['city'] = $addressTransfer->getCity();
        $octopusOrderAddress['zip_code'] = $addressTransfer->getZipCode();
        $octopusOrderAddress['phone'] = $addressTransfer->getPhone();
        $octopusOrderAddress['cell_phone'] = $addressTransfer->getCellPhone();
        $octopusOrderAddress['country_iso_code'] = $addressTransfer->getCountry()->getIso2Code();

        return $octopusOrderAddress;
    }
}
