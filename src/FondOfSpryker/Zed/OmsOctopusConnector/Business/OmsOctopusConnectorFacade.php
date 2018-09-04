<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\OmsOctopusConnector\Business\OmsOctopusConnectorBusinessFactory getFactory()
 */
class OmsOctopusConnectorFacade extends AbstractFacade implements OmsOctopusConnectorFacadeInterface
{
    /**
     * @param int $idSalesOrder
     *
     * @return void
     */
    public function exportOrderByIdSalesOrder(int $idSalesOrder): void
    {
        $this->getFactory()->createOrderExporter()->exportByIdSalesOrder($idSalesOrder);
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     * @param array $spySalesOrderItems
     *
     * @return void
     */
    public function exportOrder(SpySalesOrder $spySalesOrder, array $spySalesOrderItems): void
    {
        $this->getFactory()->createOrderExporter()->export($spySalesOrder, $spySalesOrderItems);
    }
}
