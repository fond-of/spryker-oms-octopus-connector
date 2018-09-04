<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use Generated\Shared\Transfer\ExpenseTransfer;
use Orm\Zed\Sales\Persistence\SpySalesExpense;

interface OctopusOrderShipmentItemMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesExpense $spySalesExpense
     *
     * @return array
     */
    public function mapSpySalesExpenseToOctopusOrderShipmentItem(SpySalesExpense $spySalesExpense): array;

    /**
     * @param \Generated\Shared\Transfer\ExpenseTransfer $expenseTransfer
     *
     * @return array
     */
    public function mapExpenseTransferToOctopusOrderShipmentItem(ExpenseTransfer $expenseTransfer): array;
}
