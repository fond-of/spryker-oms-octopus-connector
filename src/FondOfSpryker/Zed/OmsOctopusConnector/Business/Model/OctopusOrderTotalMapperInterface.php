<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\OctopusOrderTotalTransfer;
use Generated\Shared\Transfer\SpySalesOrderTotalsEntityTransfer;
use Generated\Shared\Transfer\TotalsTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderTotals;

interface OctopusOrderTotalMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderTotals $spySalesOrderTotals
     *
     * @return \Generated\Shared\Transfer\OctopusOrderTotalTransfer
     */
    public function mapSpySalesOrderTotalToOctopusOrderTotal(SpySalesOrderTotals $spySalesOrderTotals): OctopusOrderTotalTransfer;

    /**
     * @param \Generated\Shared\Transfer\TotalsTransfer $totalsTransfer
     * ;
     * @return \Generated\Shared\Transfer\OctopusOrderTotalTransfer
     */
    public function mapTotalsTransferToOctopusOrderTotal(TotalsTransfer $totalsTransfer): OctopusOrderTotalTransfer;

}