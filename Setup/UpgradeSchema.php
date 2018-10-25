<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Catalog\Setup;

use Magento\Catalog\Model\Product\Attribute\Backend\Media\ImageEntryConverter;
use Magento\Catalog\Model\Product\Exception;
use Magento\Catalog\Model\ResourceModel\Product\Gallery;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Upgrade the Catalog module DB scheme
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
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
