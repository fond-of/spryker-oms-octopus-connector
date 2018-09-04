<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\OctopusOrderAddressTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

interface OctopusOrderAddressMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress $spySalesOrderAddress
     *
     * @return \Generated\Shared\Transfer\OctopusOrderAddressTransfer
     */
    public function mapSpySalesOrderAddressToOctopusOrderAddress(SpySalesOrderAddress $spySalesOrderAddress): OctopusOrderAddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderAddressTransfer
     */
    public function mapAddressTransferToOctopusOrderAddress(AddressTransfer $addressTransfer): OctopusOrderAddressTransfer;
}
