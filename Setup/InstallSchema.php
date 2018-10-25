<?php
namespace JBdev\ExternalOrderId\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

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

        $setup->endSetup();
    }
}
