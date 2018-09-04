<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\AddressTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

class OctopusOrderAddressMapper implements OctopusOrderAddressMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress $spySalesOrderAddress
     *
     * @return array
     */
    public function mapSpySalesOrderAddressToOctopusOrderAddress(SpySalesOrderAddress $spySalesOrderAddress): array
    {
        $octopusOrderAddress = [];

        $octopusOrderAddress['id_sales_order_address'] = $spySalesOrderAddress->getIdSalesOrderAddress();
        $octopusOrderAddress['email'] = $spySalesOrderAddress->getEmail();
        $octopusOrderAddress['salutation'] = $spySalesOrderAddress->getSalutation();
        $octopusOrderAddress['first_name'] = $spySalesOrderAddress->getFirstName();
        $octopusOrderAddress['middle_name'] = $spySalesOrderAddress->getMiddleName();
        $octopusOrderAddress['last_name'] = $spySalesOrderAddress->getLastName();
        $octopusOrderAddress['address1'] = $spySalesOrderAddress->getAddress1();
        $octopusOrderAddress['address2'] = $spySalesOrderAddress->getAddress2();
        $octopusOrderAddress['address3'] = $spySalesOrderAddress->getAddress3();
        $octopusOrderAddress['additional_address'] = $spySalesOrderAddress->getAdditionalAddress();
        $octopusOrderAddress['city'] = $spySalesOrderAddress->getCity();
        $octopusOrderAddress['zip_code'] = $spySalesOrderAddress->getZipCode();
        $octopusOrderAddress['phone'] = $spySalesOrderAddress->getPhone();
        $octopusOrderAddress['cell_phone'] = $spySalesOrderAddress->getCellPhone();
        $octopusOrderAddress['country_iso_code'] = $spySalesOrderAddress->getCountry()->getIso2Code();

        return $octopusOrderAddress;
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return array
     */
    public function mapAddressTransferToOctopusOrderAddress(AddressTransfer $addressTransfer): array
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
