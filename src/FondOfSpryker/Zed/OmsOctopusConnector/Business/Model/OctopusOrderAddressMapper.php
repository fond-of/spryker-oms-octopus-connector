<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\OctopusOrderAddressTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

class OctopusOrderAddressMapper implements OctopusOrderAddressMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress $spySalesOrderAddress
     *
     * @return \Generated\Shared\Transfer\OctopusOrderAddressTransfer
     */
    public function mapSpySalesOrderAddressToOctopusOrderAddress(SpySalesOrderAddress $spySalesOrderAddress): OctopusOrderAddressTransfer
    {
        $octopusOrderAddress = new OctopusOrderAddressTransfer();

        $octopusOrderAddress->setIdSalesOrderAddress($spySalesOrderAddress->getIdSalesOrderAddress());
        $octopusOrderAddress->setEmail($spySalesOrderAddress->getEmail());
        $octopusOrderAddress->setSalutation($spySalesOrderAddress->getSalutation());
        $octopusOrderAddress->setFirstName($spySalesOrderAddress->getFirstName());
        $octopusOrderAddress->setMiddleName($spySalesOrderAddress->getMiddleName());
        $octopusOrderAddress->setLastName($spySalesOrderAddress->getLastName());
        $octopusOrderAddress->setAddress1($spySalesOrderAddress->getAddress1());
        $octopusOrderAddress->setAddress2($spySalesOrderAddress->getAddress2());
        $octopusOrderAddress->setAddress3($spySalesOrderAddress->getAddress3());
        $octopusOrderAddress->setAdditionalAddress($spySalesOrderAddress->getAdditionalAddress());
        $octopusOrderAddress->setCity($spySalesOrderAddress->getCity());
        $octopusOrderAddress->setZipCode($spySalesOrderAddress->getZipCode());
        $octopusOrderAddress->setPhone($spySalesOrderAddress->getPhone());
        $octopusOrderAddress->setCellPhone($spySalesOrderAddress->getCellPhone());
        $octopusOrderAddress->setCountryIsoCode($spySalesOrderAddress->getCountry()->getIso2Code());

        return $octopusOrderAddress;
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderAddressTransfer
     */
    public function mapAddressTransferToOctopusOrderAddress(AddressTransfer $addressTransfer): OctopusOrderAddressTransfer
    {
        $octopusOrderAddress = new OctopusOrderAddressTransfer();

        $octopusOrderAddress->setIdSalesOrderAddress($addressTransfer->getIdSalesOrderAddress());
        $octopusOrderAddress->setEmail($addressTransfer->getEmail());
        $octopusOrderAddress->setSalutation($addressTransfer->getSalutation());
        $octopusOrderAddress->setFirstName($addressTransfer->getFirstName());
        $octopusOrderAddress->setMiddleName($addressTransfer->getMiddleName());
        $octopusOrderAddress->setLastName($addressTransfer->getLastName());
        $octopusOrderAddress->setAddress1($addressTransfer->getAddress1());
        $octopusOrderAddress->setAddress2($addressTransfer->getAddress2());
        $octopusOrderAddress->setAddress3($addressTransfer->getAddress3());
        $octopusOrderAddress->setAdditionalAddress($addressTransfer->getAdditionalAddress());
        $octopusOrderAddress->setCity($addressTransfer->getCity());
        $octopusOrderAddress->setZipCode($addressTransfer->getZipCode());
        $octopusOrderAddress->setPhone($addressTransfer->getPhone());
        $octopusOrderAddress->setCellPhone($addressTransfer->getCellPhone());
        $octopusOrderAddress->setCountryIsoCode($addressTransfer->getCountry()->getIso2Code());

        return $octopusOrderAddress;
    }
}
