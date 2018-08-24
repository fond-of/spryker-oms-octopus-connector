<?php

namespace FondOfSpryker\Zed\OmsOctopusConnector\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfSpryker\Zed\OmsOctopusConnector\Business\OmsOctopusConnectorFacadeInterface getFacade()
 */
class ExportOrderToOctopusConsole extends Console
{
    const COMMAND_NAME = 'oms-octopus-connector:order:export';
    const ARGUMENT_ORDER_ID = 'order_id';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription('Export order to octopus by id.');
        $this->addArgument(static::ARGUMENT_ORDER_ID, InputArgument::REQUIRED, 'Id of order which should be exported to octopus.');

        parent::configure();
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $idSalesOrder = $input->getArgument(static::ARGUMENT_ORDER_ID);

        $this->getFacade()->exportOrderToOctopus($idSalesOrder);
    }
}
