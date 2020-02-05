<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Sales\Business\SalesFacadeInterface;

class OmsOctopusConnectorToSalesBridge implements OmsOctopusConnectorToSalesInterface
{
    /**
     * @var \Spryker\Zed\Sales\Business\SalesFacadeInterface
     */
    protected $salesFacade;

    /**
     * @param \Spryker\Zed\Sales\Business\SalesFacadeInterface $salesFacade
     */
    public function __construct(SalesFacadeInterface $salesFacade)
    {
        $this->salesFacade = $salesFacade;
    }

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
    public function getOrderByIdSalesOrder($idSalesOrder): OrderTransfer
    {
        return $this->salesFacade->getOrderByIdSalesOrder($idSalesOrder);
    }
}
