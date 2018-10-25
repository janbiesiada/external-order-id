<?php

namespace JBdev\ExternalOrderId\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\DB\Ddl\Table;


class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable('sales_order'),
                    'external_order_id',
                    [
                        'type' => Table::TYPE_TEXT,
                        'length' => 40,
                        'comment' =>'External Order Id',
                        'nullable' => true
                    ]
                );

            $setup->getConnection()
                ->addColumn(
                    $setup->getTable('quote'),
                    'external_order_id',
                    [
                        'type' => Table::TYPE_TEXT,
                        'length' => 40,
                        'comment' =>'External Order Id',
                        'nullable' => true
                    ]
                );
            }
        $setup->endSetup();
    }
}
