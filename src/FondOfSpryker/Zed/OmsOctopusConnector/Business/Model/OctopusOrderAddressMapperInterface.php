<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\AddressTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

interface OctopusOrderAddressMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress $spySalesOrderAddress
     *
     * @return array
     */
    public function mapSpySalesOrderAddressToOctopusOrderAddress(SpySalesOrderAddress $spySalesOrderAddress): array;

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return array
     */
    public function mapAddressTransferToOctopusOrderAddress(AddressTransfer $addressTransfer): array;
}
