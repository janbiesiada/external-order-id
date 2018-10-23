<?php

namespace JBdev\ExternalOrderId\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

class UpgradeData implements UpgradeDataInterface
{

    /**
     * @var WriterInterface
     */
    private $writer;

    public function __construct(WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    /**
     * {@inheritdoc}
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if ($context->getVersion() && version_compare($context->getVersion(), '1.0.1') < 0) {
            $this->writer->save('checkout/options/guest_checkout',0);
        }
    }

}
