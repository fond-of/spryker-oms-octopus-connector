<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Business\Model;

use FondOfSpryker\Zed\OmsOctopusConnector\Business\Api\Adapter\AdapterInterface;
use FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesInterface;
use Generated\Shared\Transfer\OctopusOrderRequestTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class OrderExporter implements OrderExporterInterface
{
    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesInterface
     */
    protected $salesFacade;

    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderMapperInterface
     */
    protected $octopusOrderMapper;

    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderItemMapperInterface
     */
    protected $octopusOrderItemMapper;

    /**
     * @var \FondOfSpryker\Zed\OmsOctopusConnector\Business\Api\Adapter\AdapterInterface
     */
    protected $apiAdapter;

    /**
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Dependency\Facade\OmsOctopusConnectorToSalesInterface $salesFacade
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderMapperInterface $octopusOrderMapper
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Business\Model\OctopusOrderItemMapperInterface $octopusOrderItemMapper
     * @param \FondOfSpryker\Zed\OmsOctopusConnector\Business\Api\Adapter\AdapterInterface $apiAdapter
     */
    public function __construct(
        OmsOctopusConnectorToSalesInterface $salesFacade,
        OctopusOrderMapperInterface $octopusOrderMapper,
        OctopusOrderItemMapperInterface $octopusOrderItemMapper,
        AdapterInterface $apiAdapter
    ) {
        $this->salesFacade = $salesFacade;
        $this->octopusOrderMapper = $octopusOrderMapper;
        $this->octopusOrderItemMapper = $octopusOrderItemMapper;
        $this->apiAdapter = $apiAdapter;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     * @param array $spySalesOrderItems
     *
     * @return void
     */
    public function export(SpySalesOrder $spySalesOrder, array $spySalesOrderItems): void
    {
        $octopusOrderItems = [];
        $groupKeyItemMapping = [];

        foreach ($spySalesOrderItems as $orderItem) {
            if (!\array_key_exists($orderItem->getGroupKey(), $groupKeyItemMapping)) {
                $octopusOrderItems[] = $this->octopusOrderItemMapper
                    ->mapSpySalesOrderItemEntityToOctopusOrderItem($orderItem);

                $groupKeyItemMapping[$orderItem->getGroupKey()] = count($octopusOrderItems) - 1;

                continue;
            }

            $octopusOrderItem = $octopusOrderItems[$groupKeyItemMapping[$orderItem->getGroupKey()]];

            $octopusOrderItem->setQuantity($octopusOrderItem->getQuantity() + $orderItem->getQuantity());
            $octopusOrderItem->setSubtotalAggregation($octopusOrderItem->getSubtotalAggregation() + $orderItem->getSubtotalAggregation());
            $octopusOrderItem->setTaxAmountFullAggregation($octopusOrderItem->getTaxAmountFullAggregation() + $orderItem->getTaxAmountFullAggregation());
            $octopusOrderItem->setPriceToPayAggregation($octopusOrderItem->getPriceToPayAggregation() + $orderItem->getPriceToPayAggregation());
            $octopusOrderItem->setDiscountAmountFullAggregation($octopusOrderItem->getDiscountAmountFullAggregation() + $orderItem->getDiscountAmountFullAggregation());
        }

        $octopusOrder = $this->octopusOrderMapper->mapSpySalesOrderToOctopusOrder($spySalesOrder);
        $octopusOrder->setOrderItems($octopusOrderItems);

        $octopusOrderRequest = new OctopusOrderRequestTransfer();

        $octopusOrderRequest->setBody($octopusOrder);

        $this->apiAdapter->sendRequest($octopusOrderRequest);
    }

    /**
     * @param int $idSalesOrder
     *
     * @return void
     */
    public function exportByIdSalesOrder(int $idSalesOrder): void
    {
        $orderTransfer = $this->salesFacade->getOrderByIdSalesOrder($idSalesOrder);

        $octopusOrderItems = [];
        $groupKeyItemMapping = [];

        foreach ($orderTransfer->getItems() as $orderItem) {
            if (!\array_key_exists($orderItem->getGroupKey(), $groupKeyItemMapping)) {
                $octopusOrderItems[] = $this->octopusOrderItemMapper
                    ->mapSpySalesOrderItemEntityToOctopusOrderItem($orderItem);

                $groupKeyItemMapping[$orderItem->getGroupKey()] = count($octopusOrderItems) - 1;

                continue;
            }

            $octopusOrderItem = $octopusOrderItems[$groupKeyItemMapping[$orderItem->getGroupKey()]];

            $octopusOrderItem->setQuantity($octopusOrderItem->getQuantity() + $orderItem->getQuantity());
            $octopusOrderItem->setSubtotalAggregation($octopusOrderItem->getSubtotalAggregation() + $orderItem->getSubtotalAggregation());
            $octopusOrderItem->setTaxAmountFullAggregation($octopusOrderItem->getTaxAmountFullAggregation() + $orderItem->getTaxAmountFullAggregation());
            $octopusOrderItem->setPriceToPayAggregation($octopusOrderItem->getPriceToPayAggregation() + $orderItem->getPriceToPayAggregation());
            $octopusOrderItem->setDiscountAmountFullAggregation($octopusOrderItem->getDiscountAmountFullAggregation() + $orderItem->getDiscountAmountFullAggregation());
        }

        $octopusOrder = $this->octopusOrderMapper->mapOrderTransferToOctopusOrder($spySalesOrder);
        $octopusOrder->setOrderItems($octopusOrderItems);

        $octopusOrderRequest = new OctopusOrderRequestTransfer();

        $octopusOrderRequest->setBody($octopusOrder);

        $this->apiAdapter->sendRequest($octopusOrderRequest);
    }
}
