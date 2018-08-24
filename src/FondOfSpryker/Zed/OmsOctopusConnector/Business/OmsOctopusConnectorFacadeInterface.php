<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business;

interface OmsOctopusConnectorFacadeInterface
{
    /**
     * @param int $idSalesOrder
     *
     * @return void
     */
    public function exportOrderToOctopus(int $idSalesOrder): void;
}
