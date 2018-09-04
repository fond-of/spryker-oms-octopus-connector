<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\ExpenseTransfer;
use Generated\Shared\Transfer\OctopusOrderShipmentItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesExpense;

interface OctopusOrderShipmentItemMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesExpense $spySalesExpense
     *
     * @return \Generated\Shared\Transfer\OctopusOrderShipmentItemTransfer
     */
    public function mapSpySalesExpenseToOctopusOrderShipmentItem(SpySalesExpense $spySalesExpense): OctopusOrderShipmentItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ExpenseTransfer $expenseTransfer
     *
     * @return \Generated\Shared\Transfer\OctopusOrderShipmentItemTransfer
     */
    public function mapExpenseTransferToOctopusOrderShipmentItem(ExpenseTransfer $expenseTransfer): OctopusOrderShipmentItemTransfer;
}
