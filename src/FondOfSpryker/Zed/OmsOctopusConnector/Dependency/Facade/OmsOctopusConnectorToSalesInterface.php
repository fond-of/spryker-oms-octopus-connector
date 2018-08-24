<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade;

use Generated\Shared\Transfer\OrderTransfer;

interface OmsOctopusConnectorToSalesInterface
{
    /**
     * Specification:
     * - Returns the order for the given sales oder id.
     *
     * @api
     *
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function getOrderByIdSalesOrder($idSalesOrder): OrderTransfer;
}
