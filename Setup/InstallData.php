<?php

namespace JBdev\ExternalOrderId\Setup;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Sales\Setup\SalesSetupFactory;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{

    /**
     * @var WriterInterface
     */
    private $writer;
    /**
     * @var SalesSetupFactory
     */
    private $salesSetupFactory;

    public function __construct(
        WriterInterface $writer,
        SalesSetupFactory $salesSetupFactory
    )
    {
        $this->writer = $writer;
        $this->salesSetupFactory = $salesSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();
        $this->writer->save('checkout/options/guest_checkout', 0);
        $installer->endSetup();
    }
}
